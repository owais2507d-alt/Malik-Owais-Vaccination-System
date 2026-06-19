<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminLoginController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC LANDING & AUTH SYSTEM (Users / Patients / Hospitals)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Only Routes for Standard Users
Route::middleware('guest')->group(function () {
    // Patient Onboarding Form
    Route::get('/register', [RegisterController::class, 'ShowRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Universal Login Portal (For Patients & Approved Hospitals)
    Route::get('/login', [LoginController::class, 'showlogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Universal Secure Logout for Standard Users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| 2. ISOLATED ADMIN AUTHENTICATION (Using Separate Admin Guard & Table)
|--------------------------------------------------------------------------
*/
// Explicitly isolated from any global guest/auth middleware to block loops
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| 3. SECURE WORKSPACES (Protected Zones)
|--------------------------------------------------------------------------
*/

// --- ADMIN PANEL ZONE ---
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() { 
        return view('admin.dashboard'); 
    })->name('dashboard');
});

// --- PATIENT PANEL ZONE ---
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'patientDashboard'])->name('dashboard');
});

// --- HOSPITAL PANEL ZONE ---
Route::middleware(['auth', 'role:hospital'])->prefix('hospital')->name('hospital.')->group(function () {
    Route::get('/dashboard', function() { 
        return '<h1>Welcome to Hospital Management Portal</h1>'; 
    })->name('dashboard');
});

use App\Http\Controllers\Auth\ResetPasswordController;

// --- PASSWORD RESET SYSTEM ROUTES (GUEST) ---
Route::middleware('guest')->group(function () {
    // 1. Forgot Password Form View
    Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm'])->name('password.request');
    // 2. Submit Forgot Password Form (Sends Email)
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('password.email');
    // 3. Reset Password Link Form (From Email Click)
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    // 4. Update Password in Database
    Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
});