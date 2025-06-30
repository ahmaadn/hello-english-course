<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('home')->with('success', 'Logout successful!');
    }

}
