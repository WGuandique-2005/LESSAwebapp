<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Mail\AccountActivated;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Exception\GuzzleException;
use Laravel\Socialite\Two\InvalidStateException;
use Throwable;

class GoogleController extends Controller
{
    /**
     * 1. Redirige a Google para autenticación.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (InvalidStateException $e) {
            // Este error suele ocurrir si el estado CSRF no coincide.
            Log::error("Socialite InvalidStateException: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->withErrors(['google' => 'Hubo un problema de seguridad al conectar con Google. Por favor, inténtalo de nuevo.']);
        } catch (GuzzleException $e) {
            // Errores de Guzzle (p. ej. timeout o fallo de conexión HTTP)
            Log::error("Socialite GuzzleException: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->withErrors(['google' => 'No se pudo establecer conexión con Google. Por favor, verifica tu conexión e inténtalo más tarde.']);
        } catch (Throwable $e) {
            // Cualquier otra excepción inesperada
            Log::error("Error inesperado en redirectToGoogle: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->withErrors(['google' => 'Error al intentar iniciar sesión con Google. Por favor, inténtalo de nuevo más tarde.']);
        }
    }

    /**
     * 2. Maneja el callback de Google.
     *    Crea o actualiza el usuario en la base de datos, envía correo de bienvenida si es nuevo
     *    y finalmente inicia sesión.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            // Obtener datos del usuario desde Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Buscar usuario por oauth_id
            $user = User::where('oauth_id', $googleUser->getId())->first();

            if (! $user) {
                // Si no existe, buscar por email (puede haber register manualmente)
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Si el usuario ya existía por email, solo actualizamos oauth_id
                    $user->update([
                        'oauth_id'        => $googleUser->getId(),
                        'es_google_oauth' => true,
                    ]);
                } else {
                    // No existe ni por oauth_id ni por email: creamos nuevo
                    $user = User::create([
                        'name'            => $googleUser->getName(),
                        'username'        => Str::slug($googleUser->getName()) . Str::random(3),
                        'email'           => $googleUser->getEmail(),
                        'password'        => bcrypt(Str::random(16)), // contraseña aleatoria
                        'oauth_id'        => $googleUser->getId(),
                        'es_google_oauth' => true,
                        'is_active'       => true, // activamos directamente al venir de Google
                    ]);
                }
            }

            // Si el usuario fue recién creado, enviamos correo de bienvenida
            if ($user->wasRecentlyCreated) {
                try {
                    Mail::to($user->email)->send(new AccountActivated($user));
                } catch (Throwable $mailEx) {
                    // Si falla el envío de correo, lo registramos pero no abortamos el login
                    Log::error("Error enviando correo de bienvenida a {$user->email}: " . $mailEx->getMessage());
                }
            }

            // Una vez exista el usuario (nuevo o actualizado), iniciamos sesión
            Auth::login($user, true);

            return redirect()
                ->route('home')
                ->with('status', 'Bienvenido(a), ' . $user->name . '. Has iniciado sesión con Google correctamente.');

        } catch (InvalidStateException $e) {
            // Token de estado CSRF inválido
            Log::error("Socialite InvalidStateException en callback: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->withErrors(['google' => 'No se pudo validar la respuesta de Google. Vuelve a intentarlo.']);
        } catch (GuzzleException $e) {
            // Error de HTTP (por ejemplo, timeout)
            Log::error("GuzzleException en handleGoogleCallback: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->withErrors(['google' => 'Hubo un problema de comunicación con Google. Por favor, inténtalo más tarde.']);
        } catch (Throwable $e) {
            // Cualquier otro error inesperado
            Log::error("Error inesperado en handleGoogleCallback: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->withErrors(['google' => 'Ocurrió un error al iniciar sesión con Google. Inténtalo de nuevo.']);
        }
    }
}
