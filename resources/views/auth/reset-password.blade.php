<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CarePortal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-6xl min-h-[660px] rounded-3xl shadow-2xl border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <!-- Left Banner -->
        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-cyan-700 via-teal-700 to-blue-800 p-10 flex-col justify-between relative overflow-hidden">
            
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:28px_28px]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(45deg,#ffffff08_25%,transparent_25%,transparent_50%,#ffffff08_50%,#ffffff08_75%,transparent_75%)] [background-size:70px_70px]"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 text-3xl font-black tracking-tighter text-white">
                    <span class="text-cyan-300">🔑</span>
                    <span>CAREPORTAL</span>
                </div>
                <p class="text-cyan-100 text-sm mt-1">Vaccination Management System</p>
            </div>

            <div class="relative z-10 my-auto space-y-6">
                <h1 class="text-4xl font-bold leading-tight text-white">
                    Create New Password
                </h1>
                <p class="text-cyan-100/90 text-lg leading-relaxed max-w-xs">
                    Your password must be strong and secure. After updating, you will be redirected to the login page.
                </p>

                <div class="flex items-center gap-4 text-cyan-100 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-shield-alt"></i>
                        <span class="text-xs uppercase tracking-widest">Secure</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-key"></i>
                        <span class="text-xs uppercase tracking-widest">Strong Password</span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-xs text-cyan-200/70 flex items-center gap-2">
                <i class="fas fa-clock"></i>
                <span>Session will expire after password reset</span>
            </div>
        </div>

        <!-- Right Side - Reset Password Form -->
        <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-md w-full mx-auto">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl mb-5">
                        <i class="fas fa-key text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Set New Password</h2>
                    <p class="text-slate-500 mt-2">Please create a strong password for your account</p>
                </div>

                @if ($errors->any())
                    <div class="p-4 mb-6 text-sm bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-6" id="resetForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">EMAIL ADDRESS</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                   placeholder="you@example.com" required>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">NEW PASSWORD</label>
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

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">CONFIRM NEW PASSWORD</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full pl-11 pr-12 py-3.5 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-semibold py-4 rounded-2xl shadow-lg shadow-cyan-500/30 active:scale-[0.985] transition-all duration-200 flex items-center justify-center gap-3 text-base">
                        <span>Update Password Securely</span>
                        <i class="fas fa-check-circle"></i>
                    </button>
                </form>

                <div class="text-center mt-8">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center gap-2 text-slate-600 hover:text-cyan-600 transition-colors font-medium">
                        <i class="fas fa-arrow-left"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password Toggle for New Password
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

        // Simple client-side password match check
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            
            if (pass !== confirm) {
                e.preventDefault();
                alert("Passwords do not match. Please try again.");
            }
        });
    </script>
</body>
</html>