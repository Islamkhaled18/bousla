<?php


use Illuminate\Support\Facades\Route;

Route::prefix('mobile')
    ->as('mobile.')
    ->middleware(['web'])
    ->group(function () {
        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
