<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
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
    });

    Route::group(['middleware' => ['role:guru'], 'prefix' => 'guru'], function () {
        Route::get('/', [DashboardController::class, 'guru'])->name('dashboard.guru');

        // GURU MEMBUAT JADWAL UNTUK SISWA YANG BERMASALAH
        Route::resource('/jadwal', JadwalController::class);
        // GURU JUGA DAPAT MEMBUAT RIWAYAT ATAU HASIL DARI KONSELING YANG DILAKUKAN KEPADA SISWA LEWAT WHATSAPP
        Route::resource('/riwayat', RiwayatController::class);
    });

    Route::group(['prefix' => 'kelola'], function () {
        Route::resource('/siswa', SiswaController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/pertanyaan', PertanyaanController::class);
        Route::get('/kuisioner', [KuisionerController::class, 'index'])->name('kuisioner.index');
    });

    Route::group(['middleware' => ['role:siswa'], 'prefix' => 'siswa'], function () {
        Route::get('/', [DashboardController::class, 'siswa'])->name('dashboard.siswa');

        // SISWA HANYA DAPAT MENGISI KUISIONER, MELIHAT HASIL KUIS, DAN MERUBAH HASIL KUIS
        // ISI KUISIONER
        Route::get('/kuisioner/create', [KuisionerController::class, 'create'])->name('kuisioner.create');
        Route::post('/kuisioner', [KuisionerController::class, 'store'])->name('kuisioner.store');
        // LIHAT HASIL KUISIONER
        Route::get('/kuisioner/{siswa}', [KuisionerController::class, 'index'])->name('kuisioner.show');
        // UBAH KUISIONER
        Route::get('/kuisioner/{siswa}/edit', [KuisionerController::class, 'edit'])->name('kuisioner.edit');
        Route::put('/kuisioner/{siswa}', [KuisionerController::class, 'update'])->name('kuisioner.update');

        // SISWA HANYA DAPAT MELIHAT JADWAL DAN RIWAYATNYA YANG DIBUAT OLEH GURU
        Route::get('/jadwal', [JadwalController::class, 'jadwalSiswa'])->name('jadwal_siswa');

        // KONSULTASI LANGSUNG KEPADA GURU
        Route::get('/konsultasi', [DashboardController::class, 'konsultasi'])->name('konsultasi');
        Route::post('/konsultasi/whatsapp/{guru}', [DashboardController::class, 'kirimPesan'])->name('chat.whatsapp');

        // RIWAYAT KONSULTASI
        Route::get('/riwayat', [RiwayatController::class, 'riwayatSiswa'])->name('riwayat_siswa');
    });

    // PROFILE
    Route::post('/profile/ortu', [ProfileController::class, 'updateOrtu'])->name('profile.ortu');
    Route::resource('/profile', ProfileController::class);

    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan');

    // CETAK
    Route::get('/unduh/{id}', [LaporanController::class, 'unduhDataById'])->name('unduh.perid');
    Route::get('/unduh-semua', [LaporanController::class, 'unduhSemuaData'])->name('unduh.semua');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
