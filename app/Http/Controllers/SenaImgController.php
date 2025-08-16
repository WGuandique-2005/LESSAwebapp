<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SenaImgController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/senas.json');

        if (!File::exists($jsonPath)) {
            return view('senas_carrusel', ['senas' => []]);
        }

        $senasData = json_decode(File::get($jsonPath), true);

        // Asegúrate de que el nombre de la vista coincida con el nombre de tu archivo .blade.php
        return view('senas_carrusel', ['senas' => $senasData]);
    }
}
