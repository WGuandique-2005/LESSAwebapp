<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationToken;
use App\Models\ResetToken;
use App\Mail\VerifyUser;
use App\Mail\AccountActivated;
use App\Mail\RestorePassword;
use App\Models\ResetTokenPass;
use App\Mail\UpdatePassword;
use App\Mail\PasswordUpdatedSuccesful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\DB; // <-- added DB facade

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
            // Iniciar transacción
            DB::beginTransaction();

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

            // Todo OK: confirmar transacción
            DB::commit();

            // 6) Redirigir al formulario de verificación
            return redirect()->route('verify.view')
                ->with('status', '¡Registro exitoso! Te hemos enviado un código de verificación a tu correo electrónico.');

        } catch (ValidationException $e) {
            // Asegurar rollback si algo falló después de iniciar la transacción
            try { DB::rollBack(); } catch (Exception $_) {}
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            // Intentar rollback y retornar error genérico
            try { DB::rollBack(); } catch (Exception $_) {}
            return back()->withInput()->with('error', 'Hubo un problema al intentar registrarte. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    /** Mostrar formulario para ingresar el código */
    public function showVerifyForm()
    {
        if (!session()->has('verify_user_id')) {
            return redirect()->route('signup')->with('error', 'Debes registrarte primero para verificar tu cuenta.');
        }
        $userId = session('verify_user_id');
        $user = User::find($userId);

        // Si el usuario no existe, limpiar sesión y redirigir
        if (!$user) {
            session()->forget('verify_user_id');
            return redirect()->route('signup')->with('error', 'Tu sesión de verificación ha expirado. Regístrate de nuevo.');
        }

        // Si el usuario no está activo y han pasado más de 5 minutos, eliminarlo y limpiar sesión
        if (!$user->is_active && $user->created_at->addMinutes(5)->isPast()) {
            VerificationToken::where('user_id', $userId)->delete();
            $user->delete();
            session()->forget('verify_user_id');
            return redirect()->route('signup')->with('error', 'Tu registro expiró por inactividad. Por favor, regístrate de nuevo.');
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

            if (!$userId) {
                return redirect()->route('signup')->with('error', 'Sesión de verificación expirada o inválida. Por favor, regístrate de nuevo.');
            }

            // 2) Recuperar el registro de token (si existe)
            $record = VerificationToken::where('user_id', $userId)
                ->where('token', $request->token)
                ->first();

            if (!$record) {
                throw ValidationException::withMessages(['token' => 'El código de verificación es inválido o ha expirado. Por favor, solicita uno nuevo.3']);
            }

            // 3) Verificar expiración (>24h)
            if (Carbon::parse($record->created_at)->addHours(2)->isPast()) {
                $record->delete();
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
                \Log::error('Error enviando codigo a tu email: ' . $mailException->getMessage());
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

            $user = User::find($userId);

            // Si el usuario no existe o expiró, limpiar sesión y redirigir
            if (!$user || (!$user->is_active && $user->created_at->addMinutes(5)->isPast())) {
                VerificationToken::where('user_id', $userId)->delete();
                if ($user) $user->delete();
                session()->forget('verify_user_id');
                return redirect()->route('signup')->with('error', 'Tu registro expiró por inactividad. Por favor, regístrate de nuevo.');
            }

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

        if (!$user) {
            throw ValidationException::withMessages([
                'loginError' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        }

        if (!$user->is_active) {
            return back()->withInput($request->only('email'))
                ->with('error', 'Tu cuenta no ha sido activada. Por favor, verifica tu correo electrónico.');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('status', '¡Bienvenido de nuevo!');
        }

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
                'email' => 'required|email|exists:users,email',
            ]);

            $user = User::where('email', $request->email)->first();

            // Generar token de 6 caracteres
            $token = Str::upper(Str::random(6));

            // Eliminar tokens anteriores y crear nuevo
            ResetTokenPass::where('user_id', $user->id)->delete();
            ResetTokenPass::create([
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            // Guardar user_id en sesión para el proceso de reseteo
            session(['reset_user_id' => $user->id]);

            // Enviar correo
            if ($user->es_google_oauth) {
                return back()->withInput()->with('error', 'Error al encontrar el correo, intentalo otra vez.');
            }
            else{
                Mail::to($user->email)->send(new RestorePassword($user, $token));
                return back()->with('status', 'Se ha enviado un código de recuperación de contraseña a tu correo electrónico.');
            }
        } catch (ValidationException $e) {
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
            $userId = session('reset_user_id');

            if (!$userId) {
                throw ValidationException::withMessages(['token' => 'Sesión expirada. Por favor, solicita un nuevo código.']);
            }
            $request->validate([
                'token' => 'required|string|size:6',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'token.size' => 'El código de recuperación debe tener 6 dígitos.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
            ]);

            $user = User::find($userId);

            // SI el correo no está registrado, lanzar excepción
            if (!$user) {
                throw ValidationException::withMessages(['email' => 'Usuario no encontrada.']);
            }
            // Validar que la contraseña sea diferente a la actual
            if (password_verify($request->password, $user->password)) {
                throw ValidationException::withMessages(['password' => 'La nueva contraseña no puede ser la misma que la actual.']);
            }
            // Verificar que la contraseña y la confirmación coincidan
            if ($request->password !== $request->password_confirmation) {
                throw ValidationException::withMessages(['password_confirmation' => 'Las contraseñas no coinciden.']);
            }
            // Verificar si el usuario tiene un token de reseteo
            $record = ResetTokenPass::where('user_id', $user->id)
                ->where('token', $request->token)
                ->first();

            if (!$record) {
                throw ValidationException::withMessages(['token' => 'El código de recuperación es inválido.']);
            }

            // Verificar expiración (2h)
            if (Carbon::parse($record->created_at)->addHours(2)->isPast()) {
                $record->delete(); // Borrar el token expirado
                throw ValidationException::withMessages(['token' => 'El código de recuperación ha expirado. Por favor, solicita uno nuevo.']);
            }

            // Cambiar contraseña y borrar token
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            $record->delete();
            session()->forget('reset_user_id');
            // Enviar correo de confirmación de cambio de contraseña
            Mail::to($user->email)->send(new PasswordUpdatedSuccesful($user));
            return redirect()->route('login')->with('status', '¡Contraseña actualizada con éxito! Ahora puedes iniciar sesión con tu nueva contraseña.');

        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Hubo un problema al restablecer tu contraseña. Por favor, inténtalo de nuevo.');
        }
    }

    /** Mostrar perfil de usuario */
    public function showProfile()
    {
        try {
            // Verificar si el usuario está autenticado
            if (!Auth::check()) {
                return redirect()->route('login')
                    ->with('error', 'Debes iniciar sesión para ver tu perfil.');
            }
            // Obtener el usuario autenticado
            $user = Auth::user();
            return view('userProfile', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Hubo un problema al acceder a tu perfil. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    /** 
     * Mostrar el formulario de edición de perfil 
     */
    public function showEditProfileForm()
    {
        try{
            // Verificar si el usuario está autenticado
            if (!Auth::check()) {
                return redirect()->route('login')
                    ->with('error', 'Debes iniciar sesión para editar tu perfil.');
            }
            else {
                // Obtener el usuario autenticado
                $user = Auth::user();
                return view('editProfile', compact('user'));
            }
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Hubo un problema al acceder a tu perfil. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    /** 
     * Procesar actualización de nombre y username 
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')
                    ->with('error', 'Debes iniciar sesión para actualizar tu perfil.');
            }

            // Validar datos
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            ]);

            // Actualizar usuario
            $user->update($data);

            return redirect()->route('profile')
                ->with('status', 'Perfil actualizado exitosamente.');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()
                ->with('error', 'Hubo un problema al actualizar tu perfil. Por favor, inténtalo de nuevo.');
        }
    }

    public function showChangePasswordForm()
    {
        return view('changePassword');
    }
    public function changePassword(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
            }

            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ], [
                'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
                'new_password.confirmed' => 'Las contraseñas no coinciden.',
            ]);

            if (!password_verify($request->current_password, $user->password)) {
                throw ValidationException::withMessages(['current_password' => 'La contraseña actual es incorrecta.']);
            }

            if (password_verify($request->new_password, $user->password)) {
                throw ValidationException::withMessages(['new_password' => 'La nueva contraseña no puede ser la misma que la actual.']);
            }

            $user->update(['password' => bcrypt($request->new_password)]);

            return redirect()->route('profile')
                ->with('status', '¡Contraseña cambiada exitosamente!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'No se pudo cambiar la contraseña. Intenta más tarde.');
        }
    }

    /** Cerrar sesión */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->flush();
            $request->session()->regenerateToken();
            return redirect('/')->with('status', 'Has cerrado sesión exitosamente.');
        } catch (Exception $e) {
            return back()->with('error', 'Hubo un problema al cerrar sesión. Por favor, inténtalo de nuevo.');
        }
    }

    /**
     * Método para destruir
     */
    public function destroy(){
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión para eliminar tu cuenta.');
            }

            // Eliminar el usuario
            $user->delete();
            // ELiminar los tokens asociados
            VerificationToken::where('user_id', $user->id)->delete();
            ResetToken::where('user_id', $user->id)->delete();
            ResetTokenPass::where('user_id', $user->id)->delete();

            // Redirigir a la página de inicio con mensaje de éxito
            return redirect('/')->with('status', 'Tu cuenta ha sido eliminada exitosamente.');
        } catch (Exception $e) {
            return back()->with('error', 'Hubo un problema al eliminar tu cuenta. Por favor, inténtalo de nuevo más tarde.');
        }
    }
}