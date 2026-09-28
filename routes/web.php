<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.process');

    Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');


    Route::post('/register', [
        AuthController::class,
        'registerStep1'
    ])->name('register.step1');


    /*
    |--------------------------------------------------------------------------
    | REGISTER TAHAP 2
    |--------------------------------------------------------------------------
    */

    Route::get('/register/tahap-2', [
        AuthController::class,
        'showRegisterStep2'
    ])->name('register.step2');


    Route::post('/register/tahap-2', [
        AuthController::class,
        'registerStep2'
    ])->name('register.step2.process');


    /*
    |--------------------------------------------------------------------------
    | REGISTER TAHAP 3
    |--------------------------------------------------------------------------
    */

    Route::get('/register/tahap-3', [
        AuthController::class,
        'showRegisterStep3'
    ])->name('register.step3');


    Route::post('/register/selesai', [
        AuthController::class,
        'registerFinish'
    ])->name('register.finish');


    /*
    |--------------------------------------------------------------------------
    | LUPA PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get('/lupa-password', [
        AuthController::class,
        'showForgotPassword'
    ])->name('password.request');

});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [
    AuthController::class,
    'logout'
])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD SEMENTARA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/siswa/dashboard', function () {

        return view('dashboard.siswa');

    });


    Route::get('/guru/dashboard', function () {

        return view('dashboard.guru');

    });


    Route::get('/admin/dashboard', function () {

        return view('dashboard.admin');

    });

});
