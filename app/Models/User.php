<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'oauth_id',
        'is_active',
        'es_google_oauth',
    ];

    public function lecciones()
    {
        return $this->hasMany(ProgresoUsuario::class);
    }

    public function puntos()
    {
        return $this->hasMany(PuntosUsuario::class, 'usuario_id');
    }

    public function recompensas()
    {
        return $this->hasMany(RecompensasUsuario::class, foreignKey: 'usuario_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'es_google_oauth' => 'boolean',
        ];
    }
}
