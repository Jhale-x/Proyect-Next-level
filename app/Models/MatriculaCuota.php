<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatriculaCuota extends Model
{
    protected $table = 'matricula_cuotas';

    protected $fillable = [
        'matricula_id',
        'cuota_id',
        'numero',
        'nombre',
        'fecha_vencimiento',
        'monto',
        'estado',
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
        'monto' => 'decimal:2',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    public function cuota()
    {
        return $this->belongsTo(Cuota::class, 'cuota_id');
    }
}