<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



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

        $username = strtolower(str_replace(' ', '_', $request->name)) . rand(100, 999);

        // Generate OTP
        $otp = rand(100000, 999999);

        $user = User::create([
            'name'        => $request->name,
            'user_name'    => $username,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'user',
            'status'      => 'active',
            'is_verified' => false, // not verified yet
            'reg_status'  => 'pending',
            'otp'   => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);


        Mail::raw("Your OTP for email verification is: {$otp}. It will expire in 10 minutes.", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Verify Your Email - TS Developers');
        });

   session([
        'email' => $user->email,
         // optional, if you also want to compare from session
    ]);

        // Redirect to verify page
        return redirect()->route('verify.email')->with('success', 'Signup successful! Please verify your email.');
    }


    public function showVerifyForm()
    {
        return view('auth.verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required',
        ]);

        $otp = implode('', $request->otp);
        $user = User::where('email', $request->email)
            ->where('otp', $otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        $user->update([
            'is_verified' => true,
            'reg_status'  => 'active',
            'otp'   => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login')->with('success', 'Email verified! You can now login.');
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
