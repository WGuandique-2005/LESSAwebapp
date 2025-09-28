<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecompensasUsuario extends Model
{
    protected $fillable = [
        'usuario_id',
        'recompensa_id',
        'estado'
    ];

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function recompensa(){
        return $this->belongsTo(Recompensa::class);
    }
}
