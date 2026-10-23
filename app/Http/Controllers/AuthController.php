<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Registration successful! Welcome to QR SCANNER.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'login_type' => ['required', 'in:admin,user'],
        ]);

        $user = User::where('email', trim($request->email))->first();

        // Check if user exists
        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Validate login type
        if ($request->login_type === 'admin' && !$user->is_admin) {
            return back()->withErrors([
                'email' => 'This account is not an admin account. Please use User Login.',
            ])->onlyInput('email');
        }

        if ($request->login_type === 'user' && $user->is_admin) {
            return back()->withErrors([
                'email' => 'This is an admin account. Please use Admin Login.',
            ])->onlyInput('email');
        }

        // Attempt authentication (trim to remove extra spaces)
        $credentials = [
            'email' => trim($request->email),
            'password' => trim($request->password),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}
