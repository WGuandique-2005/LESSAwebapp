<?php

namespace App\Models;

use finfo;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    protected $fillable = [
        'nivel_id',
        'titulo',
        'descripcion',
        'completada',
        'fecha_completada'
    ];

    public function nivel(){
        return $this->belongsTo(Nivel::class);
    }

    public function usuarios(){
        return $this->hasMany(ProgresoUsuario::class);
    }
}
