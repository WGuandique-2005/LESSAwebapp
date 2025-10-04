<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntosUsuario;
use Illuminate\Support\Facades\DB;

class PuntosUsuarioController extends Controller
{
    /**
     * Completa las actividades: Asignar puntos.
     */
    public function completeAbecedarioAdivina(Request $request)
    {
        // 1. Validar la autenticación
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        // 2. Obtener el conteo de errores y definir el ID de la actividad
        $errorsCount = (int) $request->input('errors_count');
        $activityId = 'ABC1'; // ID de 'Abecedario - Adivina' según la migración

        // 3. Determinar los puntos y el mensaje de gamificación
        $points = 0;
        $message = '';
        $title = '';

        if ($errorsCount <= 0) {
            $points = 10;
            $title = '¡PERFECTO! 🤩';
            $message = 'No tuviste ningún error. ¡Dominio total! Has ganado el máximo de puntos.';
        } elseif ($errorsCount <= 4) {
            $points = 5;
            $title = '¡MUY BIEN! 👍';
            $message = "Tuviste {$errorsCount} error(es). Demuestras gran precisión.";
        } else {
            $points = 2;
            $title = '¡BUEN INTENTO! 💪';
            $message = "Tuviste {$errorsCount} errores. Repite la actividad para dominar las señas.";
        }

        // 4. Lógica de transacción: Asignar puntos y registrar la actividad
        try {
            DB::beginTransaction();

            // 4a. Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                // Si existe, actualiza el puntaje
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            // 5. Redireccionar al usuario con mensaje
            return redirect()->route('nivel.abecedario')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");

        } catch (\Exception $e) {
            DB::rollBack();
            // Retorna a la vista de práctica con un error
            return redirect()->route('nivel.abecedario')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeNumerosAdivina(Request $request)
    {
        // 1. Validar la autenticación
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        // 2. Obtener el conteo de errores y definir el ID de la actividad
        $errorsCount = (int) $request->input('errors_count');
        $activityId = 'NUM1';

        // 3. Determinar los puntos y el mensaje de gamificación
        $points = 0;
        $message = '';
        $title = '';

        if ($errorsCount <= 0) {
            $points = 10;
            $title = '¡PERFECTO! 🤩';
            $message = 'No tuviste ningún error. ¡Dominio total! Has ganado el máximo de puntos.';
        } elseif ($errorsCount <= 4) {
            $points = 5;
            $title = '¡MUY BIEN! 👍';
            $message = "Tuviste {$errorsCount} error(es). Demuestras gran precisión.";
        } else {
            $points = 2;
            $title = '¡BUEN INTENTO! 💪';
            $message = "Tuviste {$errorsCount} errores. Repite la actividad para dominar las señas.";
        }

        // 4. Lógica de transacción: Asignar puntos y registrar la actividad
        try {
            DB::beginTransaction();

            // 4a. Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                // Si existe, actualiza el puntaje
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            // 5. Redireccionar al usuario con mensaje
            return redirect()->route('nivel.numeros')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");

        } catch (\Exception $e) {
            DB::rollBack();
            // Retorna a la vista de práctica con un error
            return redirect()->route('nivel.numeros')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }
}