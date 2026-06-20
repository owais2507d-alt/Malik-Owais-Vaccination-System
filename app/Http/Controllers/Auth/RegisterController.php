<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterOtpMail;

class RegisterController extends Controller
{
    public function ShowRegisterForm()
    {
        return view('auth.register');
    }

  public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'phone' => 'required|string|max:20',
        'location' => 'required|string|max:255',
        'address' => 'required|string',
    ]);

    $otp = rand(100000, 999999);

    session([
        'registration_data' => $request->except(['password_confirmation']),
        'registration_password' => $request->password,
        'registration_otp' => $otp,
        'otp_expires_at' => now()->addMinutes(2), // 2 Minutes Expiry
    ]);

    // Back to your original working queue setup
    try {
        Mail::to($request->email)->queue(new RegisterOtpMail($otp, $request->name));
    } catch (\Exception $e) {
        \Log::error("Mail Queue Error: " . $e->getMessage());
    }

    // Direct routing framework core execution
    return redirect()->route('register.otp.view');
}
    /**
     * --- WAS MISSING: Renders the OTP submission screen view ---
     */
    public function showOtpForm()
    {
        if (!session()->has('registration_otp')) {
            return redirect()->to('/register')->withErrors(['email' => 'Session expired. Start registration again.']);
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        if (!session()->has('registration_otp') || !session()->has('otp_expires_at')) {
            return redirect()->to('/register')->withErrors(['email' => 'Verification context timeout. Retry registration.']);
        }

        // --- EXPIRES CHECK ---
        if (now()->greaterThan(session('otp_expires_at'))) {
            return back()->withErrors(['otp' => 'This OTP has expired. Please request a new code.']);
        }

        if ($request->otp != session('registration_otp')) {
            return back()->withErrors(['otp' => 'The provided security verification OTP code is incorrect.']);
        }

        $data = session('registration_data');
        $rawPassword = session('registration_password');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($rawPassword),
            'role' => 'patient', 
            'status' => 'approved', 
        ]);

        $user->patientProfile()->create([
            'phone' => $data['phone'],
            'location' => $data['location'],
            'address' => $data['address'],
        ]);

        session()->forget(['registration_data', 'registration_password', 'registration_otp', 'otp_expires_at']);

        Auth::guard('web')->login($user);

        return redirect()->route('patient.dashboard');
    }

    /**
     * --- RESEND OTP PROCESS ---
     */
    public function resendOtp()
    {
        if (!session()->has('registration_data')) {
            return redirect()->to('/register')->withErrors(['email' => 'Registration data not found. Please fill form again.']);
        }

        $data = session('registration_data');
        $otp = rand(100000, 999999);

        // Update OTP and Expiry in Session
        session([
            'registration_otp' => $otp,
            'otp_expires_at' => now()->addMinutes(2),
        ]);

        // Send Email Again
        Mail::to($data['email'])->send(new RegisterOtpMail($otp, $data['name']));

        return back()->with('status', 'A fresh security OTP code has been successfully dispatched to your inbox.');
    }
}