<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversacionChatbot extends Model
{
    protected $table = 'conversaciones_chatbot';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'matricula_id',
        'session_id',
        'mensajes',
        'datos_recolectados',
        'estado',
        'paso_actual',
        'intencion_actual',
        'ip_usuario',
        'user_agent',
        'ultimo_mensaje',
    ];

    protected $casts = [
        'mensajes' => 'array',
        'datos_recolectados' => 'array',
        'ultimo_mensaje' => 'datetime',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'id_matricula');
    }
}