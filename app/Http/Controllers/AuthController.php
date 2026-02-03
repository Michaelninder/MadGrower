<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle Standard Registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'rank' => 'player',
            'balance' => 0.00,
        ]);

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    /**
     * Handle Standard Email/Password Login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // --- OAUTH FUNCTIONS ---

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Failed to authenticate with ' . $provider]);
        }

        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                ]);
            } else {
                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'username' => $this->generateUniqueUsername($socialUser->getNickname() ?? $socialUser->getName()),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'rank' => 'player',
                    'balance' => 0.00,
                ]);
                
                $user->markEmailAsVerified();
            }
        } else {
            $user->update(['provider_token' => $socialUser->token]);
        }

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    protected function generateUniqueUsername(string $name): string
    {
        $username = Str::slug($name, '_');
        
        if (empty($username)) {
            $username = 'user_' . Str::random(5);
        }

        if (User::where('username', $username)->exists()) {
            $newUsername = $username . rand(1000, 9999);
            return $this->generateUniqueUsername($newUsername);
        }

        return $username;
    }
}