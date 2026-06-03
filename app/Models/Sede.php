<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sedes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'direccion', 'activo'];
    public $timestamps = false;
}