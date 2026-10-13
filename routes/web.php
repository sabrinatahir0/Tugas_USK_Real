<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PesertaController;

// Halaman utama (landing page) sebelum masuk ke login
Route::get('/', function () { 
    return view('welcome'); 
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::middleware('auth')->group(function () {
    // Dashboard: Bisa diarahkan langsung ke PesertaController@index 
    // agar user langsung melihat data diri mereka sendiri tanpa buat halaman dashboard baru
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    
    // RUTE SKEMA:
    // 1. SEMUA USER (Admin & User biasa) BISA MELIHAT daftar skema
    Route::get('/skema', [SkemaController::class, 'index'])->name('skema.index');

    // 2. YANG HANYA BISA DIAKSES ADMIN (Kelola/Ubah data skema & hapus peserta)
    Route::middleware('role:admin')->group(function () {
        Route::post('/skema', [SkemaController::class, 'store'])->name('skema.store');
        Route::get('/skema/{id}/edit', [SkemaController::class, 'edit'])->name('skema.edit');
        Route::put('/skema/{id}', [SkemaController::class, 'update'])->name('skema.update');
        Route::delete('/skema/{id}', [SkemaController::class, 'destroy'])->name('skema.destroy');

        Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
    });

    // Rute Peserta
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/peserta/tambah', [PesertaController::class, 'create'])->name('peserta.create');
    Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');
    Route::get('/peserta/{id}', [PesertaController::class, 'show'])->name('peserta.show');
    Route::get('/peserta/{id}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update');
});