<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            // oauth_id se queda null por defecto para usuarios normales
        ]);

        if (!$user) {
            return back()->withErrors(['error' => 'Error al crear el usuario.']);
        }

        Auth::login($user);
        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($data)) {
            return redirect()->route('home');
        }

        return back()->withErrors(['error' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
