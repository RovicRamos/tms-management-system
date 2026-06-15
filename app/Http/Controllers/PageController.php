<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function landing()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Manually check if the user exists in your custom database table
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password_hash)) {
            // Force manual login 
            Auth::login($user);
            
            $request->session()->regenerate();
            return redirect()->to('/seminars');
        }

        // If it falls through here, the password hash check failed
        return back()->withErrors([
            'email' => 'The credentials do not match our database records.',
        ])->onlyInput('email');
    }

    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'], 
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'role_id' => 2, 
            // REMOVED 'created_at' because $timestamps = false is active in your User model
        ]);

        Auth::login($user);

        return redirect()->to('/seminars');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}