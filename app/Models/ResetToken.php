<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetToken extends Model
{
    protected $fillable = [
        'user_id',
        'token'
    ];
}
