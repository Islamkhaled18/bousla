<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('post.login');
});

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth:admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //auth
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        // admins
        Route::resource('admins', AdminController::class);

        // roles
        Route::resource('roles', RoleController::class);

        //main category
        Route::resource('mainCategories', MainCategoryController::class);

    });
