<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table = 'cuotas';
    protected $primaryKey = 'id_cuota';
    public $timestamps = true;

    protected $fillable = [
        'id_ciclo',
        'nombre',
        'numero',
        'monto',
        'fecha_vencimiento',
        'orden',
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
        'monto' => 'decimal:2',
    ];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'id_ciclo', 'id_ciclo');
    }
}