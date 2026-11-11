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
                return ['ok' => false, 'mensaje' => $cargo['user_message'] ?? 'No se pudo procesar el pago. Inténtalo nuevamente.'];
            }

            $pago = $this->matriculaService->registrarPago($matricula, $cargo['id'] ?? null, 'Culqi (pago en línea)');

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
}
