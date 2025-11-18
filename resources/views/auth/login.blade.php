<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - SMA N 1 Negeri Katon</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            }

            .school-theme {
                background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
            }

            .btn-primary {
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(30, 58, 138, 0.3);
            }

            .input-focus:focus {
                box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
                border-color: #3b82f6;
            }

            .school-logo {
                background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
                box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background Elements -->
        <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-20 -left-20 w-40 h-40 bg-white/10 rounded-full animate-float"></div>
                <div class="absolute top-1/4 -right-16 w-32 h-32 bg-white/10 rounded-full animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute bottom-1/4 left-1/4 w-28 h-28 bg-white/10 rounded-full animate-float" style="animation-delay: 4s;"></div>
                <div class="absolute bottom-20 right-1/4 w-24 h-24 bg-white/10 rounded-full animate-float" style="animation-delay: 1s;"></div>
            </div>

            <!-- Header Section -->
            <div class="relative z-10 text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="school-logo w-28 h-28 rounded-2xl flex items-center justify-center shadow-2xl">
                        <i class="fas fa-graduation-cap text-white text-4xl"></i>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-white mb-3">SMA N 1 Negeri Katon</h1>
                <p class="text-white/90 text-xl font-medium">Sistem Pembelajaran Digital</p>
                <div class="w-24 h-1 bg-white/50 rounded-full mx-auto mt-4"></div>
            </div>

            <!-- Content Card -->
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 glass-card overflow-hidden sm:rounded-3xl mb-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 flex items-center" :status="session('status')" />

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Masuk ke Akun</h2>
                    <p class="text-gray-600 mt-2">Silakan masuk dengan kredensial Anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-3 font-semibold" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <x-text-input
                                id="email"
                                class="block mt-1 w-full pl-12 pr-4 py-3 input-focus border-gray-300 rounded-xl transition-all duration-200"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="email@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-3 text-red-600 text-sm flex items-center" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-3 font-semibold" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <x-text-input
                                id="password"
                                class="block mt-1 w-full pl-12 pr-4 py-3 input-focus border-gray-300 rounded-xl transition-all duration-200"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-3 text-red-600 text-sm flex items-center" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            {{-- <div class="relative">
                                <input id="remember_me" type="checkbox" class="sr-only" name="remember">
                                <div class="w-5 h-5 border-2 border-gray-300 rounded-md flex items-center justify-center transition-all duration-200 remember-me-toggle">
                                    <i class="fas fa-check text-white text-xs opacity-0"></i>
                                </div>
                            </div> --}}
                            {{-- <span class="ms-3 text-sm text-gray-600 font-medium">{{ __('Ingat Saya') }}</span> --}}
                        </label>

                        {{-- @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-800 transition-colors font-medium" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif --}}
                    </div>

                    <!-- Login Button -->
                    <div class="mt-8">
                        <x-primary-button class="w-full btn-primary text-white font-semibold py-4 px-6 rounded-xl flex items-center justify-center space-x-3 text-lg">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>{{ __('Masuk') }}</span>
                        </x-primary-button>
                    </div>
                </form>

                <!-- Additional Info -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="text-center">
                        {{-- <p class="text-sm text-gray-600">
                            Butuh bantuan?
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">Hubungi Administrator</a>
                        </p> --}}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="relative z-10 text-center mt-4 pb-6">
                <p class="text-white/80 text-sm font-medium">
                    © {{ date('Y') }} SMA N 1 Negeri Katon - All rights reserved
                </p>
                {{-- <div class="flex justify-center space-x-5 mt-4">
                    <a href="#" class="text-white/70 hover:text-white transition-colors transform hover:scale-110">
                        <i class="fab fa-facebook text-lg"></i>
                    </a>
                    <a href="#" class="text-white/70 hover:text-white transition-colors transform hover:scale-110">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-white/70 hover:text-white transition-colors transform hover:scale-110">
                        <i class="fab fa-youtube text-lg"></i>
                    </a>
                    <a href="#" class="text-white/70 hover:text-white transition-colors transform hover:scale-110">
                        <i class="fas fa-globe text-lg"></i>
                    </a>
                </div> --}}
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Enhanced input focus effects
                const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-200', 'rounded-xl');
                        const icon = this.parentElement.querySelector('i');
                        if (icon) {
                            icon.classList.remove('text-gray-400');
                            icon.classList.add('text-blue-500');
                        }
                    });

                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('ring-2', 'ring-blue-200', 'rounded-xl');
                        const icon = this.parentElement.querySelector('i');
                        if (icon) {
                            icon.classList.remove('text-blue-500');
                            icon.classList.add('text-gray-400');
                        }
                    });
                });

                // Custom checkbox styling
                const rememberMeCheckbox = document.getElementById('remember_me');
                const rememberMeToggle = document.querySelector('.remember-me-toggle');

                rememberMeCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        rememberMeToggle.style.backgroundColor = '#3b82f6';
                        rememberMeToggle.style.borderColor = '#3b82f6';
                        rememberMeToggle.querySelector('i').style.opacity = '1';
                    } else {
                        rememberMeToggle.style.backgroundColor = 'transparent';
                        rememberMeToggle.style.borderColor = '#d1d5db';
                        rememberMeToggle.querySelector('i').style.opacity = '0';
                    }
                });

                // Initialize checkbox state
                if (rememberMeCheckbox.checked) {
                    rememberMeToggle.style.backgroundColor = '#3b82f6';
                    rememberMeToggle.style.borderColor = '#3b82f6';
                    rememberMeToggle.querySelector('i').style.opacity = '1';
                }

                // Button hover effects
                const buttons = document.querySelectorAll('button');
                buttons.forEach(button => {
                    button.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                    });

                    button.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                    });
                });

                // Form submission loading state
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        const submitBtn = this.querySelector('[type="submit"]');
                        if (submitBtn) {
                            const originalText = submitBtn.innerHTML;
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                            submitBtn.disabled = true;

                            // Revert after 3 seconds (for demo)
                            setTimeout(() => {
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                            }, 3000);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
