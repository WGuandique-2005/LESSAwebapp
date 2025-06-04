<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Mail\AccountActivated;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Exception;


class GoogleController extends Controller
{
    // 1. Redirige a Google
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            // Maneja el error de redirección
            throw ValidationException::withMessages(['google' => 'Error al redirigir a Google: ' . $e->getMessage()]);
        } catch (Exception $e) {
            // Maneja cualquier otro error
            return redirect()->route('login')->withErrors(['google' => 'Error al iniciar sesión con Google: ' . $e->getMessage()]);
        }
    }

    // 2. Maneja el callback de Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Busca usuario por oauth_id
            $user = User::where('oauth_id', $googleUser->getId())->first();

            // Si no lo encuentra por oauth_id, intenta por email (puede haber sido creado manualmente antes)
            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Si el usuario existe por email, actualiza el oauth_id
                    $user->update([
                        'oauth_id' => $googleUser->getId()
                    ]);
                } else {
                    // Si no existe ni por email, lo crea
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'username' => Str::slug($googleUser->getName()) . Str::random(3),
                        'email' => $googleUser->getEmail(),
                        'password' => bcrypt(Str::random(16)),
                        'oauth_id' => $googleUser->getId(),
                        'es_google_oauth' => true, // Indica que es un usuario de Google OAuth
                        'is_active' => true, // Asumimos que el usuario está activo al registrarse con Google
                    ]);
                }
            }
            // Mandar correo de bienvenida si es un nuevo usuario
            if ($user->wasRecentlyCreated) {
                // Enviar correo de bienvenida
                \Mail::to($user->email)->send(new AccountActivated($user));
            }
            // Inicia sesión
            Auth::login($user, true);

            // Redirige a home
            return redirect()->route('home')->with('status', 'Bienvenido, ' . $user->name . '! Has iniciado sesión con Google correctamente.');
        } catch (Exception $e) {
            // Maneja el error del callback
            throw ValidationException::withMessages(['google' => 'Error al manejar el callback de Google: ' . $e->getMessage()]);
        } catch (Exception $e) {
            // Maneja cualquier otro error
            return back()->withErrors(['google' => 'Error al iniciar sesión con Google: ' . $e->getMessage()]);
        }
    }
}
