<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKAT Polsri</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/icon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -30px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(30px, 10px) scale(1.05); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(177, 178, 255, 0.3); }
            50% { box-shadow: 0 0 40px rgba(177, 178, 255, 0.6); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-blob { animation: blob 10s ease-in-out infinite; }
        .animate-slideIn { animation: slideIn 0.6s ease-out forwards; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-glow:focus {
            animation: pulse-glow 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50">
    <div class="min-h-screen grid lg:grid-cols-2">
        <!-- Left Panel - Branding -->
        <div class="hidden lg:flex lg:flex-col lg:justify-center lg:items-center relative overflow-hidden bg-gradient-to-br from-[#B1B2FF] via-[#9091EB] to-[#7071C9] p-12">
            <!-- Animated Background Blobs -->
            <div class="absolute inset-0">
                <div class="absolute top-0 -left-4 w-96 h-96 bg-white/30 rounded-full mix-blend-overlay filter blur-3xl animate-blob"></div>
                <div class="absolute top-0 -right-4 w-96 h-96 bg-rose-300/40 rounded-full mix-blend-overlay filter blur-3xl animate-blob" style="animation-delay: 3.3s"></div>
                <div class="absolute -bottom-8 left-20 w-96 h-96 bg-yellow-300/30 rounded-full mix-blend-overlay filter blur-3xl animate-blob" style="animation-delay: 6.6s"></div>
                <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-cyan-300/20 rounded-full mix-blend-overlay filter blur-2xl animate-blob" style="animation-delay: 1.6s"></div>
            </div>
            
            <!-- Decorative Circles -->
            <div class="absolute top-10 right-10 w-20 h-20 border-4 border-white/20 rounded-full animate-float" style="animation-delay: 0.5s"></div>
            <div class="absolute bottom-20 left-10 w-16 h-16 border-4 border-white/20 rounded-full animate-float" style="animation-delay: 1.5s"></div>
            <div class="absolute top-1/3 right-1/4 w-12 h-12 border-4 border-white/30 rounded-full animate-float" style="animation-delay: 2.5s"></div>
            
            <!-- Content -->
            <div class="relative z-10 text-center max-w-lg animate-slideIn">
                <!-- Logo -->
                <div class="mb-12 animate-float">
                    <div class="w-40 h-40 mx-auto bg-white/20 backdrop-blur-xl rounded-3xl p-4 shadow-2xl border border-white/30 transform hover:scale-110 hover:rotate-6 transition-all duration-500 cursor-pointer group">
                        <img src="{{ asset('images/icon.jpg') }}" alt="SIKAT Polsri" class="w-full h-full object-cover rounded-2xl group-hover:brightness-110 transition-all">
                    </div>
                    <div class="mt-4 flex justify-center gap-2">
                        <div class="w-2 h-2 bg-white/50 rounded-full animate-pulse"></div>
                        <div class="w-2 h-2 bg-white/50 rounded-full animate-pulse" style="animation-delay: 0.3s"></div>
                        <div class="w-2 h-2 bg-white/50 rounded-full animate-pulse" style="animation-delay: 0.6s"></div>
                    </div>
                </div>
                
                <!-- Title -->
                <h1 class="text-6xl font-bold text-white mb-6 drop-shadow-lg">
                    SIKAT
                </h1>
                <p class="text-2xl text-white/90 font-semibold mb-4">
                    Sistem Informasi Kerusakan Aset dan Tindak Lanjut
                </p>
                <p class="text-lg text-white/80 leading-relaxed max-w-md mx-auto">
                    Platform terpadu untuk melaporkan dan memantau perbaikan fasilitas kampus dengan mudah dan transparan
                </p>

                <!-- Feature Cards -->
                <div class="mt-12 grid grid-cols-3 gap-4 text-white/90">
                    <div class="backdrop-blur-sm bg-white/10 rounded-2xl p-4 border border-white/20 transform hover:scale-110 hover:-translate-y-2 transition-all duration-300 cursor-pointer hover:bg-white/20 animate-slideIn" style="animation-delay: 0.2s">
                        <div class="text-3xl font-bold mb-1">⚡</div>
                        <div class="text-2xl font-bold">24/7</div>
                        <div class="text-xs mt-1 opacity-80">Aktif</div>
                    </div>
                    <div class="backdrop-blur-sm bg-white/10 rounded-2xl p-4 border border-white/20 transform hover:scale-110 hover:-translate-y-2 transition-all duration-300 cursor-pointer hover:bg-white/20 animate-slideIn" style="animation-delay: 0.4s">
                        <div class="text-3xl font-bold mb-1">🚀</div>
                        <div class="text-2xl font-bold">Fast</div>
                        <div class="text-xs mt-1 opacity-80">Response</div>
                    </div>
                    <div class="backdrop-blur-sm bg-white/10 rounded-2xl p-4 border border-white/20 transform hover:scale-110 hover:-translate-y-2 transition-all duration-300 cursor-pointer hover:bg-white/20 animate-slideIn" style="animation-delay: 0.6s">
                        <div class="text-3xl font-bold mb-1">💎</div>
                        <div class="text-2xl font-bold">Free</div>
                        <div class="text-xs mt-1 opacity-80">100%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="flex items-center justify-center p-6 lg:p-12 bg-gradient-to-br from-slate-50 via-purple-50 to-blue-50 overflow-y-auto relative">
            <!-- Decorative Elements -->
            <div class="absolute top-10 right-10 w-32 h-32 bg-gradient-to-br from-purple-200/30 to-blue-200/30 rounded-full blur-2xl"></div>
            <div class="absolute bottom-20 left-10 w-40 h-40 bg-gradient-to-br from-pink-200/30 to-purple-200/30 rounded-full blur-2xl"></div>
            
            <div class="w-full max-w-md relative z-10">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8 animate-slideIn">
                    <div class="w-24 h-24 mx-auto bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-3xl p-3 shadow-xl mb-4 animate-float">
                        <img src="{{ asset('images/icon.jpg') }}" alt="SIKAT" class="w-full h-full object-cover rounded-2xl">
                    </div>
                    <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#B1B2FF] to-[#9091EB]">SIKAT</h1>
                </div>

                <!-- Form Card -->
                <div class="glass-card rounded-3xl shadow-2xl p-8 lg:p-10 border border-slate-200/50 animate-slideIn" style="animation-delay: 0.2s">
                    <div class="mb-8">
                        <div class="inline-block mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] rounded-full animate-pulse"></div>
                                <div class="w-2 h-2 bg-gradient-to-r from-[#9091EB] to-[#7071C9] rounded-full animate-pulse" style="animation-delay: 0.3s"></div>
                                <div class="w-2 h-2 bg-gradient-to-r from-[#7071C9] to-[#B1B2FF] rounded-full animate-pulse" style="animation-delay: 0.6s"></div>
                            </div>
                        </div>
                        <h2 class="text-4xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent mb-2">Selamat Datang! 👋</h2>
                        <p class="text-slate-500">Masuk ke akun Anda untuk melanjutkan</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl animate-fadeIn">
                            <div class="flex items-center text-emerald-700">
                                <i class="fas fa-check-circle text-xl mr-3"></i>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-xl animate-fadeIn">
                            <div class="flex items-center text-rose-700">
                                <i class="fas fa-exclamation-circle text-xl mr-3"></i>
                                <span class="font-semibold">{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Email Field -->
                        <div class="relative group" x-data="{ focused: false }">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] rounded-2xl opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                @focus="focused = true" 
                                @blur="focused = false"
                                class="peer w-full px-4 pt-6 pb-2 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 font-medium placeholder-transparent focus:outline-none focus:border-[#B1B2FF] focus:bg-white focus:shadow-lg focus:shadow-[#B1B2FF]/20 transition-all duration-300 relative input-glow"
                                placeholder="Email"
                                required
                            >
                            <label 
                                for="email" 
                                class="absolute left-4 top-2 text-xs font-bold text-slate-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:top-2 peer-focus:text-xs peer-focus:text-[#B1B2FF]"
                            >
                                <i class="fas fa-envelope mr-1"></i> Email Address
                            </label>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 transition-all" :class="focused ? 'text-[#B1B2FF] scale-110' : 'text-slate-300'">
                                <i class="fas fa-at"></i>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="relative group" x-data="{ focused: false, show: false }">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] rounded-2xl opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
                            <input 
                                :type="show ? 'text' : 'password'"
                                id="password" 
                                name="password" 
                                @focus="focused = true" 
                                @blur="focused = false"
                                class="peer w-full px-4 pt-6 pb-2 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 font-medium placeholder-transparent focus:outline-none focus:border-[#B1B2FF] focus:bg-white focus:shadow-lg focus:shadow-[#B1B2FF]/20 transition-all duration-300 relative input-glow"
                                placeholder="Password"
                                required
                            >
                            <label 
                                for="password" 
                                class="absolute left-4 top-2 text-xs font-bold text-slate-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:top-2 peer-focus:text-xs peer-focus:text-[#B1B2FF]"
                            >
                                <i class="fas fa-lock mr-1"></i> Password
                            </label>
                            <button 
                                type="button"
                                @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#B1B2FF] transition-all hover:scale-110"
                            >
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="group relative w-full overflow-hidden bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] hover:from-[#9091EB] hover:via-[#8081D9] hover:to-[#7071C9] text-white font-bold py-4 rounded-2xl shadow-lg shadow-[#B1B2FF]/30 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-[#B1B2FF]/50 hover:scale-[1.02]"
                        >
                            <span class="relative z-10 flex items-center justify-center text-lg">
                                <i class="fas fa-sign-in-alt mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                                Masuk Sekarang
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/30 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-8 text-center">
                        <div class="relative inline-block">
                            <p class="text-slate-600">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] hover:from-[#9091EB] hover:to-[#7071C9] transition-all relative group">
                                    Daftar Sekarang
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] group-hover:w-full transition-all duration-300"></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center text-slate-400 text-sm mt-6 animate-slideIn" style="animation-delay: 0.8s">
                    💜 {{ date('Y') }} SIKAT Polsri.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Persistent Background Music -->
    <div id="bgm-container" class="fixed bottom-6 right-6 z-50" data-turbo-permanent>
        <button id="bgm-toggle" class="group relative w-14 h-14 bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-full shadow-2xl hover:shadow-[#B1B2FF]/50 transition-all duration-300 hover:scale-110 flex items-center justify-center">
            <i id="bgm-icon" class="fas fa-music-slash text-white text-xl"></i>
            <div class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-500 rounded-full border-2 border-white shadow-lg opacity-0 transition-opacity duration-300" id="bgm-playing-indicator"></div>
        </button>
    </div>
</body>
</html>
