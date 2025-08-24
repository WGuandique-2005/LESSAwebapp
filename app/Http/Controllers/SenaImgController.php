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

    public function numeros()
    {
        $jsonPath = storage_path('app/numeros.json');
        $senas = [];
        if (file_exists($jsonPath)) {
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('carrusel.numeros', compact('senas'));
    }

    public function saludos()
    {
        $jsonPath = storage_path('app/saludos.json');
        $senas = [];
        if (file_exists($jsonPath)) {
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('carrusel.saludos', compact('senas'));
    }

    // Actividades de practica de las lecciones:
    public function deletra_nombre()
    {
        return view('tests.abecedario');
    }

    public function conecta_numeros(){
        return view('tests.numeros');
    }

    public function memorama_saludos(){
        return view('tests.saludos');
    }
}