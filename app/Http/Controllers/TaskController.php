<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function info()
    {
        return view('info');
    }

    public function aprender()
    {
        return view('aprender');
    }

    public function lecciones(){
        return view('lsIntcvs');
    }

    public function videos(){
        return view(('lessons.Evideos'));
    }

    public function practicar(){
        return view('practica_section.practicar');
    }

    public function ayuda(){
        return view('ayuda');
    }

    public function diccionario(){
        // Leer los JSON desde storage/app y pasar como arrays a la vista
        $base = storage_path('app');

        $abecedario = json_decode(file_get_contents($base . '/abecedario.json'), true) ?? [];
        $numeros     = json_decode(file_get_contents($base . '/numeros.json'), true) ?? [];
        $salud       = json_decode(file_get_contents($base . '/salud.json'), true) ?? [];
        $saludos     = json_decode(file_get_contents($base . '/saludos.json'), true) ?? [];

        return view('lessons.diccionario', compact('abecedario','numeros','salud','saludos'));
    }

    public function notFound()
    {
        return response()->view('errors.404', [], 404);
    }
}
