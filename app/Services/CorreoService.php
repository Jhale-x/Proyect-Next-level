<?php

namespace App\Services;

use App\Mail\CorreoPrueba;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Estado y prueba del envío de correos (configurado en .env, sección MAIL_*).
 */
class CorreoService
{
    /**
     * @return array{activo:bool, mailer:string, remitente:?string, servidor:?string, motivo:?string}
     */
    public function estado(): array
    {
        $mailer = (string) config('mail.default');
        $smtp = config('mail.mailers.smtp');

        $motivo = match (true) {
            in_array($mailer, ['log', 'array'], true) => 'El envío está en modo prueba (MAIL_MAILER=' . $mailer . '): los correos solo se guardan en storage/logs/laravel.log.',
            $mailer === 'smtp' && (empty($smtp['username']) || empty($smtp['password'])) => 'Faltan MAIL_USERNAME o MAIL_PASSWORD en el archivo .env.',
            default => null,
        };

        return [
            'activo' => $motivo === null,
            'mailer' => $mailer,
            'remitente' => config('mail.from.address'),
            'servidor' => $mailer === 'smtp' ? "{$smtp['host']}:{$smtp['port']}" : null,
            'motivo' => $motivo,
        ];
    }

    /**
     * Envía un correo de prueba.
     *
     * @return array{ok:bool, mensaje:string}
     */
    public function enviarPrueba(string $destino): array
    {
        $estado = $this->estado();

        try {
            Mail::to($destino)->send(new CorreoPrueba($estado));
        } catch (\Throwable $e) {
            Log::error('Correo de prueba falló: ' . $e->getMessage());
            return ['ok' => false, 'mensaje' => 'No se pudo enviar: ' . $this->explicarError($e->getMessage())];
        }

        return $estado['activo']
            ? ['ok' => true, 'mensaje' => "Correo de prueba enviado a {$destino} desde {$estado['remitente']}. Revisa la bandeja (y la carpeta de spam)."]
            : ['ok' => false, 'mensaje' => 'El correo NO salió: ' . $estado['motivo']];
    }

    /** Traduce los errores SMTP más comunes a algo accionable. */
    public function explicarError(string $error): string
    {
        $e = mb_strtolower($error);

        return match (true) {
            str_contains($e, '535') || str_contains($e, 'username and password not accepted') || str_contains($e, 'authentication')
                => 'el servidor rechazó el usuario o la contraseña. Con Gmail debes usar una "contraseña de aplicación" (no la contraseña normal) y tener activa la verificación en 2 pasos.',
            str_contains($e, 'timed out') || str_contains($e, 'connection could not be established') || str_contains($e, 'connection refused')
                => 'no hay conexión con el servidor de correo. Revisa MAIL_HOST/MAIL_PORT, tu internet o el firewall/antivirus.',
            str_contains($e, 'certificate') || str_contains($e, 'ssl')
                => 'problema de certificado SSL. Prueba MAIL_PORT=587 con MAIL_SCHEME=null, o MAIL_PORT=465 con MAIL_SCHEME=smtps.',
            str_contains($e, 'from') && str_contains($e, 'sender')
                => 'el remitente no es válido. Usa como MAIL_FROM_ADDRESS la misma cuenta de MAIL_USERNAME.',
            default => $error,
        };
    }
}
