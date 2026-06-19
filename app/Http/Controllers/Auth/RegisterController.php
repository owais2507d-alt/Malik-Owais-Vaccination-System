<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the patient registration form.
     */
    public function ShowRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request strictly for a new patient.
     */
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

        // 1. Create base record in standard users table as patient
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient',       // Enforced role restriction for normal system users
            'status' => 'approved',   // Patients are active by default
        ]);

        // 2. Automatically provision the linked patient profile container
        $user->patientProfile()->create([
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
        ]);

        // 3. Log the patient in automatically using default web guard
        Auth::guard('web')->login($user);

        // 4. Redirect strictly to their protected patient dashboard area
        return redirect()->route('patient.dashboard');
    }
}