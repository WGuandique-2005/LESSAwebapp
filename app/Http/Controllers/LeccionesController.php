<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leccion;

class LeccionesController extends Controller
{
    public function ls1_abecedario()
    {
        $jsonPath = storage_path('app/abecedario.json');
        $senas = [];
        if (file_exists($jsonPath)) {
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('lessons.ls1_abcd', compact('senas'));
    }

    public function ls2_numeros(){
        $jsonPath = storage_path('app/numeros.json');
        $senas =[];
        if (file_exists($jsonPath)){
            $senas = json_decode(file_get_contents($jsonPath),true);
        }
        return view('lessons.ls2_nums', compact('senas'));
    }

    public function ls3_saludos(){
        $jsonPath = storage_path('app/saludos.json');
        $senas =[];
        if(file_exists($jsonPath)){
            $senas = json_decode(file_get_contents($jsonPath), true);
        }
        return view('lessons.ls3_saludos', compact('senas'));
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
