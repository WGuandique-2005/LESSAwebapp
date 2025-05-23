<?php
// Controller para manejar la lógica de usuarios
// - Autenticación
// - Registro
// - Recuperación de contraseña
// - Actualización de perfil
// - Eliminación de cuenta
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use function Termwind\renderUsing;


class UserController extends Controller
{
    public function showSignUpForm()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'oauth_id'    => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'oauth_id' => $data['oauth'],
        ]);
        if(!$user) {
            return back()->withErrors(['error' => 'Error al crear el usuario.']);
        }
        Auth::login($user);
        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('login');
    }
}
