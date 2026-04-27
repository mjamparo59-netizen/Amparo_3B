<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Added for User creation
use Illuminate\Support\Facades\Hash; // Added for password encryption

class AuthController extends Controller
{
    // --- LOGIN LOGIC ---
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // --- REGISTRATION LOGIC (New) ---

    // Show the registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' matches with password_confirmation
        ]);

        // 2. Create the user in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt the password!
        ]);

        // 3. Log the user in immediately
        Auth::login($user);

        // 4. Redirect to the dashboard page
        return redirect()->route('dashboard');
    }

    // --- LOGOUT LOGIC ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}