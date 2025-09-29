<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelesController extends Controller
{
    function abecedario(){
        return view('practica_section.abecedario');
    }

    function numeros(){
        return view('practica_section.numeros');
    }
    function saludos(){
        return view('practica_section.saludos');
    }
    function salud(){
        return view('practica_section.salud');
    }
}
