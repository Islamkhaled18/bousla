<?php

use App\Http\Controllers\Mobile\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('mobile')
    ->as('mobile.')
    // ->middleware(['api'])
    ->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
    });
