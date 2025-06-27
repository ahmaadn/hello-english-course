<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;


Route::name('auth.')->group(function () {
    // login
    Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login.submit');

    // register
    Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('register.submit');
});


// Admin Panel
Route::middleware(['auth', UserAccess::class . ':admin'])
    ->prefix('admin')
    ->name('admin')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
