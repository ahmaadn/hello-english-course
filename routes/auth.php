<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::name('auth.')->group(function () {
    Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login.submit');

    // register
    Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('register.submit');
});
