<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('/');
Route::get('/login', [TaskController::class, 'loginForm'])->name('login');