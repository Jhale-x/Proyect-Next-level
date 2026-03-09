<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveles';
    protected $primaryKey = 'id_nivel';

    protected $fillable = ['nivel'];

    public function grados()
    {
        return $this->hasMany(Grado::class, 'id_nivel');
    }
}
