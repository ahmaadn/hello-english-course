<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->group(function () {
    Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
});
