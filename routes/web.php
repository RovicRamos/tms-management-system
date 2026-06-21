<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\SeminarController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('home');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [PageController::class, 'storeRegistration'])->name('register.store');

Route::middleware('auth')->group(function () {
	Route::post('/logout', [PageController::class, 'logout'])->name('logout');
	Route::get('/seminars', [SeminarController::class, 'index'])->name('seminars');
	Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
		Route::resource('/events', EventController::class)->except(['show']);
		Route::resource('/sessions', SessionController::class)->except(['show']);
		Route::resource('/users', UserController::class)->except(['show', 'create', 'store']);
		Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
		Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
	});
});