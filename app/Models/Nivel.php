<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function lecciones(){
        return $this->hasMany(Leccion::class);
    }
}
