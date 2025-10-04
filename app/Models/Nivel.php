<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'completado',
        'fecha_completado',
        // agrega 'usuario_id' si existe en la tabla
    ];

    public static function getTableColumns()
    {
        return \Schema::getColumnListing((new self)->getTable());
    }
}
