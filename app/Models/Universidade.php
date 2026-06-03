<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universidade extends Model
{
    protected $table = 'universidades';
    protected $primaryKey = 'id_universidad';
    protected $fillable = ['nombre', 'slug', 'logo_url'];

    public $timestamps = false;
}