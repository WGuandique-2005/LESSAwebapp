<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresoUsuario;
use App\Models\PuntosUsuario;
use App\Models\RecompensasUsuario;
use App\Models\Recompensa;
use App\Models\Nivel;
use App\Models\Leccion;

class ProgressController extends Controller
{
    // Función pública para completar la Lección 1 (Abecedario)
    public function ls1_complete(Request $request)
    {
        // Lección 1 es la única que otorga una recompensa fija (ID 1)
        return $this->handleLessonCompletion($request, 1, 1);
    }

    // Función pública para completar la Lección 2 (Números)
    public function ls2_complete(Request $request)
    {
        return $this->handleLessonCompletion($request, 2);
    }

    // Función pública para completar la Lección 3 (Saludos)
    public function ls3_complete(Request $request)
    {
        return $this->handleLessonCompletion($request, 3);
    }

    // Función pública para completar la Lección 4 (Salud)
    public function ls4_complete(Request $request)
    {
        return $this->handleLessonCompletion($request, 4);
    }

    /**
     * Maneja la lógica común para completar una lección.
     *
     * @param Request $request
     * @param int $leccionId El ID de la lección que se está completando.
     * @param int|null $recompensaId ID de la recompensa a desbloquear (opcional).
     * @return \Illuminate\Http\RedirectResponse
     */
    private function handleLessonCompletion(Request $request, int $leccionId, ?int $recompensaId = null)
    {
        try {
            $userId = auth()->id();

            // 1. Verificar si la lección ya fue completada
            $yaCompletada = ProgresoUsuario::where('usuario_id', $userId)
                ->where('leccion_id', $leccionId)
                ->where('completado', true)
                ->exists();

            if ($yaCompletada) {
                return redirect()->route('lecciones')->with('status', 'Ya has completado esta lección.');
            }

            // 2. Registrar el progreso de la lección
            ProgresoUsuario::create([
                'usuario_id' => $userId,
                'leccion_id' => $leccionId,
                'completado' => true,
                'fecha_completada' => now(),
            ]);

            $message = 'Lección completada exitosamente, ¡Felicidades!, puedes pasar a la siguiente lección';

            // 3. Desbloquear recompensa si se proporciona un ID
            if ($recompensaId) {
                $recompensa = Recompensa::find($recompensaId);

                // Comprobar que la recompensa exista y no esté ya desbloqueada
                if ($recompensa && !RecompensasUsuario::where('usuario_id', $userId)->where('recompensa_id', $recompensaId)->exists()) {
                    RecompensasUsuario::create([
                        'usuario_id' => $userId,
                        'recompensa_id' => $recompensa->id,
                        'estado' => 'Desbloqueada',
                    ]);
                    $message .= ', y has desbloqueado una recompensa, ve a verla en Tu Progreso';
                }
            }

            return redirect()->route('lecciones')->with('status', $message);
        } catch (\Exception $e) {
            // Manejo de errores
            // Puedes usar logger aquí si es necesario: \Log::error("Error al completar la lección {$leccionId}: " . $e->getMessage());
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
            'descripcionProgreso' => $descripcion,
            'totalNiveles' => $totalNiveles,
            'nivelesCompletadosCount' => $nivelesCompletadosCount,
        ];

    }
}
