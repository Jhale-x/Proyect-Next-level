<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Verificación de DNI + código de verificación (CV) contra RENIEC (apisperu).
 * La usan el formulario web y el chatbot.
 */
class DniService
{
    /** DNIs de prueba: solo funcionan con APP_ENV=local. */
    private const PRUEBA = [
        '12345678' => ['cv' => '5', 'nombres' => 'Juan Carlos', 'apellido_paterno' => 'Pérez', 'apellido_materno' => 'Gómez'],
        '87654321' => ['cv' => '3', 'nombres' => 'María José', 'apellido_paterno' => 'García', 'apellido_materno' => 'López'],
        '11111111' => ['cv' => '7', 'nombres' => 'Carlos', 'apellido_paterno' => 'Ramírez', 'apellido_materno' => 'Torres'],
        '44444444' => ['cv' => '2', 'nombres' => 'Ana', 'apellido_paterno' => 'Martínez', 'apellido_materno' => 'Sánchez'],
    ];

    /**
     * @return array{ok:bool, error?:string, datos?:array{dni:string,nombres:string,apellido_paterno:string,apellido_materno:string,nombre_completo:string}}
     */
    public function verificar(string $dni, string $cv, string $claveLimite): array
    {
        if (!preg_match('/^\d{8}$/', $dni) || !preg_match('/^\d$/', $cv)) {
            return ['ok' => false, 'error' => 'El DNI debe tener 8 dígitos y el CV 1 dígito.'];
        }

        $clave = 'verificar-dni:' . $claveLimite;
        $max = (int) config('matricula.max_intentos_dni', 5);
        if (RateLimiter::tooManyAttempts($clave, $max)) {
            $minutos = (int) ceil(RateLimiter::availableIn($clave) / 60);
            return ['ok' => false, 'error' => "Demasiados intentos fallidos. Inténtalo nuevamente en {$minutos} minuto(s)."];
        }

        $datos = $this->consultar($dni, $cv);

        if (isset($datos['error'])) {
            if ($datos['cuenta_intento'] ?? true) {
                RateLimiter::hit($clave, 3600);
            }
            return ['ok' => false, 'error' => $datos['error']];
        }

        RateLimiter::clear($clave);
        $datos['nombre_completo'] = trim("{$datos['nombres']} {$datos['apellido_paterno']} {$datos['apellido_materno']}");

        return ['ok' => true, 'datos' => $datos];
    }

    private function consultar(string $dni, string $cv): array
    {
        if (app()->environment('local') && isset(self::PRUEBA[$dni]) && self::PRUEBA[$dni]['cv'] === $cv) {
            $d = self::PRUEBA[$dni];
            return ['dni' => $dni, 'nombres' => $d['nombres'], 'apellido_paterno' => $d['apellido_paterno'], 'apellido_materno' => $d['apellido_materno']];
        }

        $token = config('services.apis_peru.token');
        if (!$token) {
            Log::warning('APIS_PERU_TOKEN no configurado.');
            return ['error' => 'La verificación de DNI no está disponible en este momento.', 'cuenta_intento' => false];
        }

        try {
            $response = Http::timeout(10)->get("https://dniruc.apisperu.com/api/v1/dni/{$dni}", ['token' => $token]);
        } catch (\Throwable $e) {
            Log::error('Error RENIEC: ' . $e->getMessage());
            return ['error' => 'No pudimos conectar con RENIEC. Inténtalo nuevamente en unos minutos.', 'cuenta_intento' => false];
        }

        if (!$response->successful() || empty($response->json('nombres'))) {
            return ['error' => 'No encontramos ese DNI. Revisa el número.'];
        }

        if ((string) $cv !== (string) $response->json('codVerifica')) {
            return ['error' => 'El código de verificación (CV) no coincide con el DNI.'];
        }

        return [
            'dni' => $dni,
            'nombres' => (string) $response->json('nombres'),
            'apellido_paterno' => (string) $response->json('apellidoPaterno'),
            'apellido_materno' => (string) $response->json('apellidoMaterno'),
        ];
    }
}
