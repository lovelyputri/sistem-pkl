<?php

use App\\Http\\Controllers\\AuthController;
use App\\Http\\Controllers\\Admin\\DashboardController;
use App\\Http\\Controllers\\Admin\\SiswaApprovalController;
use App\\Http\\Controllers\\Admin\\SiswaController;
use App\\Http\\Controllers\\Admin\\GuruController;
use App\\Http\\Controllers\\Admin\\MonitoringController;
use App\\Http\\Controllers\\Admin\\SettingsController;
use App\\Http\\Controllers\\Admin\\SekolahJurusanController;

use App\\Http\\Controllers\\Guru\\DashboardController as GuruDashboardController;
use App\\Http\\Controllers\\Guru\\SiswaBimbinganController;
use App\\Http\\Controllers\\Guru\\MonitoringAbsensiController;
use App\\Http\\Controllers\\Guru\\JurnalController;
use App\\Http\\Controllers\\Guru\\ProfilController;
use App\\Http\\Controllers\\Guru\\PengingatController;

use Illuminate\\Support\\Facades\\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerStep1'])->name('register.step1.process');
Route::get('/register/tahap-2', [AuthController::class, 'showRegisterStep2'])->name('register.step2');
Route::post('/register/tahap-2', [AuthController::class, 'registerStep2'])->name('register.step2.process');
Route::get('/register/tahap-3', [AuthController::class, 'showRegisterStep3'])->name('register.step3');
Route::post('/register/selesai', [AuthController::class, 'registerFinish'])->name('register.finish');
Route::get('/lupa-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/lupa-password', [AuthController::class, 'sendResetLink'])->middleware('throttle:5,1')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/siswa/dashboard', function () {
    return view('dashboard.siswa');
})->middleware(['auth', 'role:siswa'])->name('siswa.dashboard');

Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/siswa', [SiswaBimbinganController::class, 'index'])->name('siswa.index');
    Route::get('/absensi', [MonitoringAbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/jurnal', [JurnalController::class, 'index'])->name('jurnal.index');
    Route::post('/siswa/{siswa}/ingatkan', [PengingatController::class, 'store'])->name('pengingat.store');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::prefix('admin/siswa/approval')->name('admin.siswa.approval.')
    ->middleware(['auth', 'role:admin'])->controller(SiswaApprovalController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user}', 'show')->name('show');
        Route::patch('/{user}/approve', 'approve')->name('approve');
        Route::patch('/{user}/reject', 'reject')->name('reject');
    });

Route::prefix('admin/siswa')->name('admin.siswa.')
    ->middleware(['auth', 'role:admin'])->controller(SiswaController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/guru-by-sekolah', 'gurusBySekolah')->name('guru-by-sekolah');
        Route::post('/', 'store')->name('store');
        Route::get('/{siswa}', 'show')->name('show');
        Route::get('/{siswa}/edit', 'edit')->name('edit');
        Route::put('/{siswa}', 'update')->name('update');
        Route::delete('/{siswa}', 'destroy')->name('destroy');
    });

Route::prefix('admin/guru')->name('admin.guru.')->middleware(['auth', 'role:admin'])
    ->controller(GuruController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{guru}', 'show')->name('show');
        Route::get('/{guru}/edit', 'edit')->name('edit');
        Route::put('/{guru}', 'update')->name('update');
        Route::put('/{guru}/penugasan-siswa', 'assignStudents')->name('assign-students');
        Route::delete('/{guru}', 'destroy')->name('destroy');
    });

Route::prefix('admin/sekolah-jurusan')->name('admin.sekolah-jurusan.')
    ->middleware(['auth', 'role:admin'])->controller(SekolahJurusanController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/sekolah', 'storeSekolah')->name('sekolah.store');
        Route::put('/sekolah/{sekolah}', 'updateSekolah')->name('sekolah.update');
        Route::delete('/sekolah/{sekolah}', 'destroySekolah')->name('sekolah.destroy');
        Route::post('/jurusan', 'storeJurusan')->name('jurusan.store');
        Route::put('/jurusan/{jurusan}', 'updateJurusan')->name('jurusan.update');
        Route::delete('/jurusan/{jurusan}', 'destroyJurusan')->name('jurusan.destroy');
    });

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])
    ->controller(MonitoringController::class)->group(function () {
        Route::get('/absensi', 'absensi')->name('absensi.index');
        Route::get('/jurnal-harian', 'jurnal')->name('jurnal.index');
    });

Route::prefix('admin')->name('admin.settings.')->middleware(['auth', 'role:admin'])
    ->controller(SettingsController::class)->group(function () {
        Route::get('/pengaturan', 'edit')->name('edit');
        Route::put('/pengaturan', 'update')->name('update');
    });
