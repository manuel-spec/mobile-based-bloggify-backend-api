<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;

Route::prefix('api')->group(function () {
    Route::post('register', [authController::class, 'register']);
    Route::post('login', [authController::class, 'login']);
});