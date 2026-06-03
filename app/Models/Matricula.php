<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';

    protected $fillable = [
        'id_alumno',
        'año_academico',
        'modalidad',
        'eleccion',
        'ciclo_grado',
        'sede',
        'entorno',
        'turno',
        'fecha_registro'
    ];

    public $timestamps = false;

    // Relaciones
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }
}