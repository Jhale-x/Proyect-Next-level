<?php
// app/Models/PromedioETI.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromedioETI extends Model
{
    protected $table = 'promedios_eta';
    protected $primaryKey = 'id_promedio';
    
    protected $fillable = [
        'id_alumno',
        'id_curso',
        'promedio_final',
        'semana_completada',
        'fecha_registro'
    ];
}