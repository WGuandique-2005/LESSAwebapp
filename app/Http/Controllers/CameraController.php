<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CameraController extends Controller
{
    public function index()
    {
        return view('practica_section.abecedario.camara');
    }

    public function numeros()
    {
        return view('practica_section.numeros.camara');
    }

    // Endpoint: recibe landmarks o imagen en base64 y devuelve algo (placeholder)
    public function detect(Request $request)
    {
        // Ejemplo: recibir landmarks y responder con echo simple
        // $request->validate(['landmarks' => 'required|array']);
        $landmarks = $request->input('landmarks', null);

        // Aquí podrías llamar a un servicio Python o a un modelo entrenado.
        // Por ahora devolvemos conteo de manos detectadas si existe
        $resp = [
            'ok' => true,
            'received' => $landmarks ? count($landmarks) : 0,
            'message' => 'Endpoint de ejemplo: aquí procesarías landmarks o imagenes.'
        ];

        Log::info('Detect endpoint', ['count' => $resp['received']]);

        return response()->json($resp);
    }
}
