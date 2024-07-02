<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Menampilkan form untuk membuat user baru
Route::get('users/create', [UserController::class, 'create'])->name('users.create');

// Menyimpan data user baru
Route::post('users', [UserController::class, 'store'])->name('users.store');

// Menampilkan daftar user
Route::get('users', [UserController::class, 'index'])->name('users.index');

// Menghapus data user
Route::delete('users/{id}',[UserController::class, 'destroy'])->name('users.destroy');

// Menampilkan data user yang sudah ada
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// Mengupdat data user
Route::patch('users/{id}', [UserController::class, 'update'])->name('update');


// Menampilkan daftar karyawan
Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');

// Menampilkan form untuk membuat karyawan baru
Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');

// Menyimpan data karyawan baru
Route::post('karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');

// Menampilkan data karyawan yang sudah ada
Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');

//menupdate data karyawan
Route::patch('karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');

// Menghapus data karyawan
Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');   

Route::get('/', function () {
    return view('beranda');
});
