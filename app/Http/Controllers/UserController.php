<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationToken;
use App\Models\ResetToken;
use App\Mail\VerifyUser;
use App\Mail\AccountActivated;
use App\Mail\RestorePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException; // Import for specific validation errors
use Exception; // For general exceptions

class UserController extends Controller
{
    /** Mostrar formulario de registro */
    public function showSignUpForm()
    {
        return view('signup');
    }

    /** Procesar registro y enviar código de verificación */
    public function register(Request $request)
    {
        try {
            // 1) Validar datos de registro
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // 2) Crear usuario con is_active = false
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'is_active' => false,
                'es_google_oauth' => false,
                'oauth_id' => null,
            ]);

            // 3) Generar token de 6 caracteres y guardarlo
            $token = Str::upper(Str::random(6));
            VerificationToken::create([
                'user_id' => $user->id,
                'token' => $token,
            ]);

            // 4) Enviar correo de verificación
            Mail::to($user->email)->send(new VerifyUser($user, $token));

            // 5) Guardar user_id en sesión para el siguiente paso
            session(['verify_user_id' => $user->id]);

            // 6) Redirigir al formulario de verificación
            return redirect()->route('verify.view')
                ->with('status', '¡Registro exitoso! Te hemos enviado un código de verificación a tu correo electrónico.');

        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Hubo un problema al intentar registrarte. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    /** Mostrar formulario para ingresar el código */
    public function showVerifyForm()
    {
        // Ensure that verify_user_id exists in session, otherwise redirect
        if (!session()->has('verify_user_id')) {
            return redirect()->route('signup')->with('error', 'Debes registrarte primero para verificar tu cuenta.');
        }
        return view('verifyAccount');
    }

    /** Procesar verificación del código */
    public function verifyAccount(Request $request)
    {
        try {
            // 1) Validar el token ingresado
            $request->validate([
                'token' => 'required|string|size:6',
            ]);

            $userId = session('verify_user_id');

            // Ensure user ID exists in session
            if (!$userId) {
                return redirect()->route('signup')->with('error', 'Sesión de verificación expirada o inválida. Por favor, regístrate de nuevo.');
            }

            // 2) Recuperar el registro de token (si existe)
            $record = VerificationToken::where('user_id', $userId)
                ->where('token', $request->token)
                ->first();

            if (!$record) {
                // Use ValidationException for specific field errors
                throw ValidationException::withMessages(['token' => 'El código de verificación es inválido.']);
            }

            // 3) Verificar expiración (>24h)
            if (Carbon::parse($record->created_at)->addHours(24)->isPast()) {
                $record->delete(); // Optionally delete expired tokens
                throw ValidationException::withMessages(['token' => 'El código de verificación ha expirado. Por favor, solicita uno nuevo.']);
            }

            // 4) Activar usuario y borrar el token
            $user = User::findOrFail($userId);
            $user->update(['is_active' => true]);
            $record->delete();

            // 5) Enviar correo de bienvenida (wrapped in try-catch for robustness)
            try {
                Mail::to($user->email)->send(new AccountActivated($user));
            } catch (Exception $mailException) {
                // Log the mail error but don't prevent user login
                \Log::error('Error sending account activated email: ' . $mailException->getMessage());
            }


            // 6) Limpiar sesión, loguear y redirigir a home
            session()->forget('verify_user_id');
            Auth::login($user);

            return redirect()->route('home')->with('status', '¡Cuenta activada con éxito! Bienvenido/a.');

        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Hubo un problema al verificar tu cuenta. Por favor, inténtalo de nuevo.');
        }
    }

    /** Reenviar un nuevo token de verificación */
    public function resendToken()
    {
        try {
            $userId = session('verify_user_id');

            if (!$userId) {
                return redirect()->route('signup')->with('error', 'No hay una cuenta pendiente de verificación en tu sesión. Por favor, regístrate de nuevo.');
            }

            $user = User::findOrFail($userId);

            // Eliminar tokens antiguos para este usuario
            VerificationToken::where('user_id', $userId)->delete();

            // Generar y guardar un nuevo token
            $token = Str::upper(Str::random(6));
            VerificationToken::create(['user_id' => $userId, 'token' => $token]);

            // Enviar de nuevo el correo de verificación
            Mail::to($user->email)->send(new VerifyUser($user, $token));

            return back()->with('status', 'Se ha enviado un nuevo código de verificación a tu correo electrónico.');

        } catch (Exception $e) {
            return back()->with('error', 'No se pudo reenviar el código de verificación. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    /** Mostrar formulario de login */
    public function showLoginForm()
    {
        return view('login');
    }

    /** Procesar login tradicional */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and if account is active
        if (!$user) {
            // Provide a generic error message to avoid exposing if an email exists
            throw ValidationException::withMessages([
                'loginError' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        }

        if (!$user->is_active) {
            return back()->withInput($request->only('email'))
                ->with('error', 'Tu cuenta no ha sido activada. Por favor, verifica tu correo electrónico.');
        }

        if (Auth::attempt($credentials)) {
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();
            return redirect()->route('home')->with('status', '¡Bienvenido de nuevo!');
        }

        // If Auth::attempt fails, it means password was incorrect
        throw ValidationException::withMessages([
            'loginError' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    /** Mostrar formulario de recuperación de contraseña */
    public function showRecuperarPassForm()
    {
        return view('recuperarPass');
    }

    /** Procesar envío de enlace de recuperación de contraseña */
    public function linkRecuperarPass(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email', // Validate email exists
            ]);

            $user = User::where('email', $request->email)->first();

            // Generar token de 6 caracteres
            $token = Str::upper(Str::random(6));

            // Eliminar tokens anteriores y crear nuevo
            ResetToken::where('user_id', $user->id)->delete();
            ResetToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => Carbon::now(), // Ensure created_at is set for expiration check
            ]);

            // Enviar correo
            Mail::to($user->email)->send(new RestorePassword($user, $token));

            return back()->with('status', 'Se ha enviado un código de recuperación de contraseña a tu correo electrónico.');

        } catch (ValidationException $e) {
            // For 'email' not found, Laravel's 'exists' rule will handle it
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Hubo un problema al enviar el código de recuperación. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    /** Mostrar formulario para establecer nueva contraseña */
    public function showNewPassForm()
    {
        return view('processNewPass');
    }

    /** Procesar cambio de contraseña */
    public function resetPassword(Request $request)
    {
        try {
            // 1. Validar entrada
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'token' => 'required|string|size:6',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // 2. Buscar usuario
            $user = User::where('email', $request->email)->first();
            // User existence already checked by 'exists:users,email' validation rule

            // 3. Buscar y verificar el token de reseteo
            $record = ResetToken::where('user_id', $user->id)
                ->where('token', $request->token)
                ->first();

            if (!$record) {
                throw ValidationException::withMessages(['token' => 'El código de recuperación es inválido.']);
            }

            // 4. Verificar expiración (2h)
            if (Carbon::parse($record->created_at)->addHours(2)->isPast()) {
                $record->delete(); // Optionally delete expired tokens
                throw ValidationException::withMessages(['token' => 'El código de recuperación ha expirado. Por favor, solicita uno nuevo.']);
            }

            // 5. Cambiar contraseña y borrar token
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            $record->delete(); // Delete the used token

            return redirect()->route('login')->with('status', '¡Contraseña actualizada con éxito! Ahora puedes iniciar sesión con tu nueva contraseña.');

        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Hubo un problema al restablecer tu contraseña. Por favor, inténtalo de nuevo.');
        }
    }

    // Ver perfil del usuario
    public function showProfile()
    {
        $user = Auth::user();
        // You might want to handle the case where user is not logged in, though middleware should prevent this.
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu perfil.');
        }
        return view('userProfile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        // Add logic here to handle profile updates if this route is for saving changes
        // Otherwise, if it's just to show the form, ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para editar tu perfil.');
        }
        return view('configAccount');
    }

    /** Cerrar sesión */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken(); // Regenerate CSRF token
            return redirect('/')->with('status', 'Has cerrado sesión exitosamente.');
        } catch (Exception $e) {
            return back()->with('error', 'Hubo un problema al cerrar sesión. Por favor, inténtalo de nuevo.');
        }
    }
}