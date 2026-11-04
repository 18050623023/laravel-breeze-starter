<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for Mobile, Desktop, and Third-Party Clients
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider / bootstrap app
| and assigned to the "api" middleware group.
*/

// Public Authentication Endpoints
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Health / Status Check Endpoint (Useful for network/connectivity checks)
Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Laravel API is reachable',
        'timestamp' => now()->toIso8601String(),
    ]);
});

// Protected Endpoints (Requires Header: Authorization: Bearer <token>)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
