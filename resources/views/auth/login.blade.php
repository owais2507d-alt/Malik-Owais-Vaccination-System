<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Medical Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-6xl min-h-[640px] rounded-3xl shadow-2xl border border-slate-100 overflow-hidden grid grid-cols-1 md:grid-cols-12">

        <!-- Left Banner / Sidebar -->
        <div class="hidden md:flex md:col-span-5 bg-gradient-to-br from-cyan-700 via-teal-800 to-slate-900 p-10 flex-col justify-between relative overflow-hidden">
            
            <!-- Background Patterns -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:25px_25px]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(45deg,#ffffff08_25%,transparent_25%,transparent_50%,#ffffff08_50%,#ffffff08_75%,transparent_75%)] [background-size:60px_60px]"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 text-3xl font-black tracking-tighter">
                    <span class="text-cyan-400">🏥</span>
                    <span class="text-white">CAREPORTAL</span>
                </div>
                <p class="text-cyan-200 text-sm mt-1">Secure Healthcare Platform</p>
            </div>

            <div class="relative z-10 my-auto space-y-6">
                <h1 class="text-4xl font-bold leading-tight text-white">
                    Welcome Back to<br>Your Health Hub
                </h1>
                <p class="text-cyan-100/90 text-lg leading-relaxed max-w-xs">
                    Access vaccination records, appointments, inventory, and secure medical reports instantly.
                </p>

                <div class="flex gap-6 text-sm">
                    <div class="flex items-center gap-2 text-cyan-200">
                        <i class="fas fa-shield-alt"></i>
                        <span class="text-xs uppercase tracking-widest">HIPAA Compliant</span>
                    </div>
                    <div class="flex items-center gap-2 text-cyan-200">
                        <i class="fas fa-clock"></i>
                        <span class="text-xs uppercase tracking-widest">24/7 Access</span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-xs text-cyan-300/60 flex items-center gap-2">
                <i class="fas fa-lock"></i>
                <span>AES-256 Encrypted • Secure Portal</span>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="md:col-span-7 p-8 sm:p-12 flex flex-col justify-center">
            <div class="max-w-md w-full mx-auto">
                
                <div class="text-center mb-8">
                    <div class="inline-flex p-3 rounded-full bg-cyan-100 text-cyan-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Welcome Back</h2>
                    <p class="text-slate-500 mt-1">Sign in to access your vaccination &amp; medical portal</p>
                </div>

                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-2xl mb-6 text-sm">
                        <span class="font-bold">Verification Alert:</span>
                        <ul class="mt-1 list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6" id="loginForm">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">EMAIL ADDRESS</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                   placeholder="name@domain.com" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">PASSWORD</label>
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
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 accent-cyan-600">
                            <span class="text-slate-600">Remember me</span>
                        </label>
                        <a href="#" class="text-cyan-600 hover:text-cyan-700 font-medium">Forgot Password?</a>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-semibold py-4 rounded-2xl shadow-lg shadow-cyan-500/30 active:scale-[0.985] transition-all duration-200 flex items-center justify-center gap-2 text-base">
                        <span>Sign In Securely</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="text-center mt-8">
                    <p class="text-slate-500 text-sm">
                        New Patient? 
                        <a href="{{ route('register') }}" class="font-semibold text-cyan-600 hover:text-cyan-700 transition-colors">Create Account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password Visibility Toggle
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }
    </script>
</body>
</html>