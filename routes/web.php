<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaApprovalController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SekolahJurusanController;

use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\SiswaBimbinganController;
use App\Http\Controllers\Guru\MonitoringAbsensiController;
use App\Http\Controllers\Guru\JurnalController;
use App\Http\Controllers\Guru\ProfilController;

use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\JurnalController as SiswaJurnalController;
use App\Http\Controllers\Siswa\ProfilController as SiswaProfilController;

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

// =========================
// LUPA PASSWORD
// =========================

Route::get('/lupa-password', [
    AuthController::class,
    'showForgotPassword'
])->name('password.request');

Route::post('/lupa-password', [
    AuthController::class,
    'sendResetLink'
])->middleware('throttle:5,1')
  ->name('password.email');

Route::get('/reset-password/{token}', [
    AuthController::class,
    'showResetPassword'
])->name('password.reset');

Route::post('/reset-password', [
    AuthController::class,
    'resetPassword'
])->name('password.update');

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

Route::prefix('siswa')
    ->name('siswa.')
    ->middleware(['auth', 'role:siswa'])
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/absensi', [SiswaAbsensiController::class, 'index'])
            ->name('absensi.index');
        Route::post('/absensi', [SiswaAbsensiController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('absensi.store');

        Route::get('/jurnal', [SiswaJurnalController::class, 'index'])
            ->name('jurnal.index');
        Route::get('/jurnal/tambah', [SiswaJurnalController::class, 'create'])
            ->name('jurnal.create');
        Route::post('/jurnal', [SiswaJurnalController::class, 'store'])
            ->name('jurnal.store');
        Route::get('/jurnal/{jurnal}/edit', [SiswaJurnalController::class, 'edit'])
            ->name('jurnal.edit');
        Route::put('/jurnal/{jurnal}', [SiswaJurnalController::class, 'update'])
            ->name('jurnal.update');
        Route::delete('/jurnal/{jurnal}', [SiswaJurnalController::class, 'destroy'])
            ->name('jurnal.destroy');

        Route::get('/profil', [SiswaProfilController::class, 'edit'])
            ->name('profil.edit');
        Route::put('/profil', [SiswaProfilController::class, 'update'])
            ->name('profil.update');
    });

// =========================
// DASHBOARD GURU
// =========================

Route::prefix('guru')
    ->name('guru.')
    ->middleware(['auth', 'role:guru'])
    ->group(function () {

        // Dashboard Guru
        Route::get('/dashboard', [
            GuruDashboardController::class,
            'index'
        ])->name('dashboard');

        // Siswa bimbingan
        Route::get('/siswa', [
            SiswaBimbinganController::class,
            'index'
        ])->name('siswa.index');

        // Monitoring absensi
        Route::get('/absensi', [
            MonitoringAbsensiController::class,
            'index'
        ])->name('absensi.index');

        // Monitoring jurnal
        Route::get('/jurnal', [
            JurnalController::class,
            'index'
        ])->name('jurnal.index');

        // Profil Guru
        Route::get('/profil', [
            ProfilController::class,
            'index'
        ])->name('profil');
    });

// =========================
// DASHBOARD ADMIN
// =========================

Route::get('/admin/dashboard', [
    DashboardController::class,
    'index'
])->middleware(['auth', 'role:admin'])
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
        Route::get('/{user}', 'show')->name('show');
        Route::patch('/{user}/approve', 'approve')->name('approve');
        Route::patch('/{user}/reject', 'reject')->name('reject');
    });

// =========================
// KELOLA SISWA ADMIN
// =========================

Route::prefix('admin/siswa')
    ->name('admin.siswa.')
    ->middleware(['auth', 'role:admin'])
    ->controller(SiswaController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{siswa}', 'show')->name('show');
        Route::get('/{siswa}/edit', 'edit')->name('edit');
        Route::put('/{siswa}', 'update')->name('update');
        Route::delete('/{siswa}', 'destroy')->name('destroy');
    });

// =========================
// KELOLA GURU ADMIN
// =========================

Route::prefix('admin/guru')
    ->name('admin.guru.')
    ->middleware(['auth', 'role:admin'])
    ->controller(GuruController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{guru}', 'show')->name('show');
        Route::get('/{guru}/edit', 'edit')->name('edit');
        Route::put('/{guru}', 'update')->name('update');
        Route::put(
            '/{guru}/penugasan-siswa',
            'assignStudents'
        )->name('assign-students');
        Route::delete('/{guru}', 'destroy')->name('destroy');
    });

// =========================
// KELOLA SEKOLAH DAN JURUSAN
// =========================

Route::prefix('admin/sekolah-jurusan')
    ->name('admin.sekolah-jurusan.')
    ->middleware(['auth', 'role:admin'])
    ->controller(SekolahJurusanController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::post('/sekolah', 'storeSekolah')
            ->name('sekolah.store');

        Route::put('/sekolah/{sekolah}', 'updateSekolah')
            ->name('sekolah.update');

        Route::delete('/sekolah/{sekolah}', 'destroySekolah')
            ->name('sekolah.destroy');

        Route::post('/jurusan', 'storeJurusan')
            ->name('jurusan.store');

        Route::put('/jurusan/{jurusan}', 'updateJurusan')
            ->name('jurusan.update');

        Route::delete('/jurusan/{jurusan}', 'destroyJurusan')
            ->name('jurusan.destroy');
    });

// =========================
// MONITORING ADMIN
// =========================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->controller(MonitoringController::class)
    ->group(function () {
        Route::get('/absensi', 'absensi')
            ->name('absensi.index');

        Route::get('/riwayat-absensi', 'riwayatAbsensi')
            ->name('absensi.riwayat');

        Route::get('/jurnal-harian', 'jurnal')
            ->name('jurnal.index');
    });

// =========================
// PENGATURAN ADMIN
// =========================

Route::prefix('admin')
    ->name('admin.settings.')
    ->middleware(['auth', 'role:admin'])
    ->controller(SettingsController::class)
    ->group(function () {
        Route::get('/pengaturan', 'edit')->name('edit');
        Route::put('/pengaturan', 'update')->name('update');
    });