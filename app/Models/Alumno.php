<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Alumno extends Authenticatable
{
    use Notifiable;

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
        'contrasena' // Sin Ñ, tal como está en tu phpMyAdmin
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthIdentifierName()
    {
        return 'id_alumno';
    }

    public function apoderado()
    {
        return $this->belongsTo(Apoderado::class, 'id_apoderado');
    }

    public function setContrasenaAttribute($value): void
    {
        if ($value === null || $value === '') {
            $this->attributes['contrasena'] = $value;
            return;
        }

        $this->attributes['contrasena'] = password_get_info($value)['algo']
            ? $value
            : Hash::make($value);
    }
}
