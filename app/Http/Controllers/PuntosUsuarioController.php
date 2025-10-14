<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntosUsuario;
use Illuminate\Support\Facades\DB;

class PuntosUsuarioController extends Controller
{
    // Wrappers públicos. Solo pasan activityId y rutas específicas.
    public function completeAbecedarioAdivina(Request $request)
    {
        return $this->handleCompletion($request, 'ABC1', 'nivel.abecedario', 'nivel.abecedario');
    }

    public function completeAbecedarioConecta(Request $request)
    {
        return $this->handleCompletion($request, 'ABC3', 'nivel.abecedario', 'nivel.abecedario');
    }

    public function completeAbecedarioMemorama(Request $request)
    {
        return $this->handleCompletion($request, 'ABC2', 'nivel.abecedario', 'nivel.abecedario');
    }

    public function completeNumerosAdivina(Request $request)
    {
        return $this->handleCompletion($request, 'NUM1', 'nivel.numeros', 'nivel.numeros');
    }

    public function completeNumerosConecta(Request $request)
    {
        return $this->handleCompletion($request, 'NUM3', 'nivel.numeros', 'nivel.numeros');
    }

    public function completeNumerosMemorama(Request $request)
    {
        return $this->handleCompletion($request, 'NUM2', 'nivel.numeros', 'nivel.numeros');
    }

    public function completeSaludosAdivina(Request $request)
    {
        return $this->handleCompletion($request, 'SL1', 'nivel.saludos', 'nivel.saludos');
    }

    public function completeSaludosConecta(Request $request)
    {
        return $this->handleCompletion($request, 'SL3', 'nivel.saludos', 'nivel.saludos');
    }

    public function completeSaludosMemorama(Request $request)
    {
        return $this->handleCompletion($request, 'SL2', 'nivel.saludos', 'nivel.saludos');
    }

    public function completeSaludAdivina(Request $request)
    {
        return $this->handleCompletion($request, 'SALUD1', 'nivel.salud', 'nivel.salud');
    }

    public function completeSaludConecta(Request $request)
    {
        return $this->handleCompletion($request, 'SALUD3', 'nivel.salud', 'nivel.salud');
    }

    public function completeSaludMemorama(Request $request)
    {
        return $this->handleCompletion($request, 'SALUD2', 'nivel.salud', 'nivel.salud');
    }

    public function completeAbecedarioExtra(Request $request)
    {
        return $this->handleCompletionExtra($request, 'ABC4', 'nivel.abecedario', 'nivel.abecedario', 10);
    }

    public function completeNumerosExtra(Request $request)
    {
        return $this->handleCompletionExtra($request, 'NUM4', 'nivel.numeros', 'nivel.numeros', 10);
    }

    public function completeSaludosExtra(Request $request)
    {
        return $this->handleCompletionExtra($request, 'SL4', 'nivel.saludos', 'nivel.saludos', 10);
    }

    public function completeSaludExtra(Request $request)
    {
        return $this->handleCompletionExtra($request, 'SALUD4', 'nivel.salud', 'nivel.salud', 10);
    }

    /**
     * Maneja la lógica común de validación, cálculo de puntos,
     * inserción/actualización en PuntosUsuario y redirecciones.
     *
     * @param Request $request
     * @param string  $activityId   // nivel_id en la tabla PuntosUsuario
     * @param string  $successRoute // ruta para redireccionar en caso de éxito
     * @param string  $errorRoute   // ruta para redireccionar en caso de error/exception
     */
    private function handleCompletion(Request $request, string $activityId, string $successRoute, string $errorRoute)
    {
        // 1. Autenticación
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        // 2. Datos de la petición
        $errorsCount = (int) $request->input('errors_count', 0);

        // 3. Calcular puntos y mensajes (misma regla usada antes)
        $points = 0;
        $title = '';
        $message = '';

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

        // 4. Asignar puntos en transacción
        try {
            DB::beginTransaction();

            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();

            $puntosAsignados = false;
            $puntosAnteriores = $puntosUsuario ? (int) $puntosUsuario->puntos_obtenidos : 0;

            if ($puntosUsuario) {
                // Actualiza solo si se mejora la puntuación
                if ($points > (int) $puntosUsuario->puntos_obtenidos) {
                    $puntosUsuario->puntos_obtenidos = $points;
                    $puntosUsuario->completado = true;
                    $puntosUsuario->fecha_completado = now();
                    $puntosUsuario->save();
                    $puntosAsignados = true;
                }
            } else {
                // Crear registro nuevo
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
                $puntosAsignados = true;
            }

            DB::commit();

            // 5. Redirección con mensaje (tres casos: nuevo mejor puntaje, puntaje menor, puntaje igual)
            if ($request->input('redirect_to') === 'miProgreso') {
                return redirect()->route('miProgreso')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
            }
            if ($puntosAsignados) {
                $text = "{$title} {$message} Has ganado {$points} puntos. Tu mejor marca es ahora de {$points} puntos.";
                return redirect()->route($successRoute)->with('success', $text);
            }

            if ($points < $puntosAnteriores) {
                $text = "{$title} Has obtenido {$points} puntos. Tu registro anterior es de {$puntosAnteriores} puntos. Sigue practicando para superarla.";
                return redirect()->route($successRoute)->with('info', $text);
            }

            // Igual que antes, no hubo mejora ni empeoro
            $text = "{$title} ¡Actividad completada! Tu mejor puntuación se mantiene en {$puntosAnteriores} puntos.";
            return redirect()->route($successRoute)->with('success', $text);

        } catch (\Exception $e) {
            DB::rollBack();
            // Para depuración:
            // return redirect()->route($errorRoute)->with('error', 'Ocurrió un error al guardar tu puntuación. Detalle: ' . $e->getMessage());
            return redirect()->route($errorRoute)->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    /**
     * Maneja la lógica de guardado de puntos fijos para actividades "Extra"
     * o aquellas que no dependen del conteo de errores.
     *
     * @param Request $request
     * @param string  $activityId   // nivel_id en la tabla PuntosUsuario
     * @param string  $successRoute // ruta para redireccionar en caso de éxito
     * @param string  $errorRoute   // ruta para redireccionar en caso de error/exception
     * @param int     $defaultPoints // Puntos fijos a asignar por defecto.
     */
    public function handleCompletionExtra(Request $request, string $activityId, string $successRoute, string $errorRoute, int $defaultPoints)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $userId = $user->id;
        
        try {
            DB::beginTransaction();

            // Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $userId)
                ->where('nivel_id', $activityId)
                ->first();

            // Lógica: Solo actualizar si la puntuación extra es mayor (asumiendo que se está re-usando el ID)
            $puntosAnteriores = $puntosUsuario ? (int) $puntosUsuario->puntos_obtenidos : 0;
            $puntosAsignados = false;

            if ($puntosUsuario) {
                if ($defaultPoints > $puntosAnteriores) {
                    $puntosUsuario->puntos_obtenidos = $defaultPoints;
                    $puntosUsuario->completado = true;
                    $puntosUsuario->fecha_completado = now();
                    $puntosUsuario->save();
                    $puntosAsignados = true;
                }
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $userId,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $defaultPoints,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
                $puntosAsignados = true;
            }

            DB::commit();

            // Redireccionar al usuario con mensaje
            $title = '¡Actividad Extra Completada!';

            if ($puntosAsignados) {
                $text = "{$title} La actividad extra se ha completado. Has obtenido +{$defaultPoints} puntos.";
                return redirect()->route($successRoute)->with('success', $text);
            }

            // Si no se asignaron puntos (la marca anterior ya era igual o superior)
            $text = "{$title} La actividad extra se ha completado. Tu mejor puntuación se mantiene en {$puntosAnteriores} puntos.";
            return redirect()->route($successRoute)->with('info', $text);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($errorRoute)->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }
}
