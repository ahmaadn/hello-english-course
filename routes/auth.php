<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\PertanyaanController as AdminPertanyaanController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController;
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
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('module', AdminModuleController::class);

        Route::resource('module.materi', AdminMateriController::class);

        Route::resource('quiz', AdminQuizController::class);

        Route::post('/{quiz}/soal', [AdminPertanyaanController::class, 'store'])->name('pertanyaan.store');

        Route::delete('/{quiz}/soal', [AdminPertanyaanController::class, 'destroy'])->name('pertanyaan.destroy');
    });
