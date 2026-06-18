<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// =========================================================================
// PUBLIC GUEST ROUTES (Only Accessible If NOT Logged In)
// =========================================================================
Route::middleware('guest')->group(function () {
    
    // Root landing redirects to login for application flow
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Patient Registration Processes
    Route::get('/register', [RegisterController::class, 'ShowRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Universal Login Portal Processes
    Route::get('/login', [LoginController::class, 'showlogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Universal Secure Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


// =========================================================================
// SECURE ZONE: ADMIN ROUTES 
// =========================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() { 
        return '<h1>Welcome to Admin Central Control Dashboard</h1>'; 
    })->name('dashboard');
});


// =========================================================================
// SECURE ZONE: HOSPITAL ROUTES
// =========================================================================
Route::middleware(['auth', 'role:hospital'])->prefix('hospital')->name('hospital.')->group(function () {
    Route::get('/dashboard', function() { 
        return '<h1>Welcome to Hospital Management Portal</h1>'; 
    })->name('dashboard');
});


// =========================================================================
// SECURE ZONE: PATIENT ROUTES
// =========================================================================
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    // Mapping dashboard to a dedicated Patient Controller
    Route::get('/dashboard', [LoginController::class, 'patientDashboard'])->name('dashboard');
});