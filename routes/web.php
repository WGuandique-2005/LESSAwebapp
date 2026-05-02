<?php

use App\Http\Controllers\LeccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\PuntosUsuarioController;
use App\Http\Controllers\RecompensasUsuarioController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\CameraController;

// Sección de ayuda (accesible para todos)
Route::get('/ayuda',[TaskController::class,'ayuda'])->name('ayuda');
Route::get('/ayuda/manual', [TaskController::class, 'manual'])->name('manual');

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

    // Nuevo: endpoints para polling y remote-login desde la vista de verificación
    Route::get('/verify/status', [UserController::class, 'verifyStatus'])->name('verify.status');
    Route::post('/verify/remote-login', [UserController::class, 'remoteLogin'])->name('verify.remoteLogin');

    // Recuperar contraseña (view)
    Route::get('/recuperar_pass', [UserController::class, 'showRecuperarPassForm'])->name('recuperar');
    // Verificar correo (enviar token)
    Route::post('/recuperar_pass', [UserController::class, 'linkRecuperarPass'])->name('recuperarPass');
    // Nueva contraseña (view)
    Route::get('/new_pass', [UserController::class, 'showNewPassForm'])->name('newPass_view');
    // Procesar nueva contraseña
    Route::post('/new_pass', [UserController::class, 'resetPassword'])->name('newPass');

    // NUEVO: endpoint que las sesiones con el formulario abierto pueden pollear
    Route::get('/recuperar_pass/status', [UserController::class, 'resetStatus'])->name('recuperar.status');

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
    // Admin password protection route
    Route::get('/admin/password', [App\Http\Controllers\AdminController::class, 'showPasswordForm'])->name('admin.password');
    Route::post('/admin/password', [App\Http\Controllers\AdminController::class, 'verifyPassword'])->name('admin.password.verify');

    // Admin dashboard routes (protected by admin middleware)
    Route::middleware('admin')->group(function () {
        // Admin dashboard
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        // User CRUD routes
        Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'listUsers'])->name('admin.users');
        Route::get('/admin/users/create', [App\Http\Controllers\AdminController::class, 'createUserForm'])->name('admin.users.create');
        Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [App\Http\Controllers\AdminController::class, 'editUserForm'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::put('/admin/users/{user}/reset-progress', [App\Http\Controllers\AdminController::class, 'resetProgress'])->name('admin.users.reset-progress');
        Route::post('/admin/users/{user}/make-admin', [App\Http\Controllers\AdminController::class, 'makeAdmin'])->name('admin.users.make-admin');
        Route::post('/admin/users/{user}/remove-admin', [App\Http\Controllers\AdminController::class, 'removeAdmin'])->name('admin.users.remove-admin');
        // Email sending route
        Route::post('/admin/users/{user}/email', [App\Http\Controllers\AdminController::class, 'sendUserEmail'])->name('admin.users.email');
        
        // Global Announcement
        Route::post('/admin/announcement', [App\Http\Controllers\AdminController::class, 'sendAnnouncement'])->name('admin.announcement.send');
    });

    Route::get('/test-403', function () {
        abort(403);
    });

    // Original home route
    Route::get('/home', function () {
        $progressData = \App\Http\Controllers\ProgressController::getHomeProgressData();
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

    Route::get('/practicar/abecedario/extra', [CameraController::class, 'index'])->name('nivel.abecedario.extra');
    Route::post('/practicar/abecedario/extra/complete', [PuntosUsuarioController::class, 'completeAbecedarioExtra'])->name('lecciones.abecedario.extra.complete');

    Route::get('/practicar/abecedario/practice', [CameraController::class, 'practice'])->name('nivel.abecedario.practice');

    // Números
    Route::get('/practicar/numeros', [NivelesController::class, 'numeros'])->name('nivel.numeros');
    Route::get('/practicar/numeros/adivina', [NivelesController::class, 'numeros_adivina'])->name('nivel.numeros.adivina');
    Route::post('/practicar/numeros/adivina/complete', [PuntosUsuarioController::class, 'completeNumerosAdivina'])->name('nivel.numeros.adivina.complete');

    Route::get('/practicar/numeros/memorama', [NivelesController::class, 'numeros_memorama'])->name('nivel.numeros.memorama');
    Route::post('/practicar/numeros/memorama/complete', [PuntosUsuarioController::class, 'completeNumerosMemorama'])->name('lecciones.numeros.memorama.complete');

    Route::get('/practicar/numeros/conecta', [NivelesController::class, 'numeros_conecta'])->name('nivel.numeros.conecta');
    Route::post('/practicar/numeros/conecta/complete', [PuntosUsuarioController::class, 'completeNumerosConecta'])->name('lecciones.numeros.conecta.complete');

    Route::get('/practicar/numeros/extra', [CameraController::class, 'numeros'])->name('nivel.numeros.extra');
    Route::post('/practicar/numeros/extra/complete', [PuntosUsuarioController::class, 'completeNumerosExtra'])->name('lecciones.numeros.extra.complete');

    // Saludos
    Route::get('/practicar/saludos', [NivelesController::class, 'saludos'])->name('nivel.saludos');
    Route::get('/practicar/saludos/adivina', [NivelesController::class, 'saludos_adivina'])->name('nivel.saludos.adivina');
    Route::post('/practicar/saludos/adivina/complete', [PuntosUsuarioController::class, 'completeSaludosAdivina'])->name('nivel.saludos.adivina.complete');

    Route::get('/practicar/saludos/memorama', [NivelesController::class, 'saludos_memorama'])->name('nivel.saludos.memorama');
    Route::post('/practicar/saludos/memorama/complete', [PuntosUsuarioController::class, 'completeSaludosMemorama'])->name('lecciones.saludos.memorama.complete');

    Route::get('/practicar/saludos/conecta', [NivelesController::class, 'saludos_conecta'])->name('nivel.saludos.conecta');
    Route::post('/practicar/saludos/conecta/complete', [PuntosUsuarioController::class, 'completeSaludosConecta'])->name('lecciones.saludos.conecta.complete');

    Route::get('/practicar/saludos/extra', [NivelesController::class, 'saludos_extra'])->name('nivel.saludos.extra');
    Route::post('/practicar/saludos/extra/complete', [PuntosUsuarioController::class, 'completeSaludosExtra'])->name('lecciones.saludos.extra.complete');
    
    // Salud
    Route::get('/practicar/salud', [NivelesController::class, 'salud'])->name('nivel.salud');
    Route::get('/practicar/salud/adivina', [NivelesController::class, 'salud_adivina'])->name('nivel.salud.adivina');
    Route::post('/practicar/salud/adivina/complete', [PuntosUsuarioController::class, 'completeSaludAdivina'])->name('nivel.salud.adivina.complete');

    Route::get('/practicar/salud/memorama', [NivelesController::class, 'salud_memorama'])->name('nivel.salud.memorama');
    Route::post('/practicar/salud/memorama/complete', [PuntosUsuarioController::class, 'completeSaludMemorama'])->name('lecciones.salud.memorama.complete');

    Route::get('/practicar/salud/conecta', [NivelesController::class, 'salud_conecta'])->name('nivel.salud.conecta');
    Route::post('/practicar/salud/conecta/complete', [PuntosUsuarioController::class, 'completeSaludConecta'])->name('lecciones.salud.conecta.complete');

    Route::get('/practicar/salud/extra', [NivelesController::class, 'salud_extra'])->name('nivel.salud.extra');
    Route::post('/practicar/salud/extra/complete', [PuntosUsuarioController::class, 'completeSaludExtra'])->name('lecciones.salud.extra.complete');
    /*
    |----------------------------------|
    | Las recompensas                  |
    |----------------------------------|
    */
    Route::get('/recompensas/desbloquear/{recompensaId}', [RecompensasUsuarioController::class, 'desbloquearRecompensa'])
    ->middleware('auth') // Asumiendo que solo usuarios logueados pueden desbloquear
    ->name('desbloquear.recompensa');
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

    // Ranking de usuarios
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

    // Videos educativos
    Route::get('/lecciones/videos', [TaskController::class, 'videos'])->name('lecciones.videos');

    // Diccionario interactivo
    Route::get('/lecciones/diccionario', [TaskController::class, 'diccionario'])->name('lecciones.diccionario');

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

// Fallback para rutas no encontradas -> muestra la vista 404
Route::fallback([TaskController::class, 'notFound']);