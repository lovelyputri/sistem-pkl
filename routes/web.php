<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaApprovalController;
use Illuminate\Support\Facades\Route;

// =========================
// HALAMAN UTAMA
// =========================

Route::get('/', function () {
    return redirect()->route('login');
});

// =========================
// AUTHENTICATION
// =========================

// Login
Route::get('/login', [
    AuthController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    AuthController::class,
    'login'
])->name('login.process');

// Register tahap 1
Route::get('/register', [
    AuthController::class,
    'showRegister'
])->name('register');

Route::post('/register', [
    AuthController::class,
    'registerStep1'
])->name('register.step1.process');

// Register tahap 2
Route::get('/register/tahap-2', [
    AuthController::class,
    'showRegisterStep2'
])->name('register.step2');

Route::post('/register/tahap-2', [
    AuthController::class,
    'registerStep2'
])->name('register.step2.process');

// Register tahap 3
Route::get('/register/tahap-3', [
    AuthController::class,
    'showRegisterStep3'
])->name('register.step3');

Route::post('/register/selesai', [
    AuthController::class,
    'registerFinish'
])->name('register.finish');

// Lupa password
 Route::get('/lupa-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/lupa-password', [AuthController::class, 'sendResetLink'])
        ->middleware('throttle:5,1')
        ->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// =========================
// LOGOUT
// =========================

Route::post('/logout', [
    AuthController::class,
    'logout'
])->middleware('auth')->name('logout');

// =========================
// DASHBOARD SISWA
// =========================

Route::get('/siswa/dashboard', function () {
    return view('dashboard.siswa');
})->middleware(['auth', 'role:siswa'])
  ->name('siswa.dashboard');

// =========================
// DASHBOARD GURU
// =========================

Route::get('/guru/dashboard', function () {
    return view('dashboard.guru');
})->middleware(['auth', 'role:guru'])
  ->name('guru.dashboard');

// =========================
// DASHBOARD ADMIN
// =========================

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');


// =========================
// PERSETUJUAN PENDAFTARAN SISWA
// =========================

Route::prefix('admin/siswa/approval')
    ->name('admin.siswa.approval.')
    ->middleware(['auth', 'role:admin'])
    ->controller(SiswaApprovalController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/{user}/approve', 'approve')->name('approve');
        Route::patch('/{user}/reject', 'reject')->name('reject');
    });
