<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';
    public $timestamps = true;

    protected $fillable = [
        'id_apoderado',
        'nombre',
        'apellido',
        'dni',
        'email',
        'telefono',
        'genero',
        'fecha_nacimiento',
        'usuario',
        'contrasena',
    ];

    protected $hidden = ['contrasena'];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function apoderado()
    {
        return $this->belongsTo(Apoderado::class, 'id_apoderado', 'id_apoderado');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_alumno', 'id_alumno');
    }

    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }
}