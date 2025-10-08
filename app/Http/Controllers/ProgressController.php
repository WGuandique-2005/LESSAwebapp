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

    public static function getHomeProgressData()
    {
        if (!auth()->check()) {
            return [
                'porcentajeGlobal' => 0,
                'pendingBySection' => ['Abecedario' => 0, 'Números' => 0, 'Saludos' => 0, 'Salud' => 0],
                'descripcionProgreso' => 'Inicia sesión para ver tu progreso.',
                'totalNiveles' => 0,
                'nivelesCompletadosCount' => 0,
            ];
        }

        $userId = auth()->id();

        // 1. Obtener todas las actividades (niveles) disponibles
        $allNiveles = Nivel::all(['id']);
        $totalNiveles = $allNiveles->count(); // Total de actividades, ej: 16
        
        // 2. Obtener los niveles completados por el usuario
        $nivelesCompletados = PuntosUsuario::where('usuario_id', $userId)
                                        ->pluck('nivel_id')
                                        ->unique()
                                        ->toArray();
        $nivelesCompletadosCount = count($nivelesCompletados);
        
        // 3. Calcular el porcentaje global
        $porcentajeGlobal = $totalNiveles > 0 
            ? round(($nivelesCompletadosCount / $totalNiveles) * 100) 
            : 0;

        // 4. Contar pendientes por sección
        $pendingBySection = [
            'Abecedario' => 0,
            'Números' => 0,
            'Saludos' => 0,
            'Salud' => 0,
        ];

        foreach ($allNiveles as $nivel) {
            if (!in_array($nivel->id, $nivelesCompletados)) {
                // Clasificación basada en los prefijos: ABC, NUM, SL, SALUD
                $prefix = substr($nivel->id, 0, min(4, strlen($nivel->id)));
                
                if (str_starts_with($prefix, 'ABC')) {
                    $pendingBySection['Abecedario']++;
                } elseif (str_starts_with($prefix, 'NUM')) {
                    $pendingBySection['Números']++;
                } elseif (str_starts_with($prefix, 'SL')) {
                    $pendingBySection['Saludos']++;
                } elseif (str_starts_with($prefix, 'SALU')) { 
                    $pendingBySection['Salud']++;
                }
            }
        }
        
        // 5. Generar la descripción del progreso
        $descripcion = '¡Excelente trabajo! Continúa para dominar la LESSA.';
        if ($porcentajeGlobal == 0) {
            $descripcion = '¡Bienvenido! Comienza el Abecedario para ver tu progreso global.';
        } elseif ($porcentajeGlobal < 25) {
            $descripcion = '¡Has dado los primeros pasos! Tienes mucho por aprender, el Abecedario es un buen inicio.';
        } elseif ($porcentajeGlobal < 75) {
            $descripcion = '¡Estás en camino! Completa las lecciones pendientes para ser un experto.';
        } elseif ($porcentajeGlobal < 100) {
            $descripcion = '¡Casi lo logras! Un último esfuerzo te espera para dominar todas las secciones.';
        } elseif ($porcentajeGlobal == 100) {
            $descripcion = '¡FELICIDADES! Has completado todas las actividades disponibles. ¡Eres un maestro de la LESSA! 🎉';
        }


        return [
            'porcentajeGlobal' => $porcentajeGlobal,
            'pendingBySection' => $pendingBySection,
            'descripcionProgreso' => $descripcion,
            'totalNiveles' => $totalNiveles,
            'nivelesCompletadosCount' => $nivelesCompletadosCount,
        ];

    }
}