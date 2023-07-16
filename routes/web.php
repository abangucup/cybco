<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('storeLogin');
});

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['role:admin'], 'prefix' => 'admin'], function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('dashboard.admin');
        // CRUD GURU, SISWA, USER
        Route::resource('/guru', GuruController::class);
        Route::resource('/siswa', SiswaController::class);
        Route::resource('/user', UserController::class);
    });

    Route::group(['middleware' => ['role:guru'], 'prefix' => 'guru'], function () {
        Route::get('/', [DashboardController::class, 'guru'])->name('dashboard.guru');
    });

    Route::group(['middleware' => ['role:siswa'], 'prefix' => 'siswa'], function () {
        Route::get('/', [DashboardController::class, 'siswa'])->name('dashboard.siswa');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
