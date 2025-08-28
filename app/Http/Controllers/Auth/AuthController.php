<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    //


    // Show Signup Page
    public function showSignup()
    {
        return view('auth.signup');
    }

    // Signup Logic
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Signup successful! Please login.');
    }

    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login Logic
    public function login(Request $request)
    {
        // Step 1: Validate email & password
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Step 2: Try logging in with given credentials
        if (Auth::attempt($credentials)) {
            // Regenerate session for security
            $request->session()->regenerate();

            // Step 3: Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect()->intended('/');
        }

        // Step 4: If login fails, return with error
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Home page after logout
    }
}
