<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/genres', function () {
    return view('pages.genres');
});

Route::get('/chapter', function () {
    return view('pages.chapter.index');
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
