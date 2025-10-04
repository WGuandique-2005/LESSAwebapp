<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresoUsuario;
use App\Models\PuntosUsuario;
use App\Models\Nivel;
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
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente, ¡Felicidades!, puedes pasar a la siguiente lección');
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
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente, ¡Felicidades!, puedes pasar a la siguiente lección');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('lecciones')->withErrors(['error' => 'Error al completar la lección']);
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
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente, ¡Felicidades!, puedes pasar a la siguiente lección');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('lecciones')->withErrors(['error' => 'Error al completar la lección']);
        }
    }

    public function ls4_complete(Request $request)
    {
        try {
            $userId = auth()->id();
            $leccionId = 4; // ID de la lección salud
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
            return redirect()->route('lecciones')->with('status', 'Lección completada exitosamente, ¡Felicidades!, puedes pasar a la siguiente lección');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('lecciones')->withErrors(['error' => 'Error al completar la lección']);
        }
    }

    public function miProgreso()
    {
        $userId = auth()->id();

        // Lecciones
        $totalLecciones = Leccion::count();
        $leccionesCompletadas = ProgresoUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->with('leccion')
            ->get();
        $porcentajeLecciones = $totalLecciones > 0
            ? round(($leccionesCompletadas->count() / $totalLecciones) * 100)
            : 0;

        // Niveles completados (consulta robusta usando join)
        // Asegurate que la tabla se llame 'puntos_usuarios' y la columna de relacion sea 'nivel_id'
        $nivelesCompletados = Nivel::join('puntos_usuarios as pu', 'niveles.id', '=', 'pu.nivel_id')
            ->where('pu.usuario_id', $userId)
            ->select('niveles.*', 'pu.puntos_obtenidos', 'pu.fecha_completado as fecha_finalizado')
            ->get();

        $totalNiveles = Nivel::count();
        $porcentajeNiveles = $totalNiveles > 0
            ? round(($nivelesCompletados->count() / $totalNiveles) * 100)
            : 0;

        $porcentaje = round(($porcentajeLecciones + $porcentajeNiveles) / 2);

        return view('miProgreso', compact(
            'leccionesCompletadas',
            'porcentajeLecciones',
            'nivelesCompletados',
            'porcentajeNiveles',
            'porcentaje'
        ));
    }


}

