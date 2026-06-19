<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the standard universal user login form.
     */
    public function showlogin()
    {
        return view('auth.login');
    }

    /**
     * Handle authentication attempts strictly for Patients and Hospitals (Web Guard).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempting login explicitly via default 'web' guard (users table)
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('web')->user();

            // Strict Gatekeeping: Prevent pending hospital accounts from logging in
            if ($user->role === 'hospital' && $user->status === 'pending') {
                Auth::guard('web')->logout();
                return redirect()->back()->withErrors([
                    'email' => 'Your hospital account authorization is currently pending Admin Approval.'
                ]);
            }

            // Smart Redirection Matrix (Admin removed as it uses a separate guard/table now)
            return match ($user->role) {
                'hospital' => redirect()->intended(route('hospital.dashboard')),
                'patient'  => redirect()->intended(route('patient.dashboard')),
                default    => redirect('/'),
            };
        }

        // Return error if authentication verification parameters fail
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our database records.',
        ]);
    }

    /**
     * Render the protected patient self-service dashboard with profile metadata.
     */
    public function patientDashboard()
    {
        // Fetch logged-in user with their profile relation container
        $user = auth()->user()->load('patientProfile');

        return view('patient.dashboard', compact('user'));
    }

    /**
     * Terminate standard user session and flush security tokens.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}