<?php

use App\Http\Controllers\LeccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\SenaImgController;
use App\Http\Controllers\ProgressController;
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

    // Lecciones interactivas
    Route::get('/lecciones', [TaskController::class, 'lecciones'])->name('lecciones');

    // Las lecciones:
    Route::get('/lecciones/abecedario',[LeccionesController::class, 'ls1_abecedario'])->name('lecciones.abecedario');
    Route::post('/lecciones/abecedario/complete', [ProgressController::class, 'ls1_complete'])->name('lecciones.abecedario.complete');
    Route::get('/lecciones/numeros',[LeccionesController::class, 'ls2_numeros'])->name('lecciones.numeros');
    

    // Los carruseles:
    Route::get('/carrusel/abecedario',[SenaImgController::class, 'abecedario'])->name(('carrusel.abecedario'));
    Route::get('/carrusel/numeros',[SenaImgController::class, 'numeros'])->name(('carrusel.numeros'));

    // Mini juegos
    Route::get('/lecciones/abecedario/test', [SenaImgController::class, 'deletra_nombre'])->name('ls1_abecedario_test');

    // Videos educativos
    Route::get('/lecciones/videos', [TaskController::class, 'videos'])->name('lecciones.videos');

    // Ver perfil
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');

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