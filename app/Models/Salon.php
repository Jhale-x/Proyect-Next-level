<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;

class Salon extends Model
{
    protected $table = 'salones';
    protected $primaryKey = 'id_salon';

    protected $fillable = [
        'id_nivel',
        'id_grado',
        'id_seccion',
        'id_facultad'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel', 'id_nivel');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado', 'id_grado');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'id_seccion', 'id_seccion');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'id_facultad', 'id_facultad');
    }

    public function docentes()
    {
        return $this->belongsToMany(
            User::class,
            'docente_salon',
            'id_salon',
            'id_usuario'
        )->withPivot('id_curso')->withTimestamps();
    }
    public function getNombreCompletoAttribute()
    {
        return $this->nivel->nivel . ' - ' . $this->grado->grado . ' ' . $this->seccion->seccion;
    }
}
