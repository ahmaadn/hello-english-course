<?php

namespace App\Http\Controllers;

use App\Models\Module;


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

    public function modules()
    {
        $modules = Module::with(['user', 'materis'])->get();
        return view("pages.module", compact('modules'));
    }

    public function chapter()
    {
        return view("pages.chapter.index");
    }
}
