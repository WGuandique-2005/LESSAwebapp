<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResetTokenPass extends Model
{
    protected $table = 'reset_tokens'; 

    public $timestamps = false;
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'user_id',
        'token',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
