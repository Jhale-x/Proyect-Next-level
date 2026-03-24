<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamacion extends Model
{
    protected $fillable = [
        'sede',
        'nivel',
        'nombres',
        'genero',
        'dni',
        'correo',
        'celular',
        'grado',
        'direccion',
        'tipo',
        'detalle',
        'pedido',
        'monto',
        'detalle_reclamo',
        'declaracion',
    ];
}

