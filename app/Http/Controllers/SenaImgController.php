<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SenaImgController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/abecedario.json');
        $senas = [];
        if (file_exists($jsonPath)) {
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('carrusel.abecedario', compact('senas'));
    }
}
