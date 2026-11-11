<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entorno extends Model
{
    protected $table = 'entornos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'activo'];
    
    public $timestamps = false;
}