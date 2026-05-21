<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Alumno extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';
    
    protected $fillable = [
        'id_apoderado',
        'id_salon',
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'usuario',
        'contrasena',
        'qr',
    ];
    
    protected $hidden = [
        'contrasena',
    ];
    
    // Para que Auth use el campo correcto
    public function getAuthPassword()
    {
        return $this->contrasena;
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
    public function promediosETI()
    {
        return $this->hasMany(PromedioETI::class, 'id_alumno');
    }
    
    public function promedioETIByCurso($cursoId)
    {
        return $this->hasOne(PromedioETI::class, 'id_alumno')
                    ->where('id_curso', $cursoId);
    }
}