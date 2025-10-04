<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $fillable = [
        'id',
        'nombre',
    ];

    public static function getTableColumns()
    {
        return \Schema::getColumnListing((new self)->getTable());
    }
}
