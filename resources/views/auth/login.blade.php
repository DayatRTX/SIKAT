<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKAT Polsri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-gradient-to-br from-[#EEF1FF] via-[#D2DAFF] to-[#AAC4FF]">
    <div class="h-full flex flex-col lg:flex-row">
        <!-- Left Side - Illustration/Logo (Desktop Only) -->
        <div class="hidden lg:flex lg:flex-1 items-center justify-center p-12 relative overflow-hidden">
            <!-- Decorative Blobs -->
            <div class="absolute top-20 left-20 w-96 h-96 bg-[#B1B2FF]/20 rounded-full blur-3xl animate-pulse-gentle"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 bg-[#AAC4FF]/20 rounded-full blur-3xl animate-pulse-gentle" style="animation-delay: 1s;"></div>
            
            <div class="relative z-10 text-center max-w-lg animate-fadeInUp">
                <!-- Large Logo -->
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-[#B1B2FF] to-[#AAC4FF] rounded-3xl flex items-center justify-center shadow-2xl transform hover:scale-110 hover:rotate-6 transition-all duration-500">
                    <i class="fas fa-tools text-white text-6xl"></i>
                </div>
                
                <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-[#B1B2FF] to-[#AAC4FF] bg-clip-text text-transparent">
                    SIKAT Polsri
                </h1>
                <p class="text-xl text-gray-700 font-medium mb-8">
                    Sistem Keluhan & Aduan Terpadu
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Kelola laporan kerusakan fasilitas kampus dengan cepat, mudah, dan transparan. 
                    Bergabunglah untuk menciptakan lingkungan kampus yang lebih baik! 🚀
                </p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md animate-fadeInUp">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-[#B1B2FF] to-[#AAC4FF] rounded-3xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-tools text-white text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-[#B1B2FF] to-[#AAC4FF] bg-clip-text text-transparent">SIKAT Polsri</h1>
                </div>

                <!-- Login Card -->
                <div class="card-glass rounded-3xl p-8 lg:p-10 shadow-2xl">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang! 👋</h2>
                        <p class="text-gray-600 font-medium">Silakan masuk ke akun Anda</p>
                    </div>

                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-500/10 border-l-4 border-green-500 text-green-700 p-4 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3"></i>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 bg-red-500/10 border-l-4 border-red-500 text-red-700 p-4 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-3"></i>
                                <span class="font-semibold">{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-3">
                                <i class="fas fa-envelope mr-2 text-[#B1B2FF]"></i> Email
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full px-5 py-4 input-modern rounded-2xl font-medium text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B1B2FF] @error('email') border-red-500 @enderror" 
                                placeholder="email@polsri.ac.id"
                                required
                            >
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-3">
                                <i class="fas fa-lock mr-2 text-[#B1B2FF]"></i> Password
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-5 py-4 input-modern rounded-2xl font-medium text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B1B2FF] @error('password') border-red-500 @enderror" 
                                placeholder="••••••••"
                                required
                            >
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="remember" 
                                name="remember"
                                class="w-5 h-5 text-[#B1B2FF] border-gray-300 rounded-lg focus:ring-[#B1B2FF] cursor-pointer"
                            >
                            <label for="remember" class="ml-3 text-sm text-gray-700 font-semibold cursor-pointer">
                                Ingat saya
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-[#B1B2FF] to-[#AAC4FF] text-white font-bold py-4 px-6 rounded-2xl shadow-xl btn-interactive text-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk Sekarang
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-8 text-center">
                        <p class="text-gray-600 text-sm font-medium">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-[#B1B2FF] font-bold hover:text-[#AAC4FF] transition-colors hover:underline">
                                Daftar Sekarang →
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center text-gray-600 text-sm mt-8 font-medium">
                    &copy; 2025 Politeknik Negeri Sriwijaya
                </p>
            </div>
        </div>
    </div>
</body>
</html>
