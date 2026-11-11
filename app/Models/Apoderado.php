<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    protected $table = 'apoderados';
    protected $primaryKey = 'id_apoderado';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'correo',
        'fecha_nacimiento',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id_apoderado', 'id_apoderado');
    }
}