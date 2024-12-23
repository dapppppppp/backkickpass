<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FaceRecognitionController;
use App\Http\Controllers\UserController;

// Rute untuk autentikasi
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rute yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Rute untuk manajemen tiket
    Route::apiResource('tickets', TicketController::class);

    // Rute untuk manajemen transaksi
    Route::apiResource('transactions', TransactionController::class);

    // Rute untuk manajemen deteksi wajah
    Route::apiResource('face-recognitions', FaceRecognitionController::class);

    // Rute untuk manajemen pengguna
    Route::apiResource('users', UserController::class);
});