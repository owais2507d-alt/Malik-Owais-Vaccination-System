<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Dashboard') - COVID Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between p-4 hidden md:flex">
            <div>
                <div class="text-xl font-bold tracking-wider mb-8 text-blue-400 border-b border-slate-700 pb-4">
                    🏥 CarePortal
                </div>
                
                <nav class="space-y-2">
                    <a href="{{ route('patient.dashboard') }}" class="block px-4 py-2.5 rounded-lg bg-blue-600 font-medium text-white hover:bg-blue-700 transition">
                        📊 Dashboard
                    </a>
                    <a href="#" class="block px-4 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        👤 My Profile
                    </a>
                    <a href="#" class="block px-4 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        📅 Book Appointment
                    </a>
                    <a href="#" class="block px-4 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        📋 Medical Reports
                    </a>
                </nav>
            </div>

            <div class="border-t border-slate-700 pt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-red-400 hover:bg-red-950/40 hover:text-red-300 transition font-medium">
                        🚪 Secure Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shrink-0">
                <h1 class="text-xl font-semibold text-gray-800">@yield('page_heading', 'Dashboard')</h1>
                <div class="flex items-center space-x-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }} (Patient)</span>
                </div>
            </header>

            <div class="p-6">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>