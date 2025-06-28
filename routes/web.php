<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => ""], function () {
    // Home
    Route::get("/", [HomeController::class, "index"])->name("home");

    // About
    Route::get("/about", [HomeController::class, "about"])->name("about");

    // Genres
    Route::get("/genres", [HomeController::class, "genres"])->name("genres");

    // Chapter
    Route::get("/chapter", [HomeController::class, "chapter"])->name("chapter");
});


Route::get('/chapter/1', function () {
    return view('pages.chapter.detail');
});

Route::get('/chapter/2', function () {
    return view('pages.chapter.detail');
});

Route::get('/chapter/3', function () {
    return view('pages.chapter.detail');
});

require __DIR__ . '/auth.php';
