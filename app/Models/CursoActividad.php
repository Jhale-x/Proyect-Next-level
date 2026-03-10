<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class CursoActividad extends Model
{
    protected $table = 'curso_actividades';

    public function actividad()
    {
        return $this->belongsTo(Activity::class, 'id_actividad');
    }
}

