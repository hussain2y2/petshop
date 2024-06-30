<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        // AUTH ROUTES
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // PROTECTED ROUTES
        Route::middleware('auth.jwt')->group(function () {
            Route::get('/', [UserController::class, 'me']);
            Route::put('/edit', [UserController::class, 'update']);
            Route::delete('/', [UserController::class, 'destroy']);
            Route::get('/orders', [OrderController::class, 'index']);
        });
    });
});
