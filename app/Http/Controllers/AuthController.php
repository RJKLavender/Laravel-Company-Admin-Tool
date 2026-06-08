<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Process the login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials))) {
            $request->session()->regenerate(); // Prevents session fixation attacks

            return redirect()->route('home');
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'Your email and password don't match our records'
        ])->onlyInput('email');
    }

    // Process the logout request
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}