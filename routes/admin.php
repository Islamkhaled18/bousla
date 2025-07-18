<?php

use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TermConditionController;
use App\Http\Controllers\Admin\JobController;
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
        Route::post('mainCategories/{id}/toggle-status', [MainCategoryController::class, 'toggleStatus'])->name('mainCategories.toggleStatus');

        // categories
        Route::resource('categories', CategoryController::class);
        Route::post('categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

        //brands
        Route::resource('brands', BrandController::class);
        Route::post('brands/{id}/toggle-status', [BrandController::class, 'toggleStatus'])->name('brands.toggleStatus');

        //ads
        Route::resource('ads', AdController::class);
        Route::post('ads/{id}/toggle-status', [AdController::class, 'toggleStatus'])->name('ads.toggleStatus');

        //settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::post('update/{id}', [SettingController::class, 'update'])->name('settings.update');
        });

        //terms-conditions
        Route::resource('terms', TermConditionController::class);

        //about_us
        Route::resource('about_us', AboutusController::class);

        //contact_us
        Route::resource('contact_us', ContactUsController::class)->only('index', 'destroy');

        //governorates
        Route::resource('governorates', GovernorateController::class);
        Route::post('governorates/{id}/toggle-status', [GovernorateController::class, 'toggleStatus'])->name('governorates.toggleStatus');

        //cities
        Route::resource('cities', CityController::class);
        Route::post('cities/{id}/toggle-status', [CityController::class, 'toggleStatus'])->name('cities.toggleStatus');

        //areas
        Route::resource('areas', AreaController::class);
        Route::post('areas/{id}/toggle-status', [AreaController::class, 'toggleStatus'])->name('areas.toggleStatus');

        //jobs
        Route::resource('jobs', JobController::class);
        Route::post('jobs/{id}/toggle-status', [JobController::class, 'toggleStatus'])->name('jobs.toggleStatus');
    });
