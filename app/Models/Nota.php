<?php
// app/Models/PromedioETI.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromedioETI extends Model
{
    protected $table = 'promedios_eti';
    protected $primaryKey = 'id_promedio';
    
    protected $fillable = [
        'id_alumno',
        'id_curso',
        'promedio_final',
        'semana_completada',
        'fecha_registro'
    ];
    
    protected $casts = [
        'promedio_final' => 'decimal:2',
        'fecha_registro' => 'date'
    ];
    
    // Relación con Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }
    
    // Relación con Curso
    public function curso()
    {
        return $this->belongsTo(Course::class, 'id_curso');
    }
}