<?php

namespace App\Services;

use App\Models\Matricula;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Pago en línea con Culqi (tarjeta y Yape).
 *
 * El navegador abre el formulario de Culqi y obtiene un token; aquí se crea el cargo
 * con la llave secreta. Si Culqi lo aprueba, la matrícula se marca como pagada con
 * MatriculaService::registrarPago(), que también envía las credenciales por correo.
 */
class CulqiService
{
    public function __construct(protected MatriculaService $matriculaService)
    {
    }

    public function activo(): bool
    {
        return filled(config('services.culqi.public_key')) && filled(config('services.culqi.secret_key'));
    }

    public function modoPrueba(): bool
    {
        return str_starts_with((string) config('services.culqi.public_key'), 'pk_test_');
    }

    /** Monto en céntimos, como lo pide Culqi. */
    public function centimos(Matricula $matricula): int
    {
        return (int) round((float) $matricula->monto_total * 100);
    }

    /**
     * @return array{ok:bool, mensaje:string, correo_enviado?:bool, ya_pagada?:bool}
     */
    public function cobrar(Matricula $matricula, string $token, string $email): array
    {
        if (!$this->activo()) {
            return ['ok' => false, 'mensaje' => 'El pago en línea no está disponible en este momento.'];
        }
        if ($matricula->estado === Matricula::ESTADO_PAGADA) {
            return ['ok' => true, 'ya_pagada' => true, 'mensaje' => 'Esta matrícula ya está pagada.'];
        }
        if ($matricula->estado !== Matricula::ESTADO_PENDIENTE) {
            return ['ok' => false, 'mensaje' => 'Esta matrícula fue cancelada. Comunícate con nosotros para reactivarla.'];
        }
        if ($this->centimos($matricula) < 300) {
            return ['ok' => false, 'mensaje' => 'El monto de la matrícula no es válido para el pago en línea.'];
        }

        // Evita cobrar dos veces si el usuario hace doble clic o abre dos pestañas.
        $candado = Cache::lock('pago-culqi-' . $matricula->id_matricula, 60);
        if (!$candado->get()) {
            return ['ok' => false, 'mensaje' => 'Ya estamos procesando un pago de esta matrícula. Espera unos segundos.'];
        }

        try {
            $matricula->refresh();
            if ($matricula->estado === Matricula::ESTADO_PAGADA) {
                return ['ok' => true, 'ya_pagada' => true, 'mensaje' => 'Esta matrícula ya está pagada.'];
            }

            $respuesta = Http::withToken(config('services.culqi.secret_key'))
                ->acceptJson()
                ->timeout(40)
                ->post(rtrim(config('services.culqi.url'), '/') . '/charges', [
                    'amount' => $this->centimos($matricula),
                    'currency_code' => 'PEN',
                    'email' => $email,
                    'source_id' => $token,
                    'description' => "Matrícula {$matricula->codigo} - Next Level",
                    'metadata' => [
                        'codigo_matricula' => $matricula->codigo,
                        'id_matricula' => (string) $matricula->id_matricula,
                    ],
                ]);

            $cargo = $respuesta->json() ?? [];

            if (!$respuesta->successful() || ($cargo['object'] ?? null) !== 'charge') {
                Log::warning('Culqi rechazó el cargo', [
                    'matricula' => $matricula->codigo,
                    'estado_http' => $respuesta->status(),
                    'tipo' => $cargo['type'] ?? null,
                    'mensaje' => $cargo['merchant_message'] ?? null,
                ]);
                $this->matriculaService->registrarPagoFallido(
                    $matricula,
                    $cargo['merchant_message'] ?? $cargo['user_message'] ?? 'Cargo rechazado por la pasarela.'
                );
                return ['ok' => false, 'mensaje' => $cargo['user_message'] ?? 'No se pudo procesar el pago. Inténtalo nuevamente.'];
            }

            $pago = $this->matriculaService->registrarPago(
                $matricula,
                null,
                'Culqi (pago en línea)',
                $cargo['id'] ?? null,
                isset($cargo['amount']) ? $cargo['amount'] / 100 : null
            );

            return [
                'ok' => true,
                'correo_enviado' => $pago['correo_enviado'],
                'mensaje' => $cargo['outcome']['user_message'] ?? 'Pago aprobado.',
            ];
        } catch (Throwable $e) {
            Log::error('Error al cobrar con Culqi', ['matricula' => $matricula->codigo, 'error' => $e->getMessage()]);
            return ['ok' => false, 'mensaje' => 'No pudimos comunicarnos con la pasarela de pagos. Inténtalo en unos minutos.'];
        } finally {
            $candado->release();
        }
    }

    // ======================================================
    // WEBHOOK (notificación de servidor a servidor)
    // ======================================================

    /**
     * Procesa una notificación de Culqi. Nunca se confía en el contenido recibido:
     * se toma solo el ID del cargo u orden y se vuelve a consultar a Culqi con la
     * llave secreta. Así, aunque alguien llame a la URL con datos falsos, no puede
     * marcar una matrícula como pagada.
     *
     * @return array{resultado:string, detalle:string, id_matricula:?int}
     */
    public function procesarWebhook(array $evento): array
    {
        $data = $evento['data'] ?? [];
        if (is_string($data)) {
            $data = json_decode($data, true) ?: [];
        }

        $id = $data['id'] ?? null;
        $tipo = (string) ($evento['type'] ?? '');

        if (!$id || !is_string($id)) {
            return $this->resultado('ignorado', 'La notificación no trae el ID del cargo u orden.');
        }

        return match (true) {
            str_starts_with($id, 'chr_') => $this->procesarCargo($id),
            str_starts_with($id, 'ord_') => $this->procesarOrden($id),
            default => $this->resultado('ignorado', "Evento {$tipo} no relacionado con pagos."),
        };
    }

    /** Cargo con tarjeta o Yape: "venta_exitosa" = aprobado. */
    protected function procesarCargo(string $idCargo): array
    {
        $cargo = $this->consultar("charges/{$idCargo}");
        if (!$cargo) {
            return $this->resultado('error', "No se pudo consultar el cargo {$idCargo} en Culqi.");
        }

        $matricula = $this->buscarMatricula($cargo);
        if (!$matricula) {
            return $this->resultado('ignorado', "El cargo {$idCargo} no pertenece a ninguna matrícula.");
        }

        $aprobado = ($cargo['outcome']['type'] ?? null) === 'venta_exitosa';

        return $aprobado
            ? $this->aprobar($matricula, $idCargo, (int) ($cargo['amount'] ?? 0), $cargo['currency_code'] ?? '')
            : $this->rechazar($matricula, $cargo['outcome']['merchant_message'] ?? 'Cargo no aprobado.');
    }

    /** Orden (PagoEfectivo, banca móvil, agentes): "paid" = pagada; "expired"/"deleted" = fallida. */
    protected function procesarOrden(string $idOrden): array
    {
        $orden = $this->consultar("orders/{$idOrden}");
        if (!$orden) {
            return $this->resultado('error', "No se pudo consultar la orden {$idOrden} en Culqi.");
        }

        $matricula = $this->buscarMatricula($orden);
        if (!$matricula) {
            return $this->resultado('ignorado', "La orden {$idOrden} no pertenece a ninguna matrícula.");
        }

        return match ($orden['state'] ?? null) {
            'paid' => $this->aprobar($matricula, $idOrden, (int) ($orden['amount'] ?? 0), $orden['currency_code'] ?? ''),
            'expired', 'deleted' => $this->rechazar($matricula, 'La orden de pago venció o fue anulada.'),
            default => $this->resultado('pendiente', 'La orden aún no se paga (' . ($orden['state'] ?? '?') . ').', $matricula),
        };
    }

    protected function aprobar(Matricula $matricula, string $idTransaccion, int $centimos, string $moneda): array
    {
        if ($moneda !== 'PEN' || $centimos !== $this->centimos($matricula)) {
            Log::warning('Webhook Culqi: monto no coincide', [
                'matricula' => $matricula->codigo, 'recibido' => $centimos, 'esperado' => $this->centimos($matricula), 'moneda' => $moneda,
            ]);
            return $this->resultado('monto_incorrecto', "Se recibió {$moneda} " . ($centimos / 100) . ' y se esperaba PEN ' . $matricula->monto_total . '.', $matricula);
        }

        $pago = $this->matriculaService->registrarPago($matricula, null, 'Culqi (webhook)', $idTransaccion, $centimos / 100);

        $detalle = $pago['ya_pagada'] ? 'La matrícula ya estaba pagada.' : 'Pago aprobado y registrado.';
        $detalle .= $pago['correo_enviado'] ? ' Constancia enviada.' : '';

        return $this->resultado($pago['ya_pagada'] ? 'duplicado' : 'pagado', $detalle, $matricula);
    }

    protected function rechazar(Matricula $matricula, string $motivo): array
    {
        if ($matricula->estado === Matricula::ESTADO_PAGADA) {
            return $this->resultado('ignorado', "Rechazo recibido, pero la matrícula ya está pagada: {$motivo}", $matricula);
        }

        $this->matriculaService->registrarPagoFallido($matricula, $motivo);

        return $this->resultado('fallido', $motivo, $matricula);
    }

    /** La matrícula se identifica por la metadata que se envió al crear el cargo u orden. */
    protected function buscarMatricula(array $objeto): ?Matricula
    {
        $meta = $objeto['metadata'] ?? [];

        return Matricula::with('alumno')
            ->when(
                !empty($meta['id_matricula']),
                fn ($q) => $q->whereKey($meta['id_matricula']),
                fn ($q) => $q->where('codigo', $meta['codigo_matricula'] ?? '__sin_codigo__')
            )
            ->first();
    }

    protected function consultar(string $ruta): ?array
    {
        try {
            $r = Http::withToken(config('services.culqi.secret_key'))
                ->acceptJson()
                ->timeout(20)
                ->get(rtrim(config('services.culqi.url'), '/') . '/' . $ruta);

            return $r->successful() ? $r->json() : null;
        } catch (Throwable $e) {
            Log::error('Webhook Culqi: error al consultar', ['ruta' => $ruta, 'error' => $e->getMessage()]);
            return null;
        }
    }

    protected function resultado(string $resultado, string $detalle, ?Matricula $matricula = null): array
    {
        return ['resultado' => $resultado, 'detalle' => $detalle, 'id_matricula' => $matricula?->id_matricula];
    }
}
