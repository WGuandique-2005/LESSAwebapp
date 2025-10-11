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

    public function completeAbecedarioConecta(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0); // Usamos un valor por defecto de 0
        $activityId = 'ABC3'; // ID CORRECTO

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

        try {
            DB::beginTransaction();
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();
            if ($request->input('redirect_to') === 'miProgreso') {
                return redirect()->route('miProgreso')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
            }
            return redirect()->route('nivel.abecedario')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.abecedario')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeNumerosAdivina(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count');
        $activityId = 'NUM1';
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

        try {
            DB::beginTransaction();
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();
            return redirect()->route('nivel.numeros')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.numeros')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeNumerosConecta(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0); // Usamos un valor por defecto de 0
        $activityId = 'NUM3'; // ID CORRECTO 
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

        try {
            DB::beginTransaction();

            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            if ($request->input('redirect_to') === 'miProgreso') {
                return redirect()->route('miProgreso')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
            }
            return redirect()->route('nivel.numeros')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.numeros')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeSaludosAdivina(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count');
        $activityId = 'SL1';

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

        try {
            DB::beginTransaction();

            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('nivel.saludos')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.saludos')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeSaludosConecta(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0); // Usamos un valor por defecto de 0
        $activityId = 'SL3'; // ID CORRECTO 
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

        try {
            DB::beginTransaction();

            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            if ($request->input('redirect_to') === 'miProgreso') {
                return redirect()->route('miProgreso')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
            }
            return redirect()->route('nivel.saludos')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.saludos')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }
    public function completeSaludAdivina(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count');
        $activityId = 'SALUD1';
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

        try {
            DB::beginTransaction();
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('nivel.salud')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.salud')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeSaludConecta(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0); // Usamos un valor por defecto de 0
        $activityId = 'SALUD3'; // ID CORRECTO
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

        try {
            DB::beginTransaction();

            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            if ($request->input('redirect_to') === 'miProgreso') {
                return redirect()->route('miProgreso')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
            }
            return redirect()->route('nivel.salud')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.salud')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeAbecedarioMemorama(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0);
        $activityId = 'ABC2';

        $points = 0;
        $message = '';
        $title = '';

        if ($errorsCount <= 0) {
            $points = 10;
            $title = '¡PERFECTO! 🤩';
            $message = 'No tuviste ningún error. ¡Dominio total! Has ganado el máximo de puntos.';
        } elseif ($errorsCount <= 6) {
            $points = 5;
            $title = '¡MUY BIEN! 👍';
            $message = "Tuviste {$errorsCount} error(es). Demuestras gran precisión.";
        } else {
            $points = 2;
            $title = '¡BUEN INTENTO! 💪';
            $message = "Tuviste {$errorsCount} errores. Repite la actividad para dominar las señas.";
        }

        try {
            DB::beginTransaction();
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }
            DB::commit();
            return redirect()->route('nivel.abecedario')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.abecedario')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeNumerosMemorama(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0);
        $activityId = 'NUM2';

        $points = 0;
        $message = '';
        $title = '';

        if ($errorsCount <= 0) {
            $points = 10;
            $title = '¡PERFECTO! 🤩';
            $message = 'No tuviste ningún error. ¡Dominio total! Has ganado el máximo de puntos.';
        } elseif ($errorsCount <= 6) {
            $points = 5;
            $title = '¡MUY BIEN! 👍';
            $message = "Tuviste {$errorsCount} error(es). Demuestras gran precisión.";
        } else {
            $points = 2;
            $title = '¡BUEN INTENTO! 💪';
            $message = "Tuviste {$errorsCount} errores. Repite la actividad para dominar las señas.";
        }

        try {
            DB::beginTransaction();
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }
            DB::commit();
            return redirect()->route('nivel.numeros')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.numeros')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeSaludosMemorama(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0);
        $activityId = 'SL2';

        $points = 0;
        $message = '';
        $title = '';

        if ($errorsCount <= 0) {
            $points = 10;
            $title = '¡PERFECTO! 🤩';
            $message = 'No tuviste ningún error. ¡Dominio total! Has ganado el máximo de puntos.';
        } elseif ($errorsCount <= 6) {
            $points = 5;
            $title = '¡MUY BIEN! 👍';
            $message = "Tuviste {$errorsCount} error(es). Demuestras gran precisión.";
        } else {
            $points = 2;
            $title = '¡BUEN INTENTO! 💪';
            $message = "Tuviste {$errorsCount} errores. Repite la actividad para dominar las señas.";
        }

        try {
            DB::beginTransaction();
            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }
            DB::commit();
            return redirect()->route('nivel.saludos')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.saludos')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeSaludMemorama(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $errorsCount = (int) $request->input('errors_count', 0);
        $activityId = 'SALUD2';

        $points = 0;
        $message = '';
        $title = '';

        if ($errorsCount <= 0) {
            $points = 10;
            $title = '¡PERFECTO! 🤩';
            $message = 'No tuviste ningún error. ¡Dominio total! Has ganado el máximo de puntos.';
        } elseif ($errorsCount <= 6) {
            $points = 5;
            $title = '¡MUY BIEN! 👍';
            $message = "Tuviste {$errorsCount} error(es). Demuestras gran precisión.";
        } else {
            $points = 2;
            $title = '¡BUEN INTENTO! 💪';
            $message = "Tuviste {$errorsCount} errores. Repite la actividad para dominar las señas.";
        }

        try {
            DB::beginTransaction();

            $puntosUsuario = PuntosUsuario::where('usuario_id', $user->id)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                PuntosUsuario::create([
                    'usuario_id' => $user->id,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            if ($request->input('redirect_to') === 'miProgreso') {
                return redirect()->route('miProgreso')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
            }
            return redirect()->route('nivel.salud')->with('success', "{$title} {$message} Puntos obtenidos: +{$points}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.salud')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeAbecedarioExtra(){
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $userId = $user->id;
        $activityId = 'ABC4'; // ID de 'Abecedario - Extra' según la migración
        $points = 10; // Puntos fijos para esta actividad

        try {
            DB::beginTransaction();

            // Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $userId)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                // Si existe, actualiza el puntaje
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $userId,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            // Redireccionar al usuario con mensaje
            return redirect()->route('nivel.abecedario')->with('success', "La actividad extra del Abecedario se ha completado y se te han otorgado +{$points} puntos. Ve a ver tu progreso en 'Mi Progreso', te esperan nuevas recompensas.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.abecedario')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }

    public function completeNumerosExtra(){
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $userId = $user->id;
        $activityId = 'NUM4'; // ID de 'Números - Extra' según la migración
        $points = 10; // Puntos fijos para esta actividad

        try {
            DB::beginTransaction();

            // Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $userId)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                // Si existe, actualiza el puntaje
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $userId,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            // Redireccionar al usuario con mensaje
            return redirect()->route('nivel.numeros')->with('success', "La actividad extra de Números se ha completado y se te han otorgado +{$points} puntos. Ve a ver tu progreso en 'Mi Progreso', te esperan nuevas recompensas.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.numeros')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }   

    public function completeSaludosExtra(){
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $userId = $user->id;
        $activityId = 'SL4'; // ID de 'Saludos - Extra' según la migración
        $points = 10; // Puntos fijos para esta actividad

        try {
            DB::beginTransaction();

            // Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $userId)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                // Si existe, actualiza el puntaje
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $userId,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            // Redireccionar al usuario con mensaje
            return redirect()->route('nivel.saludos')->with('success', "La actividad extra de Saludos se ha completado y se te han otorgado +{$points} puntos. Ve a ver tu progreso en 'Mi Progreso', te esperan nuevas recompensas.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.saludos')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    } 
    
    public function completeSaludExtra(){
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar tu progreso.');
        }

        $userId = $user->id;
        $activityId = 'SALUD4'; // ID de 'Salud - Extra' según la migración
        $points = 10; // Puntos fijos para esta actividad

        try {
            DB::beginTransaction();

            // Buscar si ya existe registro para este usuario y actividad
            $puntosUsuario = PuntosUsuario::where('usuario_id', $userId)
                ->where('nivel_id', $activityId)
                ->first();
            if ($puntosUsuario) {
                // Si existe, actualiza el puntaje
                $puntosUsuario->puntos_obtenidos = $points;
                $puntosUsuario->save();
            } else {
                // Si no existe, crea nuevo registro
                PuntosUsuario::create([
                    'usuario_id' => $userId,
                    'nivel_id' => $activityId,
                    'puntos_obtenidos' => $points,
                    'completado' => true,
                    'fecha_completado' => now(),
                ]);
            }

            DB::commit();

            // Redireccionar al usuario con mensaje
            return redirect()->route('nivel.salud')->with('success', "La actividad extra de Salud se ha completado y se te han otorgado +{$points} puntos. Ve a ver tu progreso en 'Mi Progreso', te esperan nuevas recompensas.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nivel.salud')->with('error', 'Ocurrió un error al guardar tu puntuación. Intenta de nuevo.');
        }
    }   
}