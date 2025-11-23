<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMessage;

class AdminController extends Controller
{
    // Show password confirmation form
    public function showPasswordForm()
    {
        if (session('admin_unlocked')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth');
    }

    // Verify password
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Check against the currently logged-in user's password (which is the admin)
        if (Hash::check($request->password, Auth::user()->password)) {
            session(['admin_unlocked' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Contraseña incorrecta.']);
    }

    // Admin Dashboard
    public function dashboard()
    {
        // For now, the dashboard can just be the user list or a landing page.
        // Let's show some stats and a link to users.
        $totalUsers = User::count();
        return view('admin.dashboard', compact('totalUsers'));
    }

    // List Users
    public function listUsers()
    {
        $users = User::where('id', '!=', 1)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Create User Form
    public function createUserForm()
    {
        return view('admin.users.create');
    }

    // Store User
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => true,
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado exitosamente.');
    }

    // Edit User Form
    public function editUserForm(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Delete User
    public function deleteUser(User $user)
    {
        if ($user->id === 1) {
            return back()->with('error', 'No se puede eliminar al administrador principal.');
        }
        
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado exitosamente.');
    }

    // Send Email
    public function sendUserEmail(Request $request, User $user)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to($user->email)->send(new AdminMessage($request->subject, $request->message));

        return back()->with('success', 'Correo enviado exitosamente.');
    }
}
