<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

// Halaman Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes - Semua Role
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/laporan/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/laporan', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/laporan', [ReportController::class, 'myReports'])->name('reports.index');
    Route::get('/laporan/{report}', [ReportController::class, 'show'])->name('reports.show');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan', [ReportController::class, 'adminIndex'])->name('reports.index');
    Route::get('/laporan/{report}', [ReportController::class, 'adminShow'])->name('reports.show');
    Route::post('/laporan/{report}/validate', [ReportController::class, 'validate'])->name('reports.validate');
    Route::post('/laporan/{report}/assign', [ReportController::class, 'assign'])->name('reports.assign');
});

// Teknisi Routes
Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('/tugas', [ReportController::class, 'teknisiIndex'])->name('tasks.index');
    Route::get('/tugas/{report}', [ReportController::class, 'teknisiShow'])->name('tasks.show');
    Route::post('/tugas/{report}/complete', [ReportController::class, 'complete'])->name('tasks.complete');
});

