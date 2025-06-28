<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Module;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Module $module)
    {

        return view("pages.materi.intro", compact("module"));
    }
}
