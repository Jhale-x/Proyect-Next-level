<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'id_emisor',
        'id_receptor',
        'emisor_tipo',
        'id_emisor_usuario',
        'id_emisor_alumno',
        'receptor_tipo',
        'id_receptor_usuario',
        'id_receptor_alumno',
        'id_curso',
        'id_curso_salon',
        'contenido'
    ];

    public function emisorUsuario()
    {
        return $this->belongsTo(User::class, 'id_emisor_usuario', 'id_usuario');
    }

    public function emisorAlumno()
    {
        return $this->belongsTo(Alumno::class, 'id_emisor_alumno', 'id_alumno');
    }
}
