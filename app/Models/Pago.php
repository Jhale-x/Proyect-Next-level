<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_matricula',
        'id_cuota',
        'monto',
        'fecha_pago',
        'comprobante',
        'estado',
        'verificado_por',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'monto' => 'decimal:2',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'id_matricula', 'id_matricula');
    }

    public function cuota()
    {
        return $this->belongsTo(Cuota::class, 'id_cuota', 'id_cuota');
    }
}
