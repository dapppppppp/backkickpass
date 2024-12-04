<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaceRecognitionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/recognize', [FaceRecognitionController::class, 'recognize']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/ticket/buy', [TicketController::class, 'buyTicket']);
        Route::get('/ticket/my-tickets', [TicketController::class, 'myTickets']);
        Route::post('/profile/face-register', [ProfileController::class, 'registerFace']);
        Route::post('/ticket/buy', [TicketController::class, 'buyTicket']);
        Route::get('/ticket/my-tickets', [TicketController::class, 'myTickets']);
        
        
    });

});
