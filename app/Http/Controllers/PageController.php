<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return $this->attemptLogin($request);
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

        return redirect()->route('seminars');
    }

    protected function attemptLogin(Request $request, ?int $requiredRoleId = null)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password_hash)) {
            return back()->withErrors([
                'email' => 'The credentials do not match our database records.',
            ])->onlyInput('email');
        }

        if ($requiredRoleId !== null && (int) $user->role_id !== $requiredRoleId) {
            return back()->withErrors([
                'email' => 'Please use an administrator account to sign in here.',
            ])->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ((int) $user->role_id === 1) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('seminars');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}