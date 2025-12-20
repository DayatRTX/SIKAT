<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.photo');
});


Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/laporan/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/laporan', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/laporan', [ReportController::class, 'myReports'])->name('reports.index');
    Route::get('/laporan/{report}', [ReportController::class, 'show'])->name('reports.show');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/laporan', [ReportController::class, 'adminIndex'])->name('reports.index');
    Route::get('/laporan/{report}', [ReportController::class, 'adminShow'])->name('reports.show');
    Route::post('/laporan/{report}/validate', [ReportController::class, 'validate'])->name('reports.validate');
    Route::put('/laporan/{report}/assign', [ReportController::class, 'assign'])->name('reports.assign');
    Route::put('/laporan/{report}/reject', [ReportController::class, 'reject'])->name('reports.reject');

    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('/tugas', [ReportController::class, 'teknisiIndex'])->name('tasks.index');
    Route::get('/tugas/{report}', [ReportController::class, 'teknisiShow'])->name('tasks.show');
    Route::put('/tugas/{report}/complete', [ReportController::class, 'complete'])->name('tasks.complete');
});

// Notification Routes
Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/unread-count', [App\Http\Controllers\NotificationController::class, 'unreadCount'])->name('unreadCount');
    Route::get('/recent', [App\Http\Controllers\NotificationController::class, 'recent'])->name('recent');
    Route::get('/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('read');
    Route::post('/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('markAllRead');
});

