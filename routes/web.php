<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    });

    Route::group(['middleware' => ['role:guru'], 'prefix' => 'guru'], function () {
        Route::get('/', [DashboardController::class, 'guru'])->name('dashboard.guru');
    });

    Route::group(['middleware' => ['role:siswa'], 'prefix' => 'siswa'], function () {
        Route::get('/', [DashboardController::class, 'siswa'])->name('dashboard.siswa');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
