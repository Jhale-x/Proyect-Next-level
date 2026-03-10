<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';
    protected $primaryKey = 'id_facultad';

    protected $fillable = ['facultad'];

    public function salones()
    {
        return $this->hasMany(Salon::class, 'id_facultad', 'id_facultad');
    }
}
