<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Apoderado extends Authenticatable
{
    protected $table = 'apoderados';
    protected $primaryKey = 'id_apoderado';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni'
    ];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id_apoderado');
    }
}
