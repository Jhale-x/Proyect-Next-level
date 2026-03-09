<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'actividades';
    protected $primaryKey = 'id_actividad';

    protected $fillable = [
        'actividad',
        'descripcion'
    ];
}
