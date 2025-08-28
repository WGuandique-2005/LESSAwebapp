<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresoUsuario;
use App\Models\Leccion;


class ProgressController extends Controller
{
    public function ls1_complete(Request $request)
    {
        try {
            $userId = auth()->id();
            $leccionId = 1; // ID de la lección de abecedario
            $fechaCompletado = now();

            $yaCompletada = ProgresoUsuario::where('usuario_id', $userId)
                ->where('leccion_id', $leccionId)
                ->where('completado', true)
                ->exists();
            if ($yaCompletada) {
                return redirect()->route('lecciones')->with('status', 'Ya has completado esta lección.');
            }

            $progreso = ProgresoUsuario::create([
                'usuario_id' => $userId,
                'leccion_id' => $leccionId,
                'completado' => true,
                'fecha_completada' => $fechaCompletado,
            ]);
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('lecciones')->withErrors(['error' => 'Error al completar la lección']);
        }
    }

    public function ls2_complete(Request $request)
    {
        try {
            $userId = auth()->id();
            $leccionId = 2; // ID de la lección de números
            $fechaCompletado = now();

            $yaCompletada = ProgresoUsuario::where('usuario_id', $userId)
                ->where('leccion_id', $leccionId)
                ->where('completado', true)
                ->exists();
            if ($yaCompletada) {
                return redirect()->route('lecciones')->with('status', 'Ya has completado esta lección.');
            }

            $progreso = ProgresoUsuario::create([
                'usuario_id' => $userId,
                'leccion_id' => $leccionId,
                'completado' => true,
                'fecha_completada' => $fechaCompletado,
            ]);
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('lecciones')->withErrors(['status' => 'Error al completar la lección']);
        }
    }

    public function ls3_complete(Request $request)
    {
        try {
            $userId = auth()->id();
            $leccionId = 3; // ID de la lección de saludos
            $fechaCompletado = now();

            $yaCompletada = ProgresoUsuario::where('usuario_id', $userId)
                ->where('leccion_id', $leccionId)
                ->where('completado', true)
                ->exists();
            if ($yaCompletada) {
                return redirect()->route('lecciones')->with('status', 'Ya has completado esta lección.');
            }

            $progreso = ProgresoUsuario::create([
                'usuario_id' => $userId,
                'leccion_id' => $leccionId,
                'completado' => true,
                'fecha_completada' => $fechaCompletado,
            ]);
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('lecciones')->withErrors(['error' => 'Error al completar la lección']);
        }
    }

    public function miProgreso(){
    $userId = auth()->id();

    $totalLecciones = Leccion::count();
    $leccionesCompletadas = ProgresoUsuario::where('usuario_id', $userId)
        ->where('completado', true)
        ->with('leccion')
        ->get();

    $porcentaje = $totalLecciones > 0 
        ? round(($leccionesCompletadas->count() / $totalLecciones) * 100) 
        : 0;

    return view('miProgreso', compact('leccionesCompletadas', 'porcentaje'));
    }
}
