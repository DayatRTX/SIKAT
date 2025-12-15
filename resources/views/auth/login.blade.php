<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKAT Polsri</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/icon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-mesh font-sans antialiased">
    <div class="h-full flex flex-col lg:flex-row">
        <!-- Left Side - Illustration/Logo (Desktop Only) -->
        <div class="hidden lg:flex lg:flex-1 items-center justify-center p-12 relative overflow-hidden">
            <!-- Decorative Blobs -->
            <div class="absolute top-20 left-20 w-96 h-96 bg-[#f5f5ff]0/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 bg-rose-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            
            <div class="relative z-10 text-center max-w-lg animate-fadeIn">
                <!-- Large Logo -->
                <div class="w-32 h-32 mx-auto mb-8 rounded-3xl overflow-hidden shadow-2xl shadow-[#B1B2FF]/30 transform hover:scale-110 hover:rotate-6 transition-all duration-500 bg-white">
                    <img src="{{ asset('images/icon.jpg') }}" alt="SIKAT Polsri Logo" class="w-full h-full object-cover">
                </div>
                
                <h1 class="text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#3e3fbb] to-[#6567dd]">
                    SIKAT Polsri
                </h1>
                <p class="text-xl text-slate-700 font-medium mb-8">
                    Sistem Informasi Kerusakan Aset dan Tindak lanjut
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Kelola laporan kerusakan fasilitas kampus dengan cepat, mudah, dan transparan. 
                    Bergabunglah untuk menciptakan lingkungan kampus yang lebih baik! 🚀
                </p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md animate-fadeIn delay-200">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-3xl overflow-hidden shadow-xl shadow-[#B1B2FF]/30 bg-white">
                        <img src="{{ asset('images/icon.jpg') }}" alt="SIKAT Polsri Logo" class="w-full h-full object-cover">
                    </div>
                    <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#3e3fbb] to-[#6567dd]">SIKAT Polsri</h1>
                </div>

                <!-- Login Card -->
                <div class="glass-card rounded-3xl p-8 lg:p-10 shadow-2xl">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-slate-800 mb-2">Selamat Datang! 👋</h2>
                        <p class="text-slate-600 font-medium">Silakan masuk ke akun Anda</p>
                    </div>

                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3"></i>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 bg-rose-100 border-l-4 border-rose-500 text-rose-700 p-4 rounded-xl">
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
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-3">
                                <i class="fas fa-envelope mr-2 text-[#9a9bff]"></i> Email
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full px-5 py-4 bg-white/50 border border-white/50 rounded-2xl font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#f5f5ff]0 transition-all @error('email') border-rose-500 @enderror" 
                                placeholder="email@polsri.ac.id"
                                required
                            >
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-3">
                                <i class="fas fa-lock mr-2 text-[#9a9bff]"></i> Password
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-5 py-4 bg-white/50 border border-white/50 rounded-2xl font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#f5f5ff]0 transition-all @error('password') border-rose-500 @enderror" 
                                placeholder="••••••••"
                                required
                            >
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-primary w-full py-4 text-white font-bold rounded-2xl shadow-lg shadow-[#B1B2FF]/30 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                            Masuk Sekarang <i class="fas fa-arrow-right ml-2"></i>
                        </button>

                        <!-- Register Link -->
                        <div class="text-center mt-6">
                            <p class="text-slate-600">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-[#9a9bff] font-bold hover:text-indigo-700 transition-colors">
                                    Daftar disini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
