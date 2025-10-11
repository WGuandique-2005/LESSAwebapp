<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recompensa extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'puntos_req',
        'url_imagen'
    ];

    public function usuarios(){
        return $this->hasMany(RecompensasUsuario::class);
    }
}
