<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'id_curso';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_grado',
        'id_salon'
    ];
    
    public $timestamps = false;
}