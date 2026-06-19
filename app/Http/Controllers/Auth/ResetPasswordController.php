<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /**
     * 1. Forgot Password Form View Render
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * 2. Process Forgot Password - Send Reset Link via Email
     */
    public function sendResetLink(Request $request)
    {
        // Strict Validation checking if user exists inside users table
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'This email address is not registered in our system.'
        ]);

        // Broker interactions to trigger Laravel standard token setup and dispatch via Gmail
        $status = Password::broker('users')->sendResetLink($request->only('email'));

        // If successfully dispatched, bounce back with a success banner
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * 3. New Password Setup View Render (Intercepts Token from Email)
     */
    public function showResetForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * 4. Process Reset Password - Update Credentials in Database
     */
    public function updatePassword(Request $request)
    {
        // Core structural validation rules
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed', // Min 8 matching registration standard
        ]);

        // Hand over data to Laravel Password Broker for encrypted token decoding
        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Encrypt the new passkey & regenerate session tokens safely
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        // If sequence completes successfully, redirect to standard login with security success toast
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}