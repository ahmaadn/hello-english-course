<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => ""], function () {
    // Home
    Route::get("/", [HomeController::class, "index"])->name("home");

    // About
    Route::get("/about", [HomeController::class, "about"])->name("about");

    // Genres
    Route::get("/module", [HomeController::class, "modules"])->name("modules");

    // Chapter
    Route::get("/chapter", [HomeController::class, "chapter"])->name("chapter");
});

Route::middleware(['auth'])
    ->prefix('module')
    ->name('materi.')
    ->group(function () {
        Route::get('/{module}/intro', [MateriController::class, 'index'])->name('intro');
        Route::get('/{module}/start', [MateriController::class, 'start'])->name('start');
        Route::get('/{module}/next', [MateriController::class, 'next'])->name('next');

        Route::get('/{module}/{materi}', [MateriController::class, 'showMateri'])->name('show');

        Route::post('/{module}/{materi}/quiz/{quiz}', [QuizController::class, 'submit'])
            ->name('quiz.submit');
    });



require __DIR__ . '/auth.php';
