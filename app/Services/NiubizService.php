<?php

namespace App\Services;

use App\Models\Matricula;
use App\Models\WebhookEvento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Pago en línea con Niubiz - Botón de Pago Web (tarjetas, Yape y billeteras).
 *
 * Flujo (todas las llamadas a la API son de servidor a servidor):
 *  1. tokenSeguridad(): token de acceso con usuario y clave del comercio.
 *  2. crearSesion():    token de sesión con el monto que calcula el servidor.
 *  3. El navegador abre el formulario de Niubiz (checkout.js) y, al pagar, Niubiz
 *     hace POST a nuestra URL de respuesta con un transactionToken.
 *  4. autorizar():      nuestro servidor pide la autorización a Niubiz. Solo si la
 *     respuesta es STATUS "Authorized" y el monto coincide, la matrícula queda pagada.
 *
 * Si el padre cierra la pestaña antes del paso 4 no se cobra nada: el cargo solo
 * existe cuando nuestro servidor lo autoriza, así que no hay pagos sin registrar.
 */
class NiubizService
{
    /** Códigos de acción que Niubiz considera aprobados. */
    private const APROBADOS = ['000', '010'];

    public function __construct(protected MatriculaService $matriculaService)
    {
    }

    public function activo(): bool
    {
        return filled(config('services.niubiz.merchant_id'))
            && filled(config('services.niubiz.usuario'))
            && filled(config('services.niubiz.clave'));
    }

    public function modoPrueba(): bool
    {
        return config('services.niubiz.entorno') !== 'produccion';
    }

    public function urlScript(): string
    {
        return config('services.niubiz.urls.' . ($this->modoPrueba() ? 'sandbox' : 'produccion') . '.js');
    }

    protected function urlApi(string $ruta): string
    {
        return config('services.niubiz.urls.' . ($this->modoPrueba() ? 'sandbox' : 'produccion') . '.api') . $ruta;
    }

    /** Monto con dos decimales, como lo pide Niubiz. */
    public function monto(Matricula $matricula): float
    {
        return round((float) $matricula->monto_total, 2);
    }

    /** Paso 1: token de acceso (vigencia 60 min; Niubiz pide uno nuevo por cada sesión). */
    public function tokenSeguridad(): string
    {
        $r = Http::withBasicAuth(config('services.niubiz.usuario'), config('services.niubiz.clave'))
            ->timeout(20)
            ->get($this->urlApi('/api.security/v1/security'));

        if (!$r->successful() || blank($r->body())) {
            throw new \RuntimeException('Niubiz no entregó el token de seguridad (HTTP ' . $r->status() . ').');
        }

        return trim($r->body());
    }

    /**
     * Paso 2: crea el token de sesión y un número de pedido nuevo para este intento.
     *
     * @return array{ok:bool, mensaje?:string, config?:array}
     */
    public function crearSesion(Matricula $matricula, ?string $ip, string $urlRespuesta, string $urlTimeout): array
    {
        if (!$this->activo()) {
            return ['ok' => false, 'mensaje' => 'El pago en línea no está disponible en este momento.'];
        }
        if ($matricula->estado === Matricula::ESTADO_PAGADA) {
            return ['ok' => false, 'mensaje' => 'Esta matrícula ya está pagada.'];
        }
        if ($matricula->estado !== Matricula::ESTADO_PENDIENTE) {
            return ['ok' => false, 'mensaje' => 'Esta matrícula fue cancelada. Comunícate con nosotros para reactivarla.'];
        }
        if ($matricula->esta_vencida) {
            return ['ok' => false, 'mensaje' => 'El plazo de pago de esta matrícula venció. Comunícate con nosotros.'];
        }
        if ($this->monto($matricula) < 1) {
            return ['ok' => false, 'mensaje' => 'El monto de la matrícula no es válido para el pago en línea.'];
        }

        $matricula->loadMissing('alumno.apoderado');
        $alumno = $matricula->alumno;
        $email = $alumno?->apoderado?->correo ?: $alumno?->email;
        $comercio = config('services.niubiz.comercio');

        try {
            $token = $this->tokenSeguridad();
            $pedido = $this->nuevoNumeroPedido($matricula);

            $r = Http::withHeaders(['Authorization' => $token])
                ->acceptJson()
                ->timeout(20)
                ->post($this->urlApi('/api.ecommerce/v2/ecommerce/token/session/' . config('services.niubiz.merchant_id')), [
                    'channel' => 'web',
                    'amount' => $this->monto($matricula),
                    'antifraud' => [
                        'clientIp' => $ip,
                        'merchantDefineData' => [
                            'MDD4' => $email,
                            'MDD32' => (string) ($alumno?->dni ?? $matricula->codigo),
                            'MDD75' => 'Invitado',
                            'MDD77' => max(1, (int) ($matricula->fecha_registro?->diffInDays(now()) ?? 1)),
                        ],
                    ],
                    'dataMap' => [
                        'cardholderCity' => $comercio['ciudad'],
                        'cardholderCountry' => 'PE',
                        'cardholderAddress' => $comercio['direccion'],
                        'cardholderPostalCode' => $comercio['codigo_postal'],
                        'cardholderState' => $comercio['departamento'],
                        'cardholderPhoneNumber' => preg_replace('/\D/', '', (string) ($alumno?->apoderado?->telefono ?: $alumno?->telefono)) ?: '999999999',
                    ],
                ]);

            $sesion = $r->json() ?? [];
            if (!$r->successful() || empty($sesion['sessionKey'])) {
                Log::warning('Niubiz no creó la sesión', ['matricula' => $matricula->codigo, 'http' => $r->status(), 'respuesta' => $sesion]);
                return ['ok' => false, 'mensaje' => 'No se pudo iniciar el pago. Inténtalo nuevamente en unos minutos.'];
            }

            return ['ok' => true, 'config' => [
                'sessiontoken' => $sesion['sessionKey'],
                'channel' => 'web',
                'merchantid' => config('services.niubiz.merchant_id'),
                'purchasenumber' => $pedido,
                'amount' => number_format($this->monto($matricula), 2, '.', ''),
                'expirationminutes' => '15',
                'timeouturl' => $urlTimeout,
                'action' => $urlRespuesta,
                'merchantname' => 'Next Level',
                'formbuttoncolor' => '#E63946',
                'cardholderemail' => $email,
            ]];
        } catch (Throwable $e) {
            Log::error('Error al crear la sesión de Niubiz', ['matricula' => $matricula->codigo, 'error' => $e->getMessage()]);
            return ['ok' => false, 'mensaje' => 'No pudimos comunicarnos con la pasarela de pagos. Inténtalo en unos minutos.'];
        }
    }

    /**
     * Paso 4: autoriza la transacción con el token que devolvió el formulario de Niubiz.
     *
     * @return array{ok:bool, mensaje:string, ya_pagada?:bool, correo_enviado?:bool}
     */
    public function autorizar(Matricula $matricula, string $transactionToken): array
    {
        if ($matricula->estado === Matricula::ESTADO_PAGADA) {
            return ['ok' => true, 'ya_pagada' => true, 'mensaje' => 'Esta matrícula ya está pagada.'];
        }
        if (!$this->activo() || blank($matricula->numero_pedido)) {
            return ['ok' => false, 'mensaje' => 'No encontramos un pago iniciado para esta matrícula.'];
        }

        // Evita autorizar dos veces si el navegador reenvía el formulario.
        $candado = Cache::lock('pago-niubiz-' . $matricula->id_matricula, 60);
        if (!$candado->get()) {
            return ['ok' => false, 'mensaje' => 'Ya estamos procesando un pago de esta matrícula. Espera unos segundos.'];
        }

        try {
            $matricula->refresh();
            if ($matricula->estado === Matricula::ESTADO_PAGADA) {
                return ['ok' => true, 'ya_pagada' => true, 'mensaje' => 'Esta matrícula ya está pagada.'];
            }

            $comercio = config('services.niubiz.comercio');
            $r = Http::withHeaders(['Authorization' => $this->tokenSeguridad()])
                ->acceptJson()
                ->timeout(40)
                ->post($this->urlApi('/api.authorization/v3/authorization/ecommerce/' . config('services.niubiz.merchant_id')), [
                    'channel' => 'web',
                    'captureType' => 'manual',
                    'countable' => true, // liquidación automática: no hace falta API de confirmación
                    'order' => [
                        'tokenId' => $transactionToken,
                        'purchaseNumber' => $matricula->numero_pedido,
                        'amount' => $this->monto($matricula),
                        'currency' => 'PEN',
                    ],
                    'dataMap' => [
                        'urlAddress' => config('app.url'),
                        'serviceLocationCityName' => $comercio['ciudad'],
                        'serviceLocationCountrySubdivisionCode' => $comercio['departamento'],
                        'serviceLocationCountryCode' => 'PER',
                        'serviceLocationPostalCode' => $comercio['codigo_postal'],
                    ],
                ]);

            $resp = $r->json() ?? [];
            $datos = $resp['dataMap'] ?? $resp['data'] ?? [];
            $estado = $datos['STATUS'] ?? null;
            $codigo = (string) ($datos['ACTION_CODE'] ?? $resp['order']['actionCode'] ?? '');
            $idTransaccion = $resp['order']['transactionId'] ?? $datos['TRANSACTION_ID'] ?? null;
            $montoAutorizado = (float) ($resp['order']['authorizedAmount'] ?? $datos['AMOUNT'] ?? 0);

            $this->registrarEvento($matricula, $transactionToken, $resp, $r->status());

            $aprobado = $r->successful() && $estado === 'Authorized' && in_array($codigo, self::APROBADOS, true);

            if (!$aprobado) {
                $motivo = $datos['ACTION_DESCRIPTION'] ?? $resp['errorMessage'] ?? $resp['description'] ?? 'Transacción no autorizada.';
                Log::warning('Niubiz no autorizó el pago', ['matricula' => $matricula->codigo, 'http' => $r->status(), 'codigo' => $codigo, 'motivo' => $motivo]);
                $this->matriculaService->registrarPagoFallido($matricula, "[{$codigo}] {$motivo}");

                return ['ok' => false, 'mensaje' => "Tu pago no fue aprobado: {$motivo}"];
            }

            if (abs($montoAutorizado - $this->monto($matricula)) > 0.001) {
                // No debería pasar (el monto viaja desde nuestro servidor), pero se deja constancia.
                Log::critical('Niubiz autorizó un monto distinto', ['matricula' => $matricula->codigo, 'autorizado' => $montoAutorizado, 'esperado' => $this->monto($matricula)]);
                $this->matriculaService->registrarPagoFallido($matricula, "Monto autorizado S/ {$montoAutorizado} distinto al esperado; revisar en Niubiz.");

                return ['ok' => false, 'mensaje' => 'Hubo una diferencia en el monto del pago. Comunícate con nosotros indicando tu código.'];
            }

            $pago = $this->matriculaService->registrarPago($matricula, null, 'Niubiz (pago en línea)', $idTransaccion, $montoAutorizado);

            return [
                'ok' => true,
                'ya_pagada' => $pago['ya_pagada'],
                'correo_enviado' => $pago['correo_enviado'],
                'mensaje' => $datos['ACTION_DESCRIPTION'] ?? 'Pago aprobado.',
            ];
        } catch (Throwable $e) {
            Log::error('Error al autorizar con Niubiz', ['matricula' => $matricula->codigo, 'error' => $e->getMessage()]);
            return ['ok' => false, 'mensaje' => 'No pudimos confirmar tu pago con la pasarela. No se realizó ningún cobro; inténtalo nuevamente.'];
        } finally {
            $candado->release();
        }
    }

    /** Número de pedido único por intento (máx. 12 dígitos): id de matrícula (6) + aleatorio (6). */
    protected function nuevoNumeroPedido(Matricula $matricula): string
    {
        do {
            $pedido = sprintf('%06d%06d', $matricula->id_matricula % 1000000, random_int(0, 999999));
        } while (Matricula::where('numero_pedido', $pedido)->exists());

        $matricula->update(['numero_pedido' => $pedido, 'estado_pago' => Matricula::PAGO_PENDIENTE]);

        return $pedido;
    }

    /** Guarda la respuesta de Niubiz para auditoría (sin datos de tarjeta: Niubiz los devuelve enmascarados). */
    protected function registrarEvento(Matricula $matricula, string $transactionToken, array $respuesta, int $http): void
    {
        try {
            WebhookEvento::updateOrCreate(
                ['id_evento' => 'niubiz-' . $matricula->numero_pedido],
                [
                    'pasarela' => 'niubiz',
                    'tipo' => 'autorizacion',
                    'id_objeto' => mb_substr($transactionToken, 0, 100),
                    'id_matricula' => $matricula->id_matricula,
                    'resultado' => ($respuesta['dataMap']['STATUS'] ?? null) === 'Authorized' ? 'pagado' : 'fallido',
                    'detalle' => mb_substr("HTTP {$http} · " . ($respuesta['dataMap']['ACTION_DESCRIPTION'] ?? $respuesta['data']['ACTION_DESCRIPTION'] ?? $respuesta['errorMessage'] ?? ''), 0, 255),
                    'payload' => $respuesta,
                ]
            );
        } catch (Throwable $e) {
            Log::warning('No se pudo guardar el evento de Niubiz', ['error' => $e->getMessage()]);
        }
    }
}
