<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntosUsuario extends Model
{
    protected $fillable = [
        'usuario_id',
        'nivel_id',
        'puntos_obtenidos'
    ];

    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
