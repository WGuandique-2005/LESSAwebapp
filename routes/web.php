<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;

/*
|----------------------------------
| Rutas públicas (landing y auth)
|----------------------------------
*/

Route::middleware('guest')->group(function (){
    // Landing page
    Route::get('/', [TaskController::class, 'index'])->name('/');
    // Login
    Route::get('/login', [TaskController::class, 'loginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');

    // Registro de usuario
    Route::get('/signup', [UserController::class, 'showSignUpForm'])->name('signup');
    Route::post('/signup', [UserController::class, 'register'])->name('signup.submit');
    // Verificación de cuenta
    Route::get ('/verify', [UserController::class,'showVerifyForm'])->name('verify.view');
    Route::post('/verify', [UserController::class,'verifyAccount'])->name('verify.submit');
    Route::post('/verify/resend',[UserController::class,'resendToken'])->name('verify.resend');


    // Recuperar contraseña
    Route::get('/recuperar_pass', [UserController::class, 'showRecuperarPassForm'])->name('recuperar');
    // Verificar correo
    Route::post('/recuperar_pass', [UserController::class, 'linkRecuperarPass'])->name('recuperarPass');
    // Nueva contraseña
    Route::get('/new_pass', [UserController::class, 'showNewPassForm'])->name('newPass_view');
    Route::post('/new_pass', [UserController::class, 'resetPassword'])->name('newPass');

    //----------------------------------
    // Google OAuth authentication
    //----------------------------------
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});
/*
|----------------------------------
| Rutas protegidas (requieren auth)
|----------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Ver y editar perfil
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    // Mostrar formulario para editar nombre y username
    Route::get('/profile/edit', [UserController::class, 'showEditProfileForm'])
        ->name('profile.edit');
    // Procesar actualización de perfil (nombre y username)
    Route::post('/profile/edit', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    // Paso 1: Mostrar formulario para solicitar token de cambio de contraseña
    Route::get('/change_password_request', [UserController::class, 'showChangePasswordRequestForm'])
        ->middleware('auth')
        ->name('password.change.request');

    // Paso 2: Procesar envío del token al correo
    Route::post('/change_password_request', [UserController::class, 'sendChangePasswordToken'])
        ->middleware('auth')
        ->name('password.change.send');

    // Paso 3: Mostrar formulario para ingresar token + nueva contraseña
    Route::get('/change_password_confirm', [UserController::class, 'showChangePasswordConfirmForm'])
        ->name('password.change.confirm.view');

    // Paso 4: Procesar el cambio de contraseña con el token
    Route::post('/change_password_confirm', [UserController::class, 'changePasswordWithToken'])
        ->name('password.change.confirm');

    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});