<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCiclo extends Model
{
    protected $table = 'tipos_ciclo';
    protected $primaryKey = 'id_tipo_ciclo';
    protected $fillable = ['nombre', 'duracion_meses'];
    
    public $timestamps = false;
}