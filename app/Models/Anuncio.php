<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anuncio extends Model
{
    protected $table = 'anuncios';

    protected $fillable = [
        'titulo',
        'descripcion',
        'contenido',
        'imagen',
        'fecha_publicacion',
        'estado',
        'id_usuario',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    /**
     * User who created the announcement.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
