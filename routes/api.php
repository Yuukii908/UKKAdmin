<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AlatController as ApiAlatController;
use App\Http\Controllers\Api\PeminjamanController as ApiPeminjamanController;
use Illuminate\Support\Facades\Request;

Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/logout', [AuthController::class, 'logout']);

    Route::get('/v1/me', function (Request $request) {
        return $request->user();
    });

    // Alat API
    Route::get('/v1/alats', [ApiAlatController::class, 'index']);
    Route::get('/v1/alats/{alat}', [ApiAlatController::class, 'show']);

    // Peminjaman API
    Route::get('/v1/peminjamans', [ApiPeminjamanController::class, 'index']);
    Route::post('/v1/peminjamans', [ApiPeminjamanController::class, 'store']);
});
