<?php

use App\Http\Controllers\LeccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\PuntosUsuarioController;

/*
|----------------------------------
| Rutas públicas (landing y auth)
|----------------------------------
*/

Route::middleware('guest')->group(function (){
    // Landing page
    Route::get('/', [TaskController::class, 'index'])->name('/');
    // Sección de ayuda
    Route::get('/ayuda',[TaskController::class,'ayuda'])->name('ayuda');

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

    // Recuperar contraseña (view)
    Route::get('/recuperar_pass', [UserController::class, 'showRecuperarPassForm'])->name('recuperar');
    // Verificar correo (enviar token)
    Route::post('/recuperar_pass', [UserController::class, 'linkRecuperarPass'])->name('recuperarPass');
    // Nueva contraseña (view)
    Route::get('/new_pass', [UserController::class, 'showNewPassForm'])->name('newPass_view');
    // Procesar nueva contraseña
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
        $progressData = ProgressController::getHomeProgressData();
        return view('home', compact('progressData'));
    })->name('home');

    // Info
    Route::get('/info', [TaskController::class, 'info'])->name('info');

    // Sección aprender
    Route::get('/aprender',[TaskController::class,'aprender'])->name('aprender');

    // Sección practicar
    Route::get('/practicar', [TaskController::class, 'practicar'])->name('practicar');

    /*
    |----------------------------------|
    | Minijuegos                       |
    |----------------------------------|
    */
    // Abecedario
    Route::get('/practicar/abecedario', [NivelesController::class, 'abecedario'])->name('nivel.abecedario');
    Route::get('/practicar/abecedario/adivina', [NivelesController::class, 'abecedario_adivina'])->name('nivel.abecedario.adivina');
    Route::post('/practicar/abecedario/adivina/complete', [PuntosUsuarioController::class, 'completeAbecedarioAdivina'])->name('nivel.abecedario.adivina.complete');

    Route::get('/practicar/abecedario/memorama', [NivelesController::class, 'abecedario_memorama'])->name('nivel.abecedario.memorama');
    Route::post('/practicar/abecedario/memorama/complete', [PuntosUsuarioController::class, 'completeAbecedarioMemorama'])->name('lecciones.abecedario.memorama.complete');

    Route::get('/practicar/abecedario/conecta', [NivelesController::class, 'abecedario_conecta'])->name('nivel.abecedario.conecta');
    Route::get('/practicar/abecedario/conecta', [NivelesController::class, 'abecedario_conecta'])->name('nivel.abecedario.conecta');
    Route::post('/practicar/abecedario/conecta/complete', [PuntosUsuarioController::class, 'completeAbecedarioConecta'])->name('lecciones.abecedario.conecta.complete');

    Route::get('/practicar/abecedario/extra', [NivelesController::class, 'abecedario_extra'])->name('nivel.abecedario.extra');

    // Números
    Route::get('/practicar/numeros', [NivelesController::class, 'numeros'])->name('nivel.numeros');
    Route::get('/practicar/numeros/adivina', [NivelesController::class, 'numeros_adivina'])->name('nivel.numeros.adivina');
    Route::post('/practicar/numeros/adivina/complete', [PuntosUsuarioController::class, 'completeNumerosAdivina'])->name('nivel.numeros.adivina.complete');

    Route::get('/practicar/numeros/memorama', [NivelesController::class, 'numeros_memorama'])->name('nivel.numeros.memorama');
    Route::post('/practicar/numeros/memorama/complete', [PuntosUsuarioController::class, 'completeNumerosMemorama'])->name('lecciones.numeros.memorama.complete');

    Route::get('/practicar/numeros/conecta', [NivelesController::class, 'numeros_conecta'])->name('nivel.numeros.conecta');
    Route::post('/practicar/numeros/conecta/complete', [PuntosUsuarioController::class, 'completeNumerosConecta'])->name('lecciones.numeros.conecta.complete');

    Route::get('/practicar/numeros/extra', [NivelesController::class, 'numeros_extra'])->name('nivel.numeros.extra');

    // Saludos
    Route::get('/practicar/saludos', [NivelesController::class, 'saludos'])->name('nivel.saludos');
    Route::get('/practicar/saludos/adivina', [NivelesController::class, 'saludos_adivina'])->name('nivel.saludos.adivina');
    Route::post('/practicar/saludos/adivina/complete', [PuntosUsuarioController::class, 'completeSaludosAdivina'])->name('nivel.saludos.adivina.complete');

    Route::get('/practicar/saludos/memorama', [NivelesController::class, 'saludos_memorama'])->name('nivel.saludos.memorama');
    Route::post('/practicar/saludos/memorama/complete', [PuntosUsuarioController::class, 'completeSaludosMemorama'])->name('lecciones.saludos.memorama.complete');

    Route::get('/practicar/saludos/conecta', [NivelesController::class, 'saludos_conecta'])->name('nivel.saludos.conecta');
    Route::post('/practicar/saludos/conecta/complete', [PuntosUsuarioController::class, 'completeSaludosConecta'])->name('lecciones.saludos.conecta.complete');

    Route::get('/practicar/saludos/extra', [NivelesController::class, 'saludos_extra'])->name('nivel.saludos.extra');
    
    // Salud
    Route::get('/practicar/salud', [NivelesController::class, 'salud'])->name('nivel.salud');
    Route::get('/practicar/salud/adivina', [NivelesController::class, 'salud_adivina'])->name('nivel.salud.adivina');
    Route::post('/practicar/salud/adivina/complete', [PuntosUsuarioController::class, 'completeSaludAdivina'])->name('nivel.salud.adivina.complete');

    Route::get('/practicar/salud/memorama', [NivelesController::class, 'salud_memorama'])->name('nivel.salud.memorama');
    Route::post('/practicar/salud/memorama/complete', [PuntosUsuarioController::class, 'completeSaludMemorama'])->name('lecciones.salud.memorama.complete');

    Route::get('/practicar/salud/conecta', [NivelesController::class, 'salud_conecta'])->name('nivel.salud.conecta');
    Route::post('/practicar/salud/conecta/complete', [PuntosUsuarioController::class, 'completeSaludConecta'])->name('lecciones.salud.conecta.complete');

    Route::get('/practicar/salud/extra', [NivelesController::class, 'salud_extra'])->name('nivel.salud.extra');

    /*
    |----------------------------------|
    | Las lecciones                    |
    |----------------------------------|
    */
    Route::get('/lecciones', [TaskController::class, 'lecciones'])->name('lecciones');

    Route::get('/lecciones/abecedario',[LeccionesController::class, 'ls1_abecedario'])->name('lecciones.abecedario');
    Route::get('/lecciones/abecedario/test', [LeccionesController::class, 'deletra_nombre'])->name('ls1_abecedario_test');
    Route::post('/lecciones/abecedario/complete', [ProgressController::class, 'ls1_complete'])->name('lecciones.abecedario.complete');
    
    Route::get('/lecciones/numeros',[LeccionesController::class, 'ls2_numeros'])->name('lecciones.numeros');
    Route::get('/lecciones/numeros/test', [LeccionesController::class, 'conecta_numeros'])->name('ls2_numeros_test');
    Route::post('/lecciones/numeros/complete', [ProgressController::class, 'ls2_complete'])->name('lecciones.numeros.complete');

    Route::get('/lecciones/saludos',[LeccionesController::class, 'ls3_saludos'])->name('lecciones.saludos');
    Route::get('/lecciones/saludos/test', [LeccionesController::class, 'memorama_saludos'])->name('ls3_saludos_test');
    Route::post('/lecciones/saludos/complete', [ProgressController::class, 'ls3_complete'])->name('lecciones.saludos.complete');

    Route::get('/lecciones/salud',[LeccionesController::class, 'ls4_salud'])->name('lecciones.salud');
    Route::get('/lecciones/salud/test', [LeccionesController::class, 'memorama_salud'])->name('ls4_salud_test');
    Route::post('/lecciones/salud/complete', [ProgressController::class, 'ls4_complete'])->name('lecciones.salud.complete');

    // Videos educativos
    Route::get('/lecciones/videos', [TaskController::class, 'videos'])->name('lecciones.videos');

    // Ver perfil
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    // Ver progreso
    Route::get('/miProgreso',[ProgressController::class, 'miProgreso'])->name('miProgreso');

    // Mostrar formulario para editar perfil
    Route::get('/profile/edit', [UserController::class, 'showEditProfileForm'])
        ->name('profile.edit');
    // Procesar actualización de perfil (nombre y username)
    Route::post('/profile/edit', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    // Mostrar el formulario de cambio de contraseña
    Route::get('/change_password', [UserController::class, 'showChangePasswordForm'])
        ->middleware('auth')
        ->name('password.change.form');
    // Procesar el cambio de contraseña
    Route::post('/change_password', [UserController::class, 'changePassword'])
        ->name('password.change');

    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Eliminar cuenta
    Route::get('/delete_account', [UserController::class, 'destroy'])->name('delete.account');
});