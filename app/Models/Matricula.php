<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'id_alumno',
        'id_salon',
        'anio_academico',
        'estado' // activo, retirado, etc.
    ];

    // Relación con Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    // Relación con Salón
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_salon');
    }
}