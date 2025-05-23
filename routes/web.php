<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;

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
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

// Registro de usuario
Route::get('/signup', [UserController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [UserController::class, 'register'])->name('signup.submit');



Route::get('/recuperar_pass', [TaskController::class, 'recuperarPass'])->name('recuperar');
//----------------------------------
// Google OAuth authentication
//----------------------------------
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
/*
|----------------------------------
| Rutas protegidas (requieren auth)
|----------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});