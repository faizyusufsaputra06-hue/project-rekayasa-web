<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;

Route::post('/login', [LoginController::class, 'loginApi']);
Route::post('/register', [LoginController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::post('/logout', [LoginController::class, 'logoutApi']);
    Route::post('/projects', [ProjectController::class, 'store']);
});
