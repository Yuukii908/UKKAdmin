<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AlatController as ApiAlatController;
use App\Http\Controllers\Api\PeminjamanController as ApiPeminjamanController;
use Illuminate\Support\Facades\Request;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    // Alat API
    Route::get('/alats', [ApiAlatController::class, 'index']);
    Route::get('/alats/{alat}', [ApiAlatController::class, 'show']);

    // Peminjaman API
    Route::get('/peminjamans', [ApiPeminjamanController::class, 'index']);
    Route::post('/peminjamans', [ApiPeminjamanController::class, 'store']);
});
