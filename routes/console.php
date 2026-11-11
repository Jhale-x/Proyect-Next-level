<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// php artisan matricula:correo-prueba tu@correo.com
Artisan::command('matricula:correo-prueba {email}', function (string $email) {
    $servicio = app(\App\Services\CorreoService::class);
    $estado = $servicio->estado();
    $this->line("Envío: {$estado['mailer']} · Remitente: {$estado['remitente']} · Servidor: " . ($estado['servidor'] ?? '-'));
    $r = $servicio->enviarPrueba($email);
    $r['ok'] ? $this->info($r['mensaje']) : $this->error($r['mensaje']);
})->purpose('Envía un correo de prueba para comprobar la configuración MAIL_* del .env');

// ======================================================
// CUENTAS DEL PANEL DE MATRÍCULAS (/panel-matriculas)
// La contraseña se escribe en la terminal y nunca se muestra.
// ======================================================

// php artisan panel:crear-usuario secretaria --nombre="María López"
Artisan::command('panel:crear-usuario {usuario} {--nombre=}', function (string $usuario) {
    if (\App\Models\PersonalMatricula::where('usuario', $usuario)->exists()) {
        return $this->error("El usuario \"{$usuario}\" ya existe. Usa panel:cambiar-clave para cambiar su contraseña.");
    }

    $nombre = $this->option('nombre') ?: $this->ask('Nombre completo de la persona');
    $clave = $this->secret('Contraseña (mínimo 8 caracteres)');

    if (strlen((string) $clave) < 8 || $clave !== $this->secret('Repite la contraseña')) {
        return $this->error('La contraseña debe tener al menos 8 caracteres y coincidir. No se creó la cuenta.');
    }

    \App\Models\PersonalMatricula::create(['nombre' => $nombre, 'usuario' => $usuario, 'password' => $clave]);
    $this->info("Cuenta creada. Ingresa en " . rtrim(config('app.url'), '/') . "/panel-matriculas con el usuario \"{$usuario}\".");
})->purpose('Crea una cuenta para el panel de matrículas');

// php artisan panel:cambiar-clave secretaria
Artisan::command('panel:cambiar-clave {usuario}', function (string $usuario) {
    $personal = \App\Models\PersonalMatricula::where('usuario', $usuario)->first();
    if (!$personal) {
        return $this->error("No existe el usuario \"{$usuario}\".");
    }

    $clave = $this->secret('Nueva contraseña (mínimo 8 caracteres)');
    if (strlen((string) $clave) < 8 || $clave !== $this->secret('Repite la contraseña')) {
        return $this->error('La contraseña debe tener al menos 8 caracteres y coincidir. No se cambió.');
    }

    $personal->update(['password' => $clave]);
    $this->info("Contraseña de \"{$usuario}\" actualizada.");
})->purpose('Restablece la contraseña de una cuenta del panel de matrículas');

// php artisan panel:usuarios
Artisan::command('panel:usuarios', function () {
    $this->table(
        ['Usuario', 'Nombre', 'Activo', 'Último acceso'],
        \App\Models\PersonalMatricula::orderBy('usuario')->get()->map(fn ($p) => [
            $p->usuario, $p->nombre, $p->activo ? 'Sí' : 'No', $p->ultimo_acceso?->format('d/m/Y H:i') ?? '—',
        ])
    );
})->purpose('Lista las cuentas del panel de matrículas');

// php artisan panel:activar secretaria   |   php artisan panel:activar secretaria --no
Artisan::command('panel:activar {usuario} {--no : Desactiva la cuenta}', function (string $usuario) {
    $personal = \App\Models\PersonalMatricula::where('usuario', $usuario)->first();
    if (!$personal) {
        return $this->error("No existe el usuario \"{$usuario}\".");
    }

    $personal->update(['activo' => !$this->option('no')]);
    $this->info($this->option('no') ? "Cuenta \"{$usuario}\" desactivada." : "Cuenta \"{$usuario}\" activada.");
})->purpose('Activa o desactiva una cuenta del panel de matrículas');
