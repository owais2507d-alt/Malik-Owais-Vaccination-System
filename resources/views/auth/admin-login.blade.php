<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Admin Desk - Authorization Required</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-6xl min-h-[660px] rounded-3xl shadow-2xl border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <!-- Left Banner - Light Medical Theme -->
        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-cyan-700 via-teal-700 to-blue-800 p-10 flex-col justify-between relative overflow-hidden">
            
            <!-- Background Patterns -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:28px_28px]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(45deg,#ffffff08_25%,transparent_25%,transparent_50%,#ffffff08_50%,#ffffff08_75%,transparent_75%)] [background-size:70px_70px]"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 text-3xl font-black tracking-tighter text-white">
                    <span class="text-cyan-300">🛡️</span>
                    <span>ADMIN<span class="text-cyan-300">.</span>CAREPORTAL</span>
                </div>
                <p class="text-cyan-100 text-sm mt-1">Vaccination Management System</p>
            </div>

            <div class="relative z-10 my-auto space-y-6">
                <h1 class="text-4xl font-bold leading-tight text-white">
                    Admin Control Center
                </h1>
                <p class="text-cyan-100/90 text-lg leading-relaxed max-w-xs">
                    Secure access to manage vaccination records, inventory, appointments, and system reports.
                </p>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center gap-3 text-cyan-100">
                        <i class="fas fa-shield-alt text-xl"></i>
                        <div>
                            <div class="text-xs uppercase tracking-widest">Security</div>
                            <div class="font-semibold">HIPAA + AES-256</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-cyan-100">
                        <i class="fas fa-syringe text-xl"></i>
                        <div>
                            <div class="text-xs uppercase tracking-widest">System</div>
                            <div class="font-semibold">Vaccination Portal</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-xs text-cyan-200/70 flex items-center gap-2">
                <i class="fas fa-lock"></i>
                <span>Authorized Personnel Only • Activity Logged</span>
            </div>
        </div>

        <!-- Right Side - Light Form -->
        <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-md w-full mx-auto">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-cyan-100 text-cyan-600 rounded-2xl mb-5">
                        <span class="text-4xl">🛡️</span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Admin Login</h2>
                    <p class="text-slate-500 mt-2">Enter your credentials to access the vaccination control panel</p>
                </div>

                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-2xl mb-6 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-6" id="adminLoginForm">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">ADMIN EMAIL</label>
                        <div class="relative">
                            <i class="fas fa-user-shield absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                   placeholder="admin@careportal.com" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">PASSWORD</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="password" name="password" id="password"
                                   class="w-full pl-11 pr-12 py-3.5 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                   placeholder="••••••••" required>
                            <button type="button" id="togglePassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 accent-cyan-600">
                            <span>Remember this device</span>
                        </label>
                        <a href="#" class="text-cyan-600 hover:text-cyan-700">Forgot Password?</a>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-semibold py-4 rounded-2xl shadow-lg shadow-cyan-500/30 active:scale-[0.985] transition-all duration-200 flex items-center justify-center gap-3 text-base">
                        <span>Authorize Access</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="text-center mt-8 text-xs text-slate-500">
                    Restricted to authorized vaccination administrators only
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password Toggle
        const toggleBtn = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }
    </script>
</body>
</html>