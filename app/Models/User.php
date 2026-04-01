<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_usuario';

    public $timestamps = true;

    protected $fillable = [
        'id_curso',
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'usuario',
        'contrasena',
        'foto',
        'rol'
    ];

    protected $hidden = ['contrasena'];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    public function salones()
    {
        return $this->belongsToMany(
            Salon::class,
            'docente_salon',
            'id_usuario',
            'id_salon'
        )->withPivot('id_curso')->withTimestamps();
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
