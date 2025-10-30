<?php

namespace App\Http\Controllers;

use App\Models\PuntosUsuario;
use App\Models\User; // <-- 1. Importar el modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    // Muestra el ranking top 10
    public function index()
    {
        // Obtener el nombre
        $table = (new PuntosUsuario())->getTable();

        $ranking = DB::table($table)
            ->select(
                "$table.usuario_id",
                'users.username',
                DB::raw('SUM(puntos_obtenidos) as total_points'),
                DB::raw('MAX(fecha_completado) as achieved_at')
            )
            ->join('users', 'users.id', '=', "$table.usuario_id")
            ->groupBy("$table.usuario_id", 'users.username')
            ->orderByDesc('total_points')
            ->orderBy('achieved_at')
            ->limit(10)
            ->get();
        
        // Obtener los IDs de los usuarios del ranking
        $userIds = $ranking->pluck('usuario_id');

        // Cargar los usuarios con sus recompensas desbloqueadas
        // Usamos Eager Loading para evitar problemas N+1
        $usersWithRewards = User::whereIn('id', $userIds)
            ->with(['recompensas' => function ($query) {
                // Filtramos para traer solo las recompensas desbloqueadas
                $query->where('desbloqueada', 1)->with('recompensa');
            }])
            ->get()
            ->keyBy('id');

        // Adjuntar las recompensas a cada fila del ranking
        $ranking->each(function ($row) use ($usersWithRewards) {
            $user = $usersWithRewards->get($row->usuario_id);
            $row->rewards = $user ? $user->recompensas : collect();
        });
        
        return view('ranking', compact('ranking'));
    }
}