<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans min-h-screen flex">

    <!-- 1. SIDEBAR CONTAINER -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex shrink-0 border-r border-slate-800">
        <div>
            <!-- Sidebar Header / Logo -->
            <div class="p-6 border-b border-slate-800 flex items-center gap-3">
                <span class="text-2xl">⚡</span>
                <span class="font-black text-white tracking-wider text-sm uppercase">Super Admin Portal</span>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-bold bg-cyan-600 text-white transition">
                    <span>📊</span> Dashboard Overview
                </a>
                
                <!-- Placeholders for our future 3 modules -->
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition">
                    <span>🏢</span> Hospital Clearances
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition">
                    <span>📦</span> Central Vaccine Stock
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition">
                    <span>👥</span> Global Patient Logs
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer / Secure Logout -->
        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-slate-800 hover:bg-rose-900 text-slate-300 hover:text-white font-bold py-2 px-4 rounded-lg text-xs transition flex items-center justify-center gap-2">
                    🛑 Secure System Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
        
        <!-- Top Navbar Header -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-base font-bold text-slate-800 uppercase tracking-wide">
                @yield('page_heading', 'Administration Control Grid')
            </h1>
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                    User: {{ auth()->user()->name }}
                </span>
            </div>
        </header>

        <!-- Main Injectable Body Content Component -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>