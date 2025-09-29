<?php

use App\Http\Controllers\LeccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NivelesController;
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
        return view('home');
    })->name('home');

    // Info
    Route::get('/info', [TaskController::class, 'info'])->name('info');

    // Sección aprender
    Route::get('/aprender',[TaskController::class,'aprender'])->name('aprender');

    // Sección practicar
    Route::get('/practicar', [TaskController::class, 'practicar'])->name('practicar');

    // Nivel Abecadario
    Route::get('/practicar/abecedario', [NivelesController::class, 'abecedario'])->name('nivel.abecedario');

    // Lecciones interactivas
    Route::get('/lecciones', [TaskController::class, 'lecciones'])->name('lecciones');

    /*
    |----------------------------------|
    | Las lecciones                    |
    |----------------------------------|
    */

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

    /*
    |----------------------------------|
    | Minijuegos                       |
    |----------------------------------|
    */

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