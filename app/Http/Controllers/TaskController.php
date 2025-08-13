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
}
