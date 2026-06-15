<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Client\SeminarController; // <-- Make sure this line is exactly here

// Authentication Routes
Route::get('/', [PageController::class, 'landing']);
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [PageController::class, 'storeRegistration'])->name('register.store');
Route::post('/logout', [PageController::class, 'logout'])->name('logout');

// Seminar Dashboard Route
// Change this line to make sure it calls your SeminarController!
Route::get('/seminars', [SeminarController::class, 'index'])->name('seminars');
// routes/web.php

Route::middleware(['auth'])->group(function () {
Route::get('/seminars', [SeminarController::class, 'index'])->name('seminars.index');
});