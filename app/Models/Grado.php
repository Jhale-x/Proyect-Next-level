<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';
    protected $primaryKey = 'id_grado';

    protected $fillable = [
        'grado',
        'id_nivel'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel');
    }

    public function salones()
    {
        return $this->hasMany(Salon::class, 'id_grado');
    }
}
