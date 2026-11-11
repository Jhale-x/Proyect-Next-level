<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/** Cuenta del panel de matrículas (separada de los usuarios de la intranet). */
class PersonalMatricula extends Authenticatable
{
    protected $table = 'personal_matricula';
    protected $primaryKey = 'id_personal';

    protected $fillable = [
        'nombre',
        'usuario',
        'password',
        'activo',
        'ultimo_acceso',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'activo' => 'boolean',
        'ultimo_acceso' => 'datetime',
        'password' => 'hashed',
    ];
}
