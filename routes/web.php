<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'landing'])->name('landing');

Route::get('/login', [PageController::class, 'login'])->name('login');

Route::get('/register', [PageController::class, 'register'])->name('register');
