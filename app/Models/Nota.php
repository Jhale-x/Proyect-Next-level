<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    protected $primaryKey = 'id_nota';

    protected $fillable = [
        'id_alumno',
        'id_curso_actividad',
        'nota'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    public function cursoActividad()
    {
        return $this->belongsTo(CursoActividad::class, 'id_curso_actividad');
    }
}
