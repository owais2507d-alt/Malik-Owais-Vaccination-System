<?php

use Illuminate\Support\Facades\Route;

// 1. Public Guest Route (Root Landing)
Route::get('/', function () {
    return view('welcome');
});

// 2. Authentication Mock Routes (Temporary placeholders for Day 2 login testing)
Route::get('/login', function() { 
    return 'Authentication Login UI Screen - Day 2 Feature'; 
})->name('login');


// =========================================================================
// SECURE ZONE: ADMIN ROUTES (Strictly Protected by Role Middleware)
// =========================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function() { 
        return '<h1>Welcome to Admin Central Control Dashboard</h1>'; 
    })->name('dashboard');

});


// =========================================================================
// SECURE ZONE: HOSPITAL ROUTES (Strictly Protected by Role Middleware)
// =========================================================================
Route::middleware(['auth', 'role:hospital'])->prefix('hospital')->name('hospital.')->group(function () {
    
    Route::get('/dashboard', function() { 
        return '<h1>Welcome to Hospital Management Portal</h1>'; 
    })->name('dashboard');

});


// =========================================================================
// SECURE ZONE: PATIENT ROUTES (Strictly Protected by Role Middleware)
// =========================================================================
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    
    Route::get('/dashboard', function() { 
        return '<h1>Welcome to Patient Self-Service Dashboard</h1>'; 
    })->name('dashboard');

});