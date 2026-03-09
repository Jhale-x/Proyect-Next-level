<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Ajustamos los nombres de los campos según tu base de datos
    protected $fillable = [
        'id_emisor',     // id_usuario del que envía
        'id_receptor',   // id_usuario del que recibe (opcional si es por curso)
        'id_curso', 
        'contenido'
    ];

    // Relación con tu tabla users
    public function emisor()
    {
        return $this->belongsTo(User::class, 'id_emisor', 'id_usuario');
    }
}