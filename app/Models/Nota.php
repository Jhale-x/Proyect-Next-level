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
        'nota',
    ];
}
