<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumno extends Authenticatable
{
    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';

    protected $fillable = [
        'id_salon',
        'id_apoderado',
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'usuario',
        'contraseña',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function apoderado()
    {
        return $this->belongsTo(Apoderado::class, 'id_apoderado');
    }
}
