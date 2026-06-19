@extends('layouts.admin')

@section('title', 'Control Desk')
@section('page_heading', 'System Analytics Overview')

@section('content')
<div class="space-y-6">
    
    <!-- Admin Hero Announcement -->
    <div class="bg-gradient-to from-slate-800 to-slate-950 p-6 rounded-xl text-white shadow-sm border border-slate-800 relative overflow-hidden">
        <h2 class="text-xl font-bold mb-1">System Core Initialization Active</h2>
        <p class="text-xs text-slate-400 max-w-xl">You have full administrative override capabilities. Monitor node clearances, vaccine lot numbers, and systemic infrastructure distribution parameters from this point.</p>
    </div>

    <!-- Empty Stats Grid for Modules (Preview State) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 shadow-xs">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Pending Hospital Requests</p>
            <h3 class="text-2xl font-black text-slate-800 mt-1">0 Nodes</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 shadow-xs">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">National Stock Available</p>
            <h3 class="text-2xl font-black text-slate-800 mt-1">0 Doses Allotted</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 shadow-xs">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Global System Patients</p>
            <h3 class="text-2xl font-black text-slate-800 mt-1">0 Profiles Active</h3>
        </div>
    </div>

</div>
@endsection