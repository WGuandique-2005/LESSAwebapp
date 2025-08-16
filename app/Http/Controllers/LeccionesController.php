<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leccion;

class LeccionesController extends Controller
{
    public function ls1_abecedario()
    {
        return view('lessons.ls1_abcd');
    }
}
