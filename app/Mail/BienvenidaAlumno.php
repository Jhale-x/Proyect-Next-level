<?php

namespace App\Mail;

use App\Models\Alumno;
use App\Models\Matricula;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Correo de bienvenida que se envía cuando se verifica el pago de la matrícula.
 * Incluye las credenciales de acceso del alumno.
 */
class BienvenidaAlumno extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Alumno $alumno,
        public Matricula $matricula,
        public string $password
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎓 ¡Bienvenido a Next Level! - Pago confirmado y credenciales de acceso',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bienvenida-alumno',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
