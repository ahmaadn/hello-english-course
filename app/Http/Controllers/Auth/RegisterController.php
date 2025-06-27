<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $isFirstUser = User::count() === 0;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];

        if (!$isFirstUser) {
            $rules['role'] = 'required|in:teacher,student';
        }

        $validated = $request->validate($rules);

        $role = $isFirstUser ? 'admin' : $validated['role'];

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
        ]);

        // Login user setelah register (opsional)
        auth()->login($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

}
