<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - VaxPortal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-6xl min-h-[640px] rounded-3xl shadow-2xl border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-cyan-700 via-teal-700 to-blue-800 p-10 flex-col justify-between relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:28px_28px]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(45deg,#ffffff08_25%,transparent_25%,transparent_50%,#ffffff08_50%,#ffffff08_75%,transparent_75%)] [background-size:70px_70px]"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 text-3xl font-black tracking-tighter text-white">
                    <span class="text-cyan-300">🩺</span>
                    <span>VAXPORTAL</span>
                </div>
                <p class="text-cyan-100 text-sm mt-1">Vaccination Management System</p>
            </div>

            <div class="relative z-10 my-auto space-y-6">
                <h1 class="text-4xl font-bold leading-tight text-white">Verify Your Identity</h1>
                <p class="text-cyan-100/90 text-lg leading-relaxed max-w-xs">
                    We've sent a 6-digit verification code to your registered email. Enter it below to complete registration.
                </p>

                <div class="flex items-center gap-4 text-cyan-100 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-shield-alt"></i>
                        <span class="text-xs uppercase tracking-widest">Secure</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-clock"></i>
                        <span class="text-xs uppercase tracking-widest">2 Min Valid</span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-xs text-cyan-200/70 flex items-center gap-2">
                <i class="fas fa-envelope"></i>
                <span>Check your inbox (and spam folder)</span>
            </div>
        </div>

        <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-md w-full mx-auto">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-cyan-100 text-cyan-600 rounded-2xl mb-5">
                        <i class="fas fa-key text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Enter OTP</h2>
                    <p class="text-slate-500 mt-2">We've sent a 6-digit code to your email</p>
                </div>

                @if (session('status'))
                    <div class="p-4 mb-6 text-sm bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-center font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mb-6 text-sm bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.verify.otp') }}" method="POST" class="space-y-6" id="otpForm">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">6-DIGIT VERIFICATION CODE</label>
                        <div class="relative">
                            <input type="text" 
                                   name="otp" 
                                   id="otpInput"
                                   maxlength="6" 
                                   required
                                   placeholder="123456"
                                   class="w-full text-center text-4xl font-mono tracking-[12px] py-6 border border-slate-200 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all bg-slate-50">
                        </div>
                        <p id="timer" class="text-center text-sm font-medium text-rose-600 mt-3"></p>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-semibold py-4 rounded-2xl shadow-lg shadow-cyan-500/30 active:scale-[0.985] transition-all duration-200 flex items-center justify-center gap-3 text-base">
                        <span>Verify &amp; Complete Registration</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="text-center mt-8">
                    <button onclick="resendOTP()" id="resendBtn" disabled
                            class="text-cyan-600 hover:text-cyan-700 font-medium flex items-center gap-2 mx-auto disabled:text-slate-400 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                        <i class="fas fa-redo"></i>
                        <span id="resendText">Resend OTP (Locked)</span>
                    </button>
                    
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-700 transition-colors mt-4 text-sm font-medium">
                        <i class="fas fa-arrow-left"></i>
                        Back to Registration
                    </a>
                </div>
            </div>
        </div>
    </div>
<script>
    const otpInput = document.getElementById('otpInput');
    const timerEl = document.getElementById('timer');
    const resendBtn = document.getElementById('resendBtn');
    const resendText = document.getElementById('resendText');
    const otpForm = document.getElementById('otpForm');
    let timeLeft = 120; // 2 minutes in seconds
    let timerInterval;

    // OTP Input Handling (Sirf numbers allowed)
    otpInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
    });

    // Auto submit when 6 digits entered
    otpInput.addEventListener('input', function() {
        if (this.value.length === 6) {
            // Native form submit call instead of keyup sequence to ensure CSRF injection
            otpForm.submit();
        }
    });

    // Timer Function
    function startTimer() {
        clearInterval(timerInterval);
        timeLeft = 120;
        resendBtn.disabled = true; 

        timerInterval = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            timerEl.textContent = `OTP code expires in ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            resendText.textContent = `Resend available (${minutes}:${seconds < 10 ? '0' : ''}${seconds})`;

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerEl.textContent = "Your current OTP has expired. Please request a new one.";
                resendBtn.disabled = false; 
                resendText.textContent = "Resend OTP";
            }
        }, 1000);
    }

    // Resend OTP trigger
    function resendOTP() {
        if (resendBtn.disabled) return;

        resendText.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Dispatching...`;
        resendBtn.disabled = true;

        window.location.href = "{{ route('register.resend.otp') }}";
    }

    window.onload = function() {
        startTimer();
        otpInput.focus();
    };
</script>
</body>
</html>
