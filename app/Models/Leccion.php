<?php

namespace App\Models;

use finfo;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    protected $table = 'lecciones';
    protected $fillable = [
        'leccion_id',
        'titulo',
    ];

    public function usuarios(){
        return $this->hasMany(ProgresoUsuario::class);
    }
}
