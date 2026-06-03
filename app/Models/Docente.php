<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docente_curso';
    protected $primaryKey = 'id_docente_curso';

    protected $fillable = ['id_docente_salon', 'id_curso'];

    public $timestamps = false;

    public function docenteSalon()
    {
        return $this->belongsTo(Docente::class, 'id_docente_salon');
    }

    public function curso()
    {
        return $this->belongsTo(Course::class, 'id_curso');
    }
}