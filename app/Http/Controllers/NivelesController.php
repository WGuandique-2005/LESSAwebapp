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
        $jsonPath = storage_path('app/abecedario.json');
        $abecedarioData = [];

        if (file_exists($jsonPath)) {
            $abecedarioData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        return view('practica_section.abecedario.A1_adivina', compact('abecedarioData'));
    }


    function abecedario_deletrea(){
        $jsonPath = storage_path('app/abecedario.json');
        $abecedarioData = [];

        if (file_exists($jsonPath)) {
            $abecedarioData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        return view('practica_section.abecedario.a2_deletrea', compact('abecedarioData'));
    }

    function abecedario_conecta(){
        $jsonPath = storage_path('app/abecedario.json');
        $abecedarioData = [];

        if (file_exists($jsonPath)) {
            $abecedarioData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        return view('practica_section.abecedario.a3_conecta', compact('abecedarioData'));
    }

    function abecedario_extra(){
        return view('practica_section.abecedario.a4_extra');
    }

    function numeros(){
        return view('practica_section.numeros');
    }

    function numeros_adivina(){
        $jsonPath = storage_path('app/numeros.json');
        $numerosData = [];

        if (file_exists($jsonPath)) {
            $numerosData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        return view('practica_section.numeros.A1_adivina', compact('numerosData'));
    }

    function numeros_conecta(){
        $jsonPath = storage_path('app/numeros.json');
        $numerosData = [];

        if (file_exists($jsonPath)) {
            $numerosData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        return view('practica_section.numeros.A3_conecta', compact('numerosData'));
    }

    function saludos(){
        return view('practica_section.saludos');
    }

    function saludos_adivina(){
        $jsonPath = storage_path('app/saludos.json');
        $saludosData = [];

        if (file_exists($jsonPath)) {
            $saludosData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        return view('practica_section.saludos.A1_adivina', compact('saludosData'));
    }

    function saludos_conecta(){
        $jsonPath = storage_path('app/saludos.json');
        $saludosData = [];

        if (file_exists($jsonPath)) {
            $saludosData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        return view('practica_section.saludos.A3_conecta', compact('saludosData'));
    }

    function salud(){
        return view('practica_section.salud');
    }

    function salud_adivina(){
        $jsonPath = storage_path('app/salud.json');
        $saludData = [];

        if (file_exists($jsonPath)) {
            $saludData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        return view('practica_section.salud.A1_adivina', compact('saludData'));
    }
}
