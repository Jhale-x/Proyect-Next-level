<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $table = 'ciclos';
    protected $primaryKey = 'id_ciclo';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'id_modalidad',
        'id_sede',
        'id_entorno',
        'id_turno',
        'id_nivel',
        'id_grado',
        'id_seccion',
        'id_universidad',
        'id_tipo_ciclo',
        'activo',
        'id_salon',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean',
    ];

    public function cuotas()
    {
        return $this->hasMany(Cuota::class, 'id_ciclo', 'id_ciclo');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_ciclo', 'id_ciclo');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id');
    }

    public function entorno()
    {
        return $this->belongsTo(Entorno::class, 'id_entorno', 'id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'id_turno', 'id_turno');
    }

    public function universidad()
    {
        return $this->belongsTo(Universidade::class, 'id_universidad', 'id_universidad');
    }

    public function tipoCiclo()
    {
        return $this->belongsTo(TipoCiclo::class, 'id_tipo_ciclo', 'id_tipo_ciclo');
    }

    public function nivelEducativo()
    {
        return $this->belongsTo(NivelEducativo::class, 'id_nivel', 'id');
    }

    /**
     * Concepto que se cobra al matricularse: la cuota llamada "Matrícula"
     * o, si no existe, la primera cuota del ciclo.
     */
    public function conceptoMatricula(): ?Cuota
    {
        return $this->cuotas()
            ->orderByRaw("CASE WHEN nombre = 'Matrícula' THEN 0 ELSE 1 END")
            ->orderBy('orden')
            ->orderBy('numero')
            ->orderBy('id_cuota')
            ->first();
    }
}