<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    // Menampilkan dashboard
    Route::get('admin', [DashboardController::class, 'index'])->name('beranda');

    // users
    // Menampilkan form untuk membuat komptensi baru
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    // Menyimpan data komptensi baru
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    // Menampilkan daftar komptensi
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Menampilkan form untuk mengedit komptensi yang sudah ada
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Mengupdate data komptensi
    Route::patch('users/{id}', [UserController::class, 'update'])->name('users.update');
    // Menghapus data komptensi
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // karyawan
    // Menampilkan form untuk membuat karyawan baru
    Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    // Menyimpan data karyawan baru
    Route::post('karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    // Menampilkan daftar karyawan
    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    // Menampilkan data karyawan yang sudah ada
    Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    //menupdate data karyawan
    Route::patch('karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    // Menghapus data karyawan
    Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

    // kompetensi
    // Menampilkan form untuk membuat komptensi baru
    Route::get('kompetensi/create', [KompetensiController::class, 'create'])->name('kompetensi.create');
    // Menyimpan data komptensi baru
    Route::post('kompetensi', [KompetensiController::class, 'store'])->name('kompetensi.store');
    // Menampilkan daftar komptensi
    Route::get('kompetensi', [KompetensiController::class, 'index'])->name('kompetensi.index');
    // Menampilkan form untuk mengedit komptensi yang sudah ada
    Route::get('kompetensi/{id}/edit', [KompetensiController::class, 'edit'])->name('kompetensi.edit');
    // Mengupdate data komptensi
    Route::patch('kompetensi/{id}', [KompetensiController::class, 'update'])->name('kompetensi.update');
    // Menghapus data komptensi
    Route::delete('kompetensi/{id}', [KompetensiController::class, 'destroy'])->name('kompetensi.destroy');

    // periode
    // Menampilkan form untuk membuat periode baru
    Route::get('periode/create', [PeriodeController::class, 'create'])->name('periode.create');
    // Menyimpan data periode baru
    Route::post('periode', [PeriodeController::class, 'store'])->name('periode.store');
    // Menampilkan daftar periode
    Route::get('periode', [PeriodeController::class, 'index'])->name('periode.index');
    // Menampilkan form untuk mengedit periode yang sudah ada
    Route::get('periode/{id}/edit', [PeriodeController::class, 'edit'])->name('periode.edit');
    // Mengupdate data periode
    Route::patch('periode/{id}', [PeriodeController::class, 'update'])->name('periode.update');
    // Menghapus data periode
    Route::delete('periode/{id}', [PeriodeController::class, 'destroy'])->name('periode.destroy');
});

// penilai
Route::middleware(['auth:user'])->group(function () {

    // Penilai
    // Menampilkan dashboard
    Route::get('penilai', [PenilaiController::class, 'index'])->name('dashboard_penilai.index');
    Route::get('penilai/nilai', [PenilaiController::class, 'indexNilai'])->name('dashboard_penilai.penilai');
    Route::post('/penilai/nilai/filter', [PenilaiController::class, 'indexNilai'])->name('dashboard_penilai.filter');

    // Menampilkan form untuk membuat nilai baru
    Route::get('/penilai/nilai/create/{id}', [PenilaiController::class, 'create'])->name('dashboard_penilai.create');
    Route::post('/penilai/nilai/store/{id}', [PenilaiController::class, 'store'])->name('dashboard_penilai.store');

    // Menampilkan form untuk mengedit nilai
    Route::get('/penilai/nilai/edit/{id}', [PenilaiController::class, 'edit'])->name('dashboard_penilai.edit');
    Route::patch('/penilai/nilai/update/{id}', [PenilaiController::class, 'update'])->name('dashboard_penilai.update');
    Route::delete('/penilai/nilai/delete/{id}', [PenilaiController::class, 'destroy'])->name('dashboard_penilai.destroy');


    // Periksa
    Route::get('penilai/periksa', [PenilaiController::class, 'indexPeriksa'])->name('dashboard_penilai.periksa');
});
