<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Notificación recibida de la pasarela de pagos (auditoría e idempotencia). */
class WebhookEvento extends Model
{
    protected $table = 'webhook_eventos';

    protected $fillable = [
        'pasarela',
        'id_evento',
        'tipo',
        'id_objeto',
        'id_matricula',
        'resultado',
        'detalle',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
