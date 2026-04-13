<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table = 'cuotas';
    protected $primaryKey = 'id';
    protected $fillable = ['ciclo_id', 'numero', 'nombre', 'fecha_vencimiento', 'monto', 'orden', 'activo'];
    public $timestamps = false;
}