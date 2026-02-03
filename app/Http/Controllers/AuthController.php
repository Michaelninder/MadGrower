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
     * Handle Standard Email/Password Login
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
     * Handle Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @param string $provider (e.g., 'github', 'google')
     */
    public function redirectToProvider($provider)
    {
        // Ensure the provider is valid/configured in services.php
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the Provider.
     *
     * @param string $provider
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Failed to authenticate with ' . $provider]);
        }

        // 1. Check if user exists by Provider ID
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        // 2. If not found, check if user exists by Email (to link accounts)
        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Link the existing user to this provider
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                ]);
            } else {
                // 3. Create a new user
                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'username' => $this->generateUniqueUsername($socialUser->getNickname() ?? $socialUser->getName()),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    // Password is nullable, but we can set a random one if strict mode is on
                    // 'password' => Hash::make(Str::random(16)), 
                    'rank' => 'player',
                    'balance' => 0.00,
                ]);
                
                // Mark email as verified since it came from a trusted provider
                $user->markEmailAsVerified();
            }
        } else {
            // Update the token on every login
            $user->update(['provider_token' => $socialUser->token]);
        }

        // Log the user in
        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    /**
     * Generate a unique username based on a name/nickname.
     */
    protected function generateUniqueUsername(string $name): string
    {
        $username = Str::slug($name, '_');
        
        // If empty (rare), generate random
        if (empty($username)) {
            $username = 'user_' . Str::random(5);
        }

        // Check if it exists
        if (User::where('username', $username)->exists()) {
            $newUsername = $username . rand(1000, 9999);
            // Recursively check until unique
            return $this->generateUniqueUsername($newUsername);
        }

        return $username;
    }
}