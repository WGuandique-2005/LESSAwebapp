<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // 1. Redirige a Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Maneja el callback de Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Busca usuario por oauth_id
        $user = User::where('oauth_id', $googleUser->getId())->first();

        // Si no lo encuentra por oauth_id, intenta por email (puede haber sido creado manualmente antes)
        if (! $user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Si el usuario existe por email, actualiza el oauth_id
                $user->update([
                    'oauth_id' => $googleUser->getId()
                ]);
            } else {
                // Si no existe ni por email, lo crea
                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'username'  => Str::slug($googleUser->getName()) . Str::random(3),
                    'email'     => $googleUser->getEmail(),
                    'password'  => bcrypt(Str::random(16)),
                    'oauth_id'  => $googleUser->getId(),
                ]);
            }
        }

        // Inicia sesión
        Auth::login($user, true);

        // Redirige a home
        return redirect()->route('home');
    }
}
