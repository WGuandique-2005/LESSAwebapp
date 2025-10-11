<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelesController extends Controller
{
    // Método privado para cargar datos JSON por nivel
    private function cargarDatos($archivo)
    {
        $jsonPath = storage_path("app/{$archivo}.json");
        $data = [];
        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        return $data;
    }

    function abecedario(){
        return view('practica_section.abecedario');
    }

    function abecedario_adivina(){
        $abecedarioData = $this->cargarDatos('abecedario');
        return view('practica_section.abecedario.A1_adivina', compact('abecedarioData'));
    }


    function abecedario_memorama(){
        $abecedarioData = $this->cargarDatos('abecedario');
        return view('practica_section.abecedario.a2_memorama', compact('abecedarioData'));
    }

    function abecedario_conecta(){
        $abecedarioData = $this->cargarDatos('abecedario');
        return view('practica_section.abecedario.a3_conecta', compact('abecedarioData'));
    }

    function abecedario_extra(){
        return view('practica_section.abecedario.a4_extra');
    }

    function numeros(){
        return view('practica_section.numeros');
    }

    function numeros_adivina(){
        $numerosData = $this->cargarDatos('numeros');
        return view('practica_section.numeros.A1_adivina', compact('numerosData'));
    }

    function numeros_memorama(){
        $numerosData = $this->cargarDatos('numeros');
        return view('practica_section.numeros.A2_memorama', compact('numerosData'));
    }

    function numeros_conecta(){
        $numerosData = $this->cargarDatos('numeros');
        return view('practica_section.numeros.A3_conecta', compact('numerosData'));
    }

    function saludos(){
        return view('practica_section.saludos');
    }

    function saludos_adivina(){
        $saludosData = $this->cargarDatos('saludos');
        return view('practica_section.saludos.A1_adivina', compact('saludosData'));
    }

    function saludos_memorama(){
        $saludosData = $this->cargarDatos('saludos');
        return view('practica_section.saludos.A2_memorama', compact('saludosData'));
    }

    function saludos_conecta(){
        $saludosData = $this->cargarDatos('saludos');
        return view('practica_section.saludos.A3_conecta', compact('saludosData'));
    }

    function salud(){
        return view('practica_section.salud');
    }

    function salud_adivina(){
        $saludData = $this->cargarDatos('salud');
        return view('practica_section.salud.A1_adivina', compact('saludData'));
    }

    function salud_memorama(){
        $saludosData = $this->cargarDatos('saludos');
        return view('practica_section.salud.A2_memorama', compact('saludosData'));
    }

    function salud_conecta(){
        $saludData = $this->cargarDatos('salud');
        return view('practica_section.salud.A3_conecta', compact('saludData'));
    }
}
