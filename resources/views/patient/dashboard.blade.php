@extends('layouts.patient')

@section('title', 'Patient Home')
@section('page_heading', 'Patient Central Dashboard')

@section('content')
<div class="space-y-6">
    
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl p-6 text-white shadow-sm">
        <h2 class="text-2xl font-bold mb-2">Welcome Back, {{ Auth::user()->name }}!</h2>
        <p class="text-blue-100 max-w-xl">Manage your COVID-19 vaccination bookings, view system laboratory reports, and monitor vaccine inventory in real-time.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Account Clearance</p>
                <h3 class="text-2xl font-bold text-green-600 mt-1">Active / Approved</h3>
            </div>
            <span class="text-3xl">✅</span>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Appointments</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">0 Booked</h3>
            </div>
            <span class="text-3xl">📅</span>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Medical Status</p>
                <h3 class="text-2xl font-bold text-amber-600 mt-1">No Reports Issued</h3>
            </div>
            <span class="text-3xl">📋</span>
        </div>

    </div>

</div>
@endsection