<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// PROTECTED ROUTES
Route::middleware('auth.jwt')->group(function () {

});
