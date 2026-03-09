<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = 'secciones';
    protected $primaryKey = 'id_seccion';

    protected $fillable = ['seccion'];

    public function salones()
    {
        return $this->hasMany(Salon::class, 'id_seccion', 'id_seccion');
    }
}
