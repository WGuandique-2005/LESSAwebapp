<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntosUsuario extends Model
{
    protected $fillable = [
        'usuario_id',
        'puntos'
    ];

    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
