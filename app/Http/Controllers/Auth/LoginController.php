<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin(){
        return view('auth.login');
    }

    public  function login(Request $request){
        $credentials =$request->validate([
           'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials ,$request->filled('remember'))){
            $user = Auth::user();
            // Strict Gatekeeping: Prevent pending hospital accounts from logging in
            if ($user->role === 'hospital' && $user->status === 'pending') {
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'Your hospital account authorization is currently pending Admin Approval.'
                ]);
            }
            // Smart Redirection Matrix based on explicit user clearance roles
            return match ($user->role) {
                'admin' => redirect()->intended(route('admin.dashboard')),
                'hospital' => redirect()->intended(route('hospital.dashboard')),
                'patient' => redirect()->intended(route('patient.dashboard')),
                default => redirect('/'),
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
     * Terminate user session and flush security tokens.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    }

