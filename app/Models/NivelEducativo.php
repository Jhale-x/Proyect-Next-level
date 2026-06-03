<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelEducativo extends Model
{
    protected $table = 'niveles_educativos';
    protected $primaryKey = 'id_nivel';
    protected $fillable = ['nombre', 'orden'];

    public $timestamps = false;
}