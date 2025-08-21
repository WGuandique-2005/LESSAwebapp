<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SenaImgController extends Controller
{
    public function abecedario()
    {
        $jsonPath = storage_path('app/abecedario.json');
        $senas = [];
        if (file_exists($jsonPath)) {
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('carrusel.abecedario', compact('senas'));
    }

        public function numeros(){
        $jsonPath = storage_path('app/numeros.json');
        $senas =[];
        if (file_exists($jsonPath)){
            $senas = json_decode(file_get_contents($jsonPath),true);
        }
        return view('carrusel.numeros', compact('senas'));
    }
}
