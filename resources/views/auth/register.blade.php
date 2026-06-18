<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration - ClinicLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-6xl min-h-[680px] rounded-3xl shadow-2xl border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <!-- Left Sidebar - Enhanced -->
        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-cyan-700 via-teal-800 to-slate-900 p-10 flex-col justify-between relative overflow-hidden">
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:25px_25px]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(45deg,#ffffff08_25%,transparent_25%,transparent_50%,#ffffff08_50%,#ffffff08_75%,transparent_75%)] [background-size:60px_60px]"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 text-3xl font-black tracking-tighter">
                    <span class="text-cyan-400">🩺</span>
                    <span class="text-white">CAREPORTAL</span>
                </div>
                <p class="text-cyan-200 text-sm mt-1">Healthcare Simplified</p>
            </div>

            <div class="relative z-10 my-auto">
                <h1 class="text-4xl font-bold leading-tight text-white mb-4">
                    Welcome to Your<br>Health Journey
                </h1>
                <p class="text-cyan-100/90 text-lg leading-relaxed max-w-xs">
                    Join thousands of patients who trust ClinicLink for seamless healthcare management.
                </p>

                <!-- Trust Indicators -->
                <div class="flex gap-6 mt-10 text-sm">
                    <div class="flex items-center gap-2 text-cyan-200">
                        <i class="fas fa-shield-alt"></i>
                        <span class="text-xs uppercase tracking-widest">HIPAA Secure</span>
                    </div>
                    <div class="flex items-center gap-2 text-cyan-200">
                        <i class="fas fa-clock"></i>
                        <span class="text-xs uppercase tracking-widest">Instant Access</span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-xs text-cyan-300/60 flex items-center gap-2">
                <i class="fas fa-lock"></i>
                <span>Protected by Enterprise Encryption</span>
            </div>
        </div>

        <!-- Form Section -->
        <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col">
            <div class="max-w-lg mx-auto w-full">
                
                <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Create Patient Account</h2>
                    <p class="text-slate-500 mt-2 text-sm">Please provide accurate details for smooth verification</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-2xl mb-6 text-sm">
                        <ul class="space-y-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-6" id="registerForm">
                    @csrf

                    <!-- Name & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">FULL NAME <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="name" value="{{ old('name') }}" 
                                       class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                       placeholder="your name" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">EMAIL ADDRESS <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="email" name="email" value="{{ old('email') }}" 
                                       class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                       placeholder="you@example.com" required>
                            </div>
                        </div>
                    </div>

                    <!-- Phone & Location -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">PHONE NUMBER <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="tel" name="phone" value="{{ old('phone') }}" 
                                       class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                       placeholder="+92 300 1234567" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">CITY / LOCATION <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-map-marker-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="location" value="{{ old('location') }}" 
                                       class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                       placeholder="Lahore, Pakistan" required>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">RESIDENTIAL ADDRESS <span class="text-rose-500">*</span></label>
                        <textarea name="address" rows="3" 
                                  class="w-full px-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm resize-y"
                                  placeholder="House #, Street, Area">{{ old('address') }}</textarea>
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">PASSWORD <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="password" name="password" id="password"
                                       class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                       placeholder="••••••••" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">CONFIRM PASSWORD <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all text-sm"
                                       placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3 pt-2">
                        <input type="checkbox" id="terms" class="mt-1 w-4 h-4 accent-cyan-600" required>
                        <label for="terms" class="text-xs text-slate-600 leading-relaxed">
                            I agree to the <a href="#" class="text-cyan-600 hover:underline">Terms of Service</a> and 
                            <a href="#" class="text-cyan-600 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-semibold py-4 rounded-2xl shadow-lg shadow-cyan-500/30 active:scale-[0.985] transition-all duration-200 flex items-center justify-center gap-2 text-base mt-4">
                        <span>Create My Account</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="text-center mt-8">
                    <p class="text-slate-500 text-sm">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-cyan-600 hover:text-cyan-700 transition-colors">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple password match validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            
            if (pass !== confirm) {
                e.preventDefault();
                alert("Passwords do not match!");
            }
        });
    </script>
</body>
</html>