<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** Correo para comprobar que la configuración de envío funciona. */
class CorreoPrueba extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $estado)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: '✅ Prueba de correo - Next Level');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.correo-prueba');
    }
}
