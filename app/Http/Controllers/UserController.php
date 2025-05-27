<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationToken;
use App\Mail\VerifyUser;
use App\Mail\AccountActivated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        // 1) Validar datos de registro
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2) Crear usuario con is_active = false
        $user = User::create([
            'name'      => $data['name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'is_active' => false,
            'es_google_oauth' => false, // No es OAuth
            'oauth_id'  => null, // No tiene OAuth ID
        ]);

        // 3) Generar token de 6 caracteres y guardarlo
        $token = Str::upper(Str::random(6));
        VerificationToken::create([
            'user_id' => $user->id,
            'token'   => $token,
        ]);

        // 4) Enviar correo de verificación
        Mail::to($user->email)->send(new VerifyUser($user, $token));

        // 5) Guardar user_id en sesión para el siguiente paso
        session(['verify_user_id' => $user->id]);

        // 6) Redirigir al formulario de verificación
        return redirect()->route('verify.view')
                        ->with('status', 'Te hemos enviado un código de verificación al correo.');
    }

    /** Mostrar formulario para ingresar el código */
    public function showVerifyForm()
    {
        return view('verifyAccount');
    }

    /** Procesar verificación del código */
    public function verifyAccount(Request $request)
    {
        // 1) Validar el token ingresado
        $request->validate([
            'token' => 'required|string|size:6',
        ]);

        $userId = session('verify_user_id');

        // 2) Recuperar el registro de token (si existe)
        $record = VerificationToken::where('user_id', $userId)
                                ->where('token', $request->token)
                                ->first();

        if (! $record) {
            return back()->withErrors(['token' => 'Código inválido.']);
        }

        // 3) Verificar expiración (>24 h)
        if (Carbon::parse($record->created_at)->addHours(24)->isPast()) {
            return back()
                ->withErrors(['token' => 'Código expirado.'])
                ->with('canResend', true);
        }

        // 4) Activar usuario y borrar el token
        $user = User::findOrFail($userId);
        $user->update(['is_active' => true]);
        $record->delete();

        // 5) Enviar correo de bienvenida
        Mail::to($user->email)->send(new AccountActivated($user));

        // 6) Limpiar sesión, loguear y redirigir a home
        session()->forget('verify_user_id');
        Auth::login($user);

        return redirect()->route('home')->with('status', '¡Cuenta activada con éxito!');
    }

    /** Reenviar un nuevo token de verificación */
    public function resendToken()
    {
        $userId = session('verify_user_id');
        $user   = User::findOrFail($userId);

        // Eliminar tokens antiguos y generar uno nuevo
        VerificationToken::where('user_id', $userId)->delete();
        $token = Str::upper(Str::random(6));
        VerificationToken::create(['user_id' => $userId, 'token' => $token]);

        // Enviar de nuevo el correo de verificación
        Mail::to($user->email)->send(new VerifyUser($user, $token));

        return back()->with('status', 'Te hemos enviado un nuevo código.');
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
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Verificar si el usuario está activo
        $user = User::where('email', $credentials['email'])->first();
        if ($user && ! $user->is_active) {
            return back()->withErrors(['error' => 'Cuenta no activada. Por favor verifica tu correo.']);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors(['error' => 'Credenciales incorrectas.']);
    }

    /** Mostrar formulario de recuperación de contraseña */
    public function showRecuperarPassForm()
    {
        return view('recuperarPass');
    }
    /** Procesar recuperación de contraseña */
    public function recuperarPass(Request $request)
    {
        // Aquí iría la lógica para enviar un enlace de recuperación de contraseña
    }

    // Ver perfil del usuario
    public function showProfile()
    {
        $user = Auth::user();
        return view('userProfile', compact('user'));
    }
    public function editProfile(Request $request)
    {
        return view('configAccount');
    }
    /** Cerrar sesión */
    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
