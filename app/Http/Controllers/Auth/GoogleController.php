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
use GuzzleHttp\Exception\GuzzleException;
use Laravel\Socialite\Two\InvalidStateException;
use Throwable;

class GoogleController extends Controller
{
    
    public function redirectToGoogle(): RedirectResponse
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (InvalidStateException $e) {
            Log::error("Error CSRF con Google OAuth: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->with('google', 'Problema de seguridad al conectar con Google. Intenta nuevamente.');
        } catch (GuzzleException $e) {
            Log::error("Error de conexión con Google: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->with('google', 'No se pudo conectar con Google. Verifica tu red o intenta más tarde.');
        } catch (Throwable $e) {
            Log::error("Error general en redirectToGoogle: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->with('google', 'Ocurrió un error al redirigir a Google. Inténtalo más tarde.');
        }
    }

    /**
     * Maneja el callback después de autenticarse con Google.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('oauth_id', $googleUser->getId())->first();

            if (! $user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    $user->update([
                        'oauth_id' => $googleUser->getId(),
                        'es_google_oauth' => true,
                    ]);
                } else {
                    $user = User::create([
                        'name'            => $googleUser->getName(),
                        'username'        => Str::slug($googleUser->getName()) . Str::random(3),
                        'email'           => $googleUser->getEmail(),
                        'password'        => bcrypt(Str::random(16)),
                        'oauth_id'        => $googleUser->getId(),
                        'es_google_oauth' => true,
                        'is_active'       => true,
                    ]);
                }
            }

            if ($user->wasRecentlyCreated) {
                try {
                    Mail::to($user->email)->send(new AccountActivated($user));
                } catch (Throwable $mailEx) {
                    Log::warning("Fallo el envio de correo a {$user->email}: " . $mailEx->getMessage());
                }
            }

            Auth::login($user, true);

            return redirect()
                ->route('home')
                ->with('status', 'Bienvenido(a), ' . $user->name . '. Has iniciado sesión con Google correctamente.');

        } catch (InvalidStateException $e) {
            Log::error("Callback CSRF error: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->with('google', 'No se pudo validar la respuesta de Google. Inténtalo de nuevo.');
        } catch (GuzzleException $e) {
            Log::error("Callback conexión fallida: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->with('google', 'Problemas de conexión con Google. Por favor, reintenta más tarde.');
        } catch (Throwable $e) {
            Log::error("Callback error general: " . $e->getMessage());
            return redirect()
                ->route('login')
                ->with('google', 'Ocurrió un error al iniciar sesión con Google.');
        }
    }
}