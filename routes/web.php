<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => ""], function () {
    // Home
    Route::get("/", [HomeController::class, "index"])->name("home");

    // About
    Route::get("/about", [HomeController::class, "about"])->name("about");

    // Genres
    Route::get("/modules", [HomeController::class, "modules"])->name("modules");

    // Chapter
    Route::get("/chapter", [HomeController::class, "chapter"])->name("chapter");
});




require __DIR__ . '/auth.php';
