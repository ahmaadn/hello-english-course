<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("pages.home");
    }

    public function about()
    {
        return view("pages.about");
    }

    public function genres()
    {
        $genres = Genre::all();
        return view("pages.genres", compact('genres'));
    }

    public function chapter()
    {
        return view("pages.chapter.index");
    }
}
