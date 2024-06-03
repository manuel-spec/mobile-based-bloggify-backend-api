<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;

Route::prefix('api')->group(function () {
    Route::post('register', [authController::class, 'register']);
    Route::post('login', [authController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::post('logout', [authController::class, 'logout']);

        Route::post('blogs/{id}/likes', [LikeController::class, 'toggleLike']);
    });
});
