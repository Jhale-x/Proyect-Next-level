<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
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
