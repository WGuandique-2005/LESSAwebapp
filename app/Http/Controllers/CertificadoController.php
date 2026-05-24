<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresoUsuario;
use App\Models\Leccion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CertificadoController extends Controller
{
    /**
     * Verifica si el usuario ha completado todas las lecciones.
     */
    private function usuarioCompletoTodo(): bool
    {
        $userId = auth()->id();
        $totalLecciones = Leccion::count();
        $leccionesCompletadas = ProgresoUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->distinct('leccion_id')
            ->count('leccion_id');

        return $totalLecciones > 0 && $leccionesCompletadas >= $totalLecciones;
    }

    /**
     * Descarga el certificado en PDF si todas las lecciones están completadas.
     */
    public function descargar()
    {
        if (!$this->usuarioCompletoTodo()) {
            return redirect()->route('miProgreso')->with('reward_result', [
                'status' => 'locked',
                'title' => '¡Aún no puedes obtener tu certificado!',
                'message' => 'Debes completar todas las 4 lecciones del curso para poder descargar tu certificado de aprobación.',
                'route' => 'lecciones',
                'puntos_req' => null,
            ]);
        }

        $user = auth()->user();

        // Obtener la fecha de la última lección completada
        $ultimaFecha = ProgresoUsuario::where('usuario_id', $user->id)
            ->where('completado', true)
            ->orderBy('fecha_completada', 'desc')
            ->value('fecha_completada');

        $fechaCompletado = $ultimaFecha
            ? Carbon::parse($ultimaFecha)->format('d \d\e F \d\e Y')
            : Carbon::now()->format('d \d\e F \d\e Y');

        // Convertir imágenes a base64 para embeber en el PDF
        $lessaLogo = $this->imageToBase64(public_path('img/docs/lessa_logo.png'));
        $ugbLogo = $this->imageToBase64(public_path('img/docs/ugb_logo.png'));
        $minedLogo = $this->imageToBase64(public_path('img/docs/mined_logo.png'));

        $data = [
            'nombreUsuario' => $user->name,
            'fechaCompletado' => $fechaCompletado,
            'lessaLogo' => $lessaLogo,
            'ugbLogo' => $ugbLogo,
            'minedLogo' => $minedLogo,
        ];

        $pdf = Pdf::loadView('certificado.diploma', $data);
        $pdf->setPaper('A4', 'landscape');

        $nombreArchivo = 'Certificado_LESSA_' . str_replace(' ', '_', $user->name) . '.pdf';

        return $pdf->download($nombreArchivo);
    }

    /**
     * Convierte una imagen a base64 para embeber en HTML del PDF.
     */
    private function imageToBase64(string $path): string
    {
        if (!file_exists($path)) {
            return '';
        }

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    /**
     * API endpoint para verificar si el usuario puede descargar el certificado.
     */
    public function verificarEstado()
    {
        $completo = $this->usuarioCompletoTodo();
        $userId = auth()->id();
        $totalLecciones = Leccion::count();
        $leccionesCompletadas = ProgresoUsuario::where('usuario_id', $userId)
            ->where('completado', true)
            ->distinct('leccion_id')
            ->count('leccion_id');

        return response()->json([
            'puede_descargar' => $completo,
            'lecciones_completadas' => $leccionesCompletadas,
            'total_lecciones' => $totalLecciones,
        ]);
    }
}
