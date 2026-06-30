<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'email_verification_token' => User::generateVerificationToken(),
        ]);

        $this->sendVerificationEmail($user);

        session(['verification_email' => $user->email]);

        return redirect()->route('verification.notice')->with('status', 'Registration successful! Please check your email to verify your account.');
    }

    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request, $id, $token)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('seminars');
        }

        if ($user->email_verification_token !== $token) {
            return redirect()->route('verification.notice')->withErrors([
                'email' => 'Invalid verification link.',
            ]);
        }

        $user->markEmailAsVerified();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('seminars')->with('success', 'Email verified successfully!');
    }

    public function resendVerification(Request $request)
    {
        $email = $request->input('email') ?? session('verification_email');

        if (! $email) {
            return redirect()->route('register')->withErrors([
                'email' => 'Please register first.',
            ]);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('register')->withErrors([
                'email' => 'No account found with this email.',
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('seminars');
        }

        $user->email_verification_token = User::generateVerificationToken();
        $user->save();

        $this->sendVerificationEmail($user);

        return back()->with('status', 'Verification email resent!');
    }

    protected function sendVerificationEmail(User $user): void
    {
        $url = route('verification.verify', [
            'id' => $user->user_id,
            'token' => $user->email_verification_token,
        ]);

        try {
            Mail::to($user->email)->send(new VerifyEmail($user, $url));
        } catch (\Throwable $e) {
            logger('Email failed: ' . $e->getMessage());
        }
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

        if ($requiredRoleId === null && (int) $user->role_id === 2 && ! $user->hasVerifiedEmail()) {
            return back()->withErrors([
                'email' => 'Please verify your email address before logging in.',
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