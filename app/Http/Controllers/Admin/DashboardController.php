<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materi;
use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalStudents = User::where('role', 'student')->count();
        $totalMateri = Materi::count();
        $totalUsers = User::count();
        $totalQuiz = Quiz::count();
        return view("admin.index", compact("user", "totalStudents", "totalMateri", "totalUsers", "totalQuiz"));
    }
}
