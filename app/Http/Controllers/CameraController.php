<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CameraController extends Controller
{
    public function index()
    {
        return view('practica_section.abecedario.camara');
    }

    public function practice()
    {
        return view('practica_section.abecedario.practice');
    }

    public function numeros()
    {
        return view('practica_section.numeros.camara');
    }
}
