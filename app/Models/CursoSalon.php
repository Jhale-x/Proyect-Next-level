<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoSalon extends Model
{
    protected $table = 'curso_salon';
    protected $primaryKey = 'id_curso_salon';

    public $timestamps = true;

    protected $fillable = [
        'id_curso',
        'id_salon'
    ];

    // 🔹 Relaciones
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_salon', 'id_salon');
    }

    public function curso()
    {
        return $this->belongsTo(Course::class, 'id_curso', 'id_curso');
    }
}