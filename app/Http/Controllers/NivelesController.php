<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelesController extends Controller
{
    function abecedario(){
        return view('practica_section.abecedario');
    }

    function abecedario_adivina(){
        // Define la ruta al archivo JSON
        $jsonPath = storage_path('app/abecedario.json');
        $abecedarioData = [];

        // Verifica si el archivo existe antes de cargarlo
        if (file_exists($jsonPath)) {
            // Carga y decodifica el JSON. Si falla, $abecedarioData será un array vacío.
            $abecedarioData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        // Pasa los datos del abecedario a la vista
        return view('practica_section.abecedario.A1_adivina', compact('abecedarioData'));
    }

    function abecedario_deletrea(){
        return view('practica_section.abecedario.a2_deletrea');
    }

    function abecedario_conecta(){
        return view('practica_section.abecedario.a3_conecta');
    }

    function abecedario_extra(){
        return view('practica_section.abecedario.a4_extra');
    }

    function numeros(){
        return view('practica_section.numeros');
    }

    function numeros_adivina(){
        // Define la ruta al archivo JSON
        $jsonPath = storage_path('app/numeros.json');
        $numerosData = [];

        // Verifica si el archivo existe antes de cargarlo
        if (file_exists($jsonPath)) {
            // Carga y decodifica el JSON. Si falla, $numerosData será un array vacío.
            $numerosData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        // Pasa los datos del abecedario a la vista
        return view('practica_section.numeros.A1_adivina', compact('numerosData'));
    }

    function saludos(){
        return view('practica_section.saludos');
    }
    function salud(){
        return view('practica_section.salud');
    }
}
