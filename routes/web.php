<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);

// ===================== ADMIN ROUTES =====================
Route::middleware('role:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin']);
    
    // Alat management
    Route::resource('/alat', AlatController::class)->names('admin.alat');
    
    // Peminjaman management
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
    Route::patch('/peminjaman/{peminjaman}/setuju', [PeminjamanController::class, 'setuju'])->name('admin.peminjaman.setuju');
    Route::patch('/peminjaman/{peminjaman}/tolak', [PeminjamanController::class, 'tolak'])->name('admin.peminjaman.tolak');
    Route::patch('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('admin.peminjaman.kembalikan');
});

// ===================== PETUGAS ROUTES =====================
Route::middleware('role:petugas')->prefix('petugas')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'petugas']);
    
    // Peminjaman management (sama seperti admin tapi tanpa delete)
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::patch('/peminjaman/{peminjaman}/setuju', [PeminjamanController::class, 'setuju']);
    Route::patch('/peminjaman/{peminjaman}/tolak', [PeminjamanController::class, 'tolak']);
    Route::patch('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan']);
});

// ===================== PEMINJAM ROUTES =====================
Route::middleware('role:peminjam')->prefix('peminjam')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'peminjam']);
    
    // Peminjaman - buat baru
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    
    // Lihat peminjaman sendiri
    Route::get('/peminjaman', [PeminjamanController::class, 'myPeminjaman']);
});

