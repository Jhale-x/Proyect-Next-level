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
        'contrasena',
        'qr'
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

    // --- RELACIONES ---

    // ESTA ES LA QUE CAUSABA EL ERROR
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_salon', 'id_salon');
    }

    public function apoderado()
    {
        return $this->belongsTo(Apoderado::class, 'id_apoderado', 'id_apoderado');
    }

    public function setContrasenaAttribute(string|null $value): void
    {
        if ($value === null || $value === '') {
            $this->attributes['contrasena'] = $value;
            return;
        }

        $this->attributes['contrasena'] = password_get_info($value)['algo']
            ? $value
            : Hash::make($value);
    }
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id_apoderado', 'id_apoderado');
    }
}
