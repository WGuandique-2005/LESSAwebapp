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

    public function recuperarPass()
    {
        return view('/Mail/recuperarPass');
    }
}
