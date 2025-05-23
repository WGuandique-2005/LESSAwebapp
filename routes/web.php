<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

//----------------------------------
// Rutas para el envío de correos
//----------------------------------


/*
|----------------------------------
| Rutas públicas (landing y auth)
|----------------------------------
*/

// Landing page
Route::get('/', [TaskController::class, 'index'])->name('/');
// Login
Route::get('/login', [TaskController::class, 'loginForm'])->name('login');

// Registro de usuario
Route::get('/signup', [UserController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [UserController::class, 'register'])->name('signup.submit');

Route::get('/recuperar_pass', [TaskController::class, 'recuperarPass'])->name('recuperar');

/*
|----------------------------------
| Rutas protegidas (requieren auth)
|----------------------------------
*/

Route::middleware('auth')->group(function () {
    //
});