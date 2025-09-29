<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelesController extends Controller
{
    function abecedario(){
        return view('practica_section.abecedario');
    }
}
