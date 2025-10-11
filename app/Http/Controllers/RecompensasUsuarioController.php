<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompensa;
use App\Models\PuntosUsuario;
use App\Models\RecompensasUsuario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecompensasUsuarioController extends Controller
{
    /**
     * Intenta desbloquear una recompensa específica por su ID.
     */
    public function desbloquearRecompensa($recompensaId) 
    {
        // Convertir explícitamente a entero. Si viene '0' o vacío, será 0.
        $recompensaId = (int) $recompensaId; 
        
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para desbloquear recompensas.');
        }

        try {
            DB::beginTransaction();

            // 1. VERIFICACIÓN DEL ID y EXISTENCIA DE RECOMPENSA (Punto de fallo anterior)
            if ($recompensaId <= 0) { // Bloquea si se pasa 0 o un número negativo.
                DB::rollBack();
                return redirect()->route('miProgreso')->with('reward_result', [
                    'status' => 'error',
                    'title' => 'Error de Recompensa',
                    'message' => 'ID de recompensa inválido.',
                    'reward_name' => 'Error',
                    'route' => 'miProgreso',
                ]);
            }
            
            // Usamos find() en lugar de findOrFail() para evitar la excepción 
            $recompensa = Recompensa::find($recompensaId); 
            
            if (!$recompensa) {
                DB::rollBack();
                return redirect()->route('miProgreso')->with('reward_result', [
                    'status' => 'error',
                    'title' => 'Error de Recompensa',
                    'message' => 'La recompensa que intentas desbloquear no existe en la base de datos.',
                    'reward_name' => 'Error',
                    'route' => 'miProgreso',
                ]);
            }

            // 2. Verificar si ya está desbloqueada
            $recompensaUsuario = RecompensasUsuario::where('usuario_id', $user->id)
                ->where('recompensa_id', $recompensaId)
                ->first();

            if ($recompensaUsuario) {
                DB::commit();
                // Retorno estructurado para modal (Ya Desbloqueada)
                return back()->with('reward_result', [
                    'status' => 'info',
                    'title' => 'Ya Desbloqueada',
                    'message' => "La recompensa '{$recompensa->nombre}' ya ha sido desbloqueada anteriormente.",
                    'reward_name' => $recompensa->nombre,
                    'route' => null, 
                ]);
            }

            // 3. Comprobar requisitos
            $checkFunction = $this->getCheckFunction($recompensaId);
            $requisitosCumplidos = false;
            $levelRouteName = $this->getLevelRouteName($recompensaId); // Obtener el nombre de la ruta

            if ($checkFunction) {
                // Aquí se ejecuta la lógica real de verificación (donde podría fallar por typo de columna)
                $requisitosCumplidos = $this->$checkFunction($user->id, $recompensa);
            } else {
                DB::commit();
                // Retorno estructurado para modal (Error de Lógica: Recompensa ID desconocido)
                return back()->with('reward_result', [
                    'status' => 'error',
                    'title' => 'Error de Lógica',
                    'message' => 'Recompensa no encontrada o sin lógica de verificación implementada.',
                    'reward_name' => $recompensa->nombre,
                    'route' => 'miProgreso', 
                ]);
            }
            
            // 4. Desbloquear si se cumplen los requisitos
            if ($requisitosCumplidos) {
                RecompensasUsuario::create([
                    'usuario_id' => $user->id,
                    'recompensa_id' => $recompensaId,
                    'desbloqueada' => true,
                    'fecha_desblq' => Carbon::now(),
                ]);
                DB::commit();
                // Retorno estructurado para modal (Éxito)
                return back()->with('reward_result', [
                    'status' => 'success',
                    'title' => '¡Felicidades! 🎉',
                    'message' => "¡Has desbloqueado la recompensa '{$recompensa->nombre}'!",
                    'reward_name' => $recompensa->nombre,
                    'route' => null, 
                ]);
            } else {
                DB::commit();
                // Retorno estructurado para modal (Bloqueada/Puntos Escasos)
                return back()->with('reward_result', [
                    'status' => 'locked',
                    'title' => 'Recompensa Bloqueada',
                    'message' => "Puntos escasos. Aún no cumples con los requisitos para desbloquear {$recompensa->nombre}.",
                    'reward_name' => $recompensa->nombre,
                    'route' => $levelRouteName,
                    'puntos_req' => $recompensa->puntos_req,
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            // Esto muestra el error real si estás en el entorno 'local' (debug mode)
            $errorMessage = env('APP_ENV') === 'local' 
                ? 'Error de Debug: ' . $e->getMessage() 
                : 'Ocurrió un error al intentar desbloquear la recompensa. Intenta de nuevo.';
            
            return redirect()->route('miProgreso')->with('reward_result', [
                'status' => 'error',
                'title' => 'Error Inesperado',
                'message' => $errorMessage,
                'reward_name' => 'Error',
                'route' => 'miProgreso',
            ]);
        }
    }

    /**
     * Mapea el ID de la recompensa con su función de verificación.
     */
    private function getCheckFunction(int $recompensaId): ?string
    {
        $map = [
            1 => 'checkPrimerosPasos',      
            2 => 'checkMaestriaLetras',     
            3 => 'checkExpertoNumeros',     
            4 => 'checkElocuenciaSaludos',  
            5 => 'checkGenioSalud',         
            6 => 'checkMaestriaTotal',      
        ];
        return $map[$recompensaId] ?? null;
    }
    
    /**
     * Obtiene el nombre de la ruta del nivel asociada a la recompensa.
     */
    private function getLevelRouteName(int $recompensaId): string
    {
        $map = [
            1 => 'lecciones',       
            2 => 'nivel.abecedario',
            3 => 'nivel.numeros',   
            4 => 'nivel.saludos',   
            5 => 'nivel.salud',     
            6 => 'practicar',       
        ];
        return $map[$recompensaId] ?? 'miProgreso'; 
    }

    // --- Lógicas de Verificación de Requisitos ---

    private function checkPrimerosPasos(int $userId, Recompensa $recompensa): bool
    {
        $puntosTotales = PuntosUsuario::where('usuario_id', $userId)->sum('puntos_obtenidos');
        return $puntosTotales >= $recompensa->puntos_req; 
    }

    private function checkMaestriaLetras(int $userId, Recompensa $recompensa): bool
    {
        $completadosCount = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'ABC%')
            ->count();
        $puntosObtenidos = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'ABC%')
            ->sum('puntos_obtenidos');

        return $completadosCount >= 4 && $puntosObtenidos >= $recompensa->puntos_req; 
    }

    private function checkExpertoNumeros(int $userId, Recompensa $recompensa): bool
    {
        $completadosCount = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'NUM%')
            ->count();
        $puntosObtenidos = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'NUM%')
            ->sum('puntos_obtenidos');

        return $completadosCount >= 4 && $puntosObtenidos >= $recompensa->puntos_req;
    }

    private function checkElocuenciaSaludos(int $userId, Recompensa $recompensa): bool
    {
        $completadosCount = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'SL%')
            ->count();
        $puntosObtenidos = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'SL%')
            ->sum('puntos_obtenidos');

        return $completadosCount >= 4 && $puntosObtenidos >= $recompensa->puntos_req; 
    }

    private function checkGenioSalud(int $userId, Recompensa $recompensa): bool
    {
        $completadosCount = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'SALUD%')
            ->count();
        $puntosObtenidos = PuntosUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->where('nivel_id', 'like', 'SALUD%')
            ->sum('puntos_obtenidos');

        return $completadosCount >= 4 && $puntosObtenidos >= $recompensa->puntos_req;
    }

    private function checkMaestriaTotal(int $userId, Recompensa $recompensa): bool
    {
        $puntosTotales = PuntosUsuario::where('usuario_id', $userId)->sum('puntos_obtenidos');
        return $puntosTotales >= $recompensa->puntos_req;
    }
}