<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresoUsuario extends Model
{
    protected $fillable = [
        'usuario_id',
        'leccion_id',
        'completado',
        'fecha_completada',
    ];

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function leccion(){
        return $this->belongsTo(Leccion::class);
    }
}
