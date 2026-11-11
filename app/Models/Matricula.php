<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public const ESTADO_PENDIENTE = 'pendiente';
    public const ESTADO_PAGADA = 'pagada';
    public const ESTADO_CANCELADA = 'cancelada';

    public const ESTADOS = [self::ESTADO_PENDIENTE, self::ESTADO_PAGADA, self::ESTADO_CANCELADA];

    // Resultado del pago en la pasarela (columna estado_pago)
    public const PAGO_PENDIENTE = 'pendiente';
    public const PAGO_PAGADO = 'pagado';
    public const PAGO_FALLIDO = 'fallido';

    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';
    public $timestamps = false; // La tabla usa fecha_registro, no created_at/updated_at

    protected $fillable = [
        'id_alumno',
        'id_ciclo',
        'codigo',
        'año_academico',
        'modalidad',
        'eleccion',
        'ciclo_grado',
        'sede',
        'entorno',
        'turno',
        'monto_total',
        'estado',
        'estado_pago',
        'monto_pagado',
        'id_transaccion',
        'numero_pedido',
        'ultimo_error_pago',
        'fecha_registro',
        'fecha_expiracion',
        'fecha_pago',
        'correo_enviado_at',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
        'fecha_expiracion' => 'datetime',
        'fecha_pago' => 'datetime',
        'correo_enviado_at' => 'datetime',
        'monto_total' => 'decimal:2',
        'monto_pagado' => 'decimal:2',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'id_ciclo', 'id_ciclo');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_matricula', 'id_matricula');
    }

    public function conversacion()
    {
        return $this->hasOne(ConversacionChatbot::class, 'matricula_id', 'id_matricula');
    }

    /**
     * Matrículas que aún bloquean una nueva inscripción al mismo ciclo:
     * pagadas, o pendientes cuyo plazo de pago no ha vencido.
     */
    public function scopeVigentes($query)
    {
        return $query->where(function ($q) {
            $q->where('estado', self::ESTADO_PAGADA)
              ->orWhere(function ($q) {
                  $q->where('estado', self::ESTADO_PENDIENTE)
                    ->where(function ($q) {
                        $q->whereNull('fecha_expiracion')->orWhere('fecha_expiracion', '>', now());
                    });
              });
        });
    }

    public static function generarCodigo(int $idMatricula): string
    {
        return 'NL-' . date('Y') . '-' . str_pad($idMatricula, 6, '0', STR_PAD_LEFT);
    }

    public function getEstaVencidaAttribute(): bool
    {
        return $this->estado === self::ESTADO_PENDIENTE
            && $this->fecha_expiracion
            && $this->fecha_expiracion->isPast();
    }

    /** Estado para mostrar: una pendiente fuera de plazo se muestra como "vencida". */
    public function getEstadoVisibleAttribute(): string
    {
        return $this->esta_vencida ? 'vencida' : $this->estado;
    }

    public function getAlumnoNombreCompletoAttribute()
    {
        return $this->alumno
            ? $this->alumno->nombre . ' ' . $this->alumno->apellido
            : 'Sin alumno';
    }
}
