<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Alumno extends Authenticatable
{
    use Notifiable;

    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';

    protected $fillable = [
        'id_salon',
        'id_apoderado',
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'usuario',
        'contrasena'
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthIdentifierName()
    {
        return 'id_alumno';
    }

    // Relación con salón
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_salon', 'id_salon');
    }

    // Relación con apoderado
    public function apoderado()
    {
        return $this->belongsTo(Apoderado::class, 'id_apoderado', 'id_apoderado');
    }

    // Obtener cursos del alumno según su salón
    public function getCursos()
    {
        if (!$this->id_salon) {
            return collect();
        }
        
        return DocenteCurso::where('id_salon', $this->id_salon)
            ->with(['curso'])
            ->get();
    }
}