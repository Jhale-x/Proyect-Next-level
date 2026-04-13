<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Ciclo.php
class Ciclo extends Model
{
    protected $table = 'ciclos';
    protected $primaryKey = 'id_ciclo';
    
    protected $fillable = [
        'codigo', 'nombre', 'fecha_inicio', 'fecha_fin',
        'id_modalidad', 'id_sede', 'identorno', 'id_turno',
        'ident_nivel', 'id_grado', 'ident_seccion',
        'id_universidad', 'identipo_ciclo', 'activo'
    ];
    
    public $timestamps = false;
}