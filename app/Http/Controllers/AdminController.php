<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Nivel;
use App\Models\Leccion;
use App\Models\ProgresoUsuario;
use App\Models\PuntosUsuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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
        $totalUsers = User::where('id', '!=', 1)->count();

        // --- Lecciones: usuarios que completaron cada lección ---
        $lecciones = Leccion::all();
        $leccionNames = ['Lección 1: Abecedario', 'Lección 2: Números', 'Lección 3: Saludos', 'Lección 4: Salud'];

        $completadosPorLeccion = [];
        for ($i = 1; $i <= 4; $i++) {
            $completadosPorLeccion[] = ProgresoUsuario::where('leccion_id', $i)
                ->where('completado', true)
                ->distinct('usuario_id')
                ->count('usuario_id');
        }

        // --- Puntos: promedio de puntos por lección (agrupando niveles 1-4 → ls1, 5-8 → ls2, etc.) ---
        // Agrupar niveles por leccion: cada lección tiene 4 niveles secuenciales
        $avgPuntosPorLeccion = [];
        $nivelesOrdenados = Nivel::orderBy('id')->pluck('id')->toArray();
        $chunkSize = max(1, intdiv(count($nivelesOrdenados), 4));
        $nivelesChunked = array_chunk($nivelesOrdenados, $chunkSize);

        for ($i = 0; $i < 4; $i++) {
            $ids = $nivelesChunked[$i] ?? [];
            if (count($ids) > 0) {
                $avg = PuntosUsuario::whereIn('nivel_id', $ids)->avg('puntos_obtenidos');
                $avgPuntosPorLeccion[] = round($avg ?? 0, 1);
            } else {
                $avgPuntosPorLeccion[] = 0;
            }
        }

        // --- Actividad reciente: registros de las últimas 4 semanas ---
        $actividadSemanal = [];
        $semanaLabels = [];
        for ($week = 3; $week >= 0; $week--) {
            $start = now()->startOfWeek()->subWeeks($week);
            $end   = $start->copy()->endOfWeek();
            $semanaLabels[] = 'Sem ' . $start->format('d/M');
            $actividadSemanal[] = ProgresoUsuario::whereBetween('fecha_completada', [$start, $end])
                ->where('completado', true)
                ->count();
        }

        // --- Top usuarios por puntos ---
        $topUsuarios = DB::table('puntos_usuarios')
            ->join('users', 'users.id', '=', 'puntos_usuarios.usuario_id')
            ->where('users.id', '!=', 1)
            ->select('users.name', 'users.username', DB::raw('SUM(puntos_usuarios.puntos_obtenidos) as total_puntos'))
            ->groupBy('users.id', 'users.name', 'users.username')
            ->orderByDesc('total_puntos')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'leccionNames',
            'completadosPorLeccion',
            'avgPuntosPorLeccion',
            'semanaLabels',
            'actividadSemanal',
            'topUsuarios'
        ));
    }

    // List Users
    public function listUsers(Request $request)
    {
        // 1. Load users with valid relationships (exclude broken 'puntos.nivel')
        $query = User::where('id', '!=', 1)
            ->with(['lecciones.leccion', 'puntos', 'recompensas.recompensa']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        // 2. Load puntos with level name via join (mirroring ProgressController::miProgreso)
        // Import the PuntosUsuario model at the top of the file if not already present.
        $puntosWithNivel = \App\Models\PuntosUsuario::whereIn('usuario_id', $users->pluck('id'))
            ->join('niveles', 'niveles.id', '=', 'puntos_usuarios.nivel_id')
            ->select('puntos_usuarios.*', 'niveles.nombre as nivel_nombre')
            ->get()
            ->groupBy('usuario_id');

        // Attach the enriched puntos collection to each user, adding a pseudo‑relation "nivel"
        foreach ($users as $user) {
            $puntos = $puntosWithNivel->get($user->id) ?? collect();
            // For each punto, create a simple object representing the related nivel
            $puntos->each(function ($p) {
                $p->nivel = (object) ['nombre' => $p->nivel_nombre];
                // Optionally unset the raw attribute to avoid confusion
                unset($p->nivel_nombre);
            });
            $user->setRelation('puntos', $puntos);
        }

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

    // Reset User Progress
    public function resetProgress(User $user)
    {
        if ($user->id === 1) {
            return back()->with('error', 'No puedes reiniciar el progreso del administrador principal.');
        }

        // Delete related records
        $user->lecciones()->delete();
        $user->puntos()->delete();
        $user->recompensas()->delete();

        return redirect()->route('admin.users')->with('success', 'Progreso del usuario reiniciado exitosamente.');
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

    // Send Announcement to ALL users
    public function sendAnnouncement(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Get all users (optionally you might want to exclude the admin/sender, or specific users)
        // For now, "todos los correos registrados" implies everyone.
        $users = User::all();
        $count = 0;

        foreach ($users as $user) {
            // Avoid sending to users without email or invalid email if necessary, 
            // but User::create validates email so it should be fine.
            if ($user->email) {
                // Using Queue is recommended for bulk email, but for now we send directly as per request context
                Mail::to($user->email)->send(new AdminMessage($request->subject, $request->message));
                $count++;
            }
        }

        return back()->with('success', "Anuncio enviado exitosamente a {$count} usuarios.");
    }
}
