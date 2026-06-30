<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Client\SeminarController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('home');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [PageController::class, 'storeRegistration'])->name('register.store');

Route::get('/email/verify', [PageController::class, 'verifyNotice'])->name('verification.notice');
Route::get('/email/verify/{id}/{token}', [PageController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/email/verification-notification', [PageController::class, 'resendVerification'])->name('verification.resend');

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
		
		// Notifications
		Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
		Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
		Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
		Route::delete('/notifications/{notification}', [NotificationController::class, 'delete'])->name('notifications.delete');
		Route::get('/notifications/unread/count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
		Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');
		
		// Activity Logs
		Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
		Route::get('/logs/{log}', [LogController::class, 'show'])->name('logs.show');
		Route::get('/logs/filter', [LogController::class, 'filter'])->name('logs.filter');
		Route::get('/logs/export', [LogController::class, 'export'])->name('logs.export');
	});
});