<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leccion;

class LeccionesController extends Controller
{
    public function ls1_abecedario()
    {
        $jsonPath = storage_path('app/senas.json');
        $senas = [];
        if (file_exists($jsonPath)) {
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('lessons.ls1_abcd', compact('senas'));
    }
}
