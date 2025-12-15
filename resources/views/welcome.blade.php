<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKAT Polsri - Sistem Informasi Kerusakan Aset dan Tindak lanjut Politeknik Negeri Sriwijaya</title>
    <meta name="description" content="Ada yang rusak? SIKAT sekarang! Platform terpercaya untuk melaporkan dan memantau perbaikan fasilitas kampus Politeknik Negeri Sriwijaya">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/icon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <!-- Navbar -->
    <nav class="navbar-glass fixed w-full top-0 z-50 border-b border-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl overflow-hidden shadow-lg shadow-[#f5f5ff]0/30 bg-white">
                        <img src="{{ asset('images/icon.jpg') }}" alt="SIKAT Polsri Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#9a9bff] to-[#c4c5ff]">
                            SIKAT Polsri
                        </h1>
                        <p class="text-xs text-slate-500 hidden md:block">Sistem Informasi Kerusakan Aset dan Tindak lanjut</p>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-[#9a9bff] font-semibold hover:bg-[#f5f5ff] rounded-full transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary px-6 py-2.5 text-white font-semibold rounded-full shadow-lg shadow-[#f5f5ff]0/30 transition-all duration-300 hover:scale-105">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 px-4 overflow-hidden bg-mesh">
        <!-- Decorative Circles -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-[#f5f5ff]0/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-rose-500/10 rounded-full blur-3xl -z-10 animate-pulse delay-700"></div>

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-8 animate-fadeIn">
                    <div class="inline-block">
                        <span class="px-4 py-2 bg-[#f5f5ff] text-[#9a9bff] font-semibold rounded-full text-sm border border-[#ebebff] shadow-sm">
                            <i class="fas fa-star mr-1 text-yellow-400"></i> Platform Laporan Terpercaya
                        </span>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-bold text-slate-900 leading-tight">
                        Ada yang rusak?
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#9a9bff] to-[#c4c5ff]">
                            SIKAT sekarang!
                        </span>
                    </h1>
                    
                    <p class="text-xl text-slate-600 leading-relaxed">
                        Laporkan kerusakan fasilitas kampus dengan mudah. Pantau progress perbaikan kapan saja. Bersama kita wujudkan kampus yang nyaman!
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="btn-primary inline-flex items-center justify-center px-8 py-4 text-white font-bold rounded-xl shadow-xl shadow-[#f5f5ff]0/30 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Lapor Sekarang
                        </a>
                        <a href="#cara-kerja" class="inline-flex items-center justify-center px-8 py-4 bg-white text-[#9a9bff] font-bold rounded-xl border-2 border-[#ebebff] hover:border-[#9a9bff] hover:bg-[#f5f5ff] transition-all duration-300 shadow-sm">
                            <i class="fas fa-play-circle mr-2"></i>
                            Cara Kerja
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-6 pt-8 border-t border-slate-200">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#9a9bff]">24/7</div>
                            <div class="text-sm text-slate-600">Sistem Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#9a9bff]">100%</div>
                            <div class="text-sm text-slate-600">Gratis</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image/Illustration -->
                <div class="relative animate-fadeIn delay-200 hidden lg:block">
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#9a9bff]/20 to-rose-500/20 rounded-3xl blur-2xl transform rotate-6"></div>
                    <div class="glass-card rounded-3xl p-6 shadow-2xl transform -rotate-2 hover:rotate-0 transition-transform duration-500 border border-white/50">
                        <div class="bg-slate-50 rounded-2xl overflow-hidden shadow-inner">
                            <!-- Mockup UI -->
                            <div class="bg-slate-900 p-4 flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full bg-[#ebebff] flex items-center justify-center text-[#9a9bff]">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="space-y-2 flex-1">
                                        <div class="h-4 bg-slate-200 rounded w-3/4"></div>
                                        <div class="h-3 bg-slate-100 rounded w-1/2"></div>
                                    </div>
                                </div>
                                <div class="h-32 bg-slate-100 rounded-xl flex items-center justify-center text-slate-300">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="h-8 w-24 bg-yellow-100 rounded-lg"></div>
                                    <div class="h-8 w-8 bg-[#9a9bff] rounded-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 glass-card p-4 rounded-2xl shadow-lg animate-bounce">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Status Terkini</p>
                                <p class="font-bold text-slate-800">Laporan Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="cara-kerja" class="py-20 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-800 mb-4">Cara Kerja SIKAT</h2>
                <p class="text-slate-600 text-lg">Laporkan masalah dalam 3 langkah mudah dan pantau hingga selesai.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="group p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-[#ebebff]">
                    <div class="w-16 h-16 bg-[#ebebff] rounded-2xl flex items-center justify-center text-[#9a9bff] text-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">1. Foto & Lapor</h3>
                    <p class="text-slate-600">Ambil foto kerusakan, isi detail lokasi dan deskripsi masalah, lalu kirim laporan.</p>
                </div>

                <!-- Step 2 -->
                <div class="group p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-[#ebebff]">
                    <div class="w-16 h-16 bg-[#ebebff] rounded-2xl flex items-center justify-center text-[#9a9bff] text-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">2. Proses Perbaikan</h3>
                    <p class="text-slate-600">Admin memvalidasi dan menugaskan teknisi. Pantau status perbaikan kapan saja.</p>
                </div>

                <!-- Step 3 -->
                <div class="group p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-[#ebebff]">
                    <div class="w-16 h-16 bg-[#ebebff] rounded-2xl flex items-center justify-center text-[#9a9bff] text-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">3. Selesai</h3>
                    <p class="text-slate-600">Terima notifikasi bukti perbaikan dan berikan penilaian atas kinerja teknisi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Flowchart Section -->
    <section class="py-24 bg-gradient-to-br from-[#EEF1FF] via-[#D2DAFF] to-[#AAC4FF] relative overflow-hidden">
        <!-- Animated Background Blobs -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-gradient-to-br from-[#B1B2FF]/30 to-[#9091EB]/30 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute top-20 right-20 w-[400px] h-[400px] bg-gradient-to-br from-[#AAC4FF]/30 to-[#B1B2FF]/30 rounded-full blur-3xl animate-blob" style="animation-delay: 2s"></div>
            <div class="absolute bottom-0 left-1/3 w-[450px] h-[450px] bg-gradient-to-br from-[#D2DAFF]/40 to-[#AAC4FF]/40 rounded-full blur-3xl animate-blob" style="animation-delay: 4s"></div>
            <div class="absolute top-1/2 right-1/4 w-[350px] h-[350px] bg-gradient-to-br from-[#9091EB]/20 to-[#B1B2FF]/20 rounded-full blur-3xl animate-blob" style="animation-delay: 6s"></div>
        </div>
        
        <!-- Enhanced Floating Particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[15%] left-[8%] w-4 h-4 bg-[#B1B2FF]/50 rounded-full animate-float shadow-lg" style="animation-delay: 0s"></div>
            <div class="absolute top-[25%] right-[15%] w-3 h-3 bg-[#9091EB]/60 rounded-full animate-float shadow-lg" style="animation-delay: 1s"></div>
            <div class="absolute bottom-[30%] left-[20%] w-5 h-5 bg-[#AAC4FF]/40 rounded-full animate-float shadow-lg" style="animation-delay: 2s"></div>
            <div class="absolute top-[45%] right-[25%] w-3 h-3 bg-[#B1B2FF]/70 rounded-full animate-float shadow-lg" style="animation-delay: 3s"></div>
            <div class="absolute bottom-[35%] right-[10%] w-4 h-4 bg-[#D2DAFF]/60 rounded-full animate-float shadow-lg" style="animation-delay: 4s"></div>
            <div class="absolute top-[60%] left-[12%] w-2 h-2 bg-[#9091EB]/50 rounded-full animate-float shadow-lg" style="animation-delay: 5s"></div>
            <div class="absolute bottom-[20%] left-[35%] w-3 h-3 bg-[#B1B2FF]/40 rounded-full animate-float shadow-lg" style="animation-delay: 6s"></div>
            <div class="absolute top-[70%] right-[30%] w-4 h-4 bg-[#AAC4FF]/50 rounded-full animate-float shadow-lg" style="animation-delay: 7s"></div>
        </div>
        
        <!-- Decorative Lines -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-0 w-full h-px bg-gradient-to-r from-transparent via-[#B1B2FF] to-transparent"></div>
            <div class="absolute bottom-20 left-0 w-full h-px bg-gradient-to-r from-transparent via-[#9091EB] to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-20">
                <!-- Animated Badge -->
                <div class="inline-block mb-6 animate-slideIn">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-full blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                        <span class="relative px-6 py-3 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] backdrop-blur-xl text-white font-extrabold rounded-full text-sm border-2 border-white/40 shadow-xl flex items-center gap-2">
                            <i class="fas fa-sitemap text-white"></i>
                            <span>Alur Kerja Sistem</span>
                            <i class="fas fa-arrow-down text-white animate-bounce"></i>
                        </span>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h2 class="text-6xl md:text-7xl font-black bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] bg-clip-text text-transparent mb-6 leading-tight animate-slideIn drop-shadow-2xl" style="animation-delay: 0.1s">
                    Bagaimana SIKAT Bekerja?
                </h2>
                
                <!-- Subtitle with effects -->
                <div class="relative inline-block animate-slideIn" style="animation-delay: 0.2s">
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#B1B2FF]/20 to-[#9091EB]/20 blur-2xl rounded-full"></div>
                    <p class="relative text-xl md:text-2xl text-slate-700 leading-relaxed px-8 py-4 bg-white/60 backdrop-blur-sm rounded-full border border-[#B1B2FF]/30 shadow-xl">
                        <span class="inline-block mr-2 text-2xl animate-pulse">✨</span>
                        Dari laporan hingga selesai, semua terkelola dengan
                        <span class="font-black text-transparent bg-clip-text bg-gradient-to-r from-[#B1B2FF] to-[#9091EB]">baik dan transparan</span>
                        <span class="inline-block ml-2 text-2xl animate-pulse" style="animation-delay: 0.5s">🚀</span>
                    </p>
                </div>
            </div>

            <!-- Flowchart -->
            <div class="relative">
                <!-- Connection Line Background (Desktop) -->
                <div class="hidden lg:block absolute top-36 left-1/2 -translate-x-1/2 w-[92%]">
                    <div class="h-2 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] via-[#9091EB] to-[#B1B2FF] rounded-full opacity-20 shadow-lg"></div>
                    <div class="h-2 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] via-[#9091EB] to-[#B1B2FF] rounded-full opacity-40 blur-sm animate-pulse"></div>
                </div>
                
                <!-- Desktop Flow -->
                <div class="hidden lg:block">
                    <div class="flex justify-center items-start gap-8">
                        <!-- Step 1: Mahasiswa Lapor -->
                        <div class="flex flex-col items-center group animate-slideIn" style="animation-delay: 0.2s">
                            <div class="relative">
                                <!-- Outer Glow -->
                                <div class="absolute -inset-2 bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-[2rem] opacity-0 group-hover:opacity-100 blur-2xl transition-all duration-700"></div>
                                
                                <!-- Card Container -->
                                <div class="relative">
                                    <!-- Card -->
                                    <div class="relative glass-card rounded-[2rem] p-10 w-64 text-center transform group-hover:scale-110 group-hover:-translate-y-6 group-hover:rotate-1 transition-all duration-700 border-2 border-white/80 shadow-2xl hover:shadow-[#B1B2FF]/40 bg-gradient-to-br from-white/95 to-[#EEF1FF]/90">
                                        <!-- Number Badge with animation -->
                                        <div class="absolute -top-5 -right-5 w-12 h-12 bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-full flex items-center justify-center text-white font-black text-lg shadow-2xl border-4 border-white group-hover:rotate-[360deg] transition-transform duration-700">
                                            <span class="drop-shadow-lg">1</span>
                                        </div>
                                        
                                        <!-- Icon Container -->
                                        <div class="relative mb-6">
                                            <div class="absolute inset-0 bg-[#B1B2FF] rounded-3xl blur-xl opacity-40 group-hover:opacity-70 group-hover:scale-110 transition-all duration-500"></div>
                                            <div class="relative w-24 h-24 mx-auto bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-3xl flex items-center justify-center text-white text-4xl shadow-2xl group-hover:rotate-12 group-hover:scale-125 transition-all duration-700">
                                                <i class="fas fa-user-graduate drop-shadow-lg"></i>
                                            </div>
                                            <!-- Orbiting dots -->
                                            <div class="absolute top-0 right-0 w-3 h-3 bg-[#B1B2FF] rounded-full animate-ping"></div>
                                            <div class="absolute bottom-0 left-0 w-3 h-3 bg-[#9091EB] rounded-full animate-ping" style="animation-delay: 0.5s"></div>
                                        </div>
                                        
                                        <!-- Step Badge -->
                                        <div class="text-xs font-black text-white bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] px-5 py-2 rounded-full inline-block mb-5 shadow-lg tracking-wider">STEP 1</div>
                                        
                                        <!-- Title -->
                                        <h3 class="text-xl font-black bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] bg-clip-text text-transparent mb-4 drop-shadow">Mahasiswa</h3>
                                        
                                        <!-- Description -->
                                        <p class="text-sm text-slate-600 leading-relaxed font-medium">Melaporkan kerusakan dengan foto & deskripsi</p>
                                        
                                        <!-- Pulse Indicator -->
                                        <div class="mt-6 flex justify-center gap-1.5">
                                            <div class="w-2 h-2 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] rounded-full animate-pulse shadow-lg"></div>
                                            <div class="w-2 h-2 bg-gradient-to-r from-[#A0A1F5] to-[#B1B2FF] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.2s"></div>
                                            <div class="w-2 h-2 bg-gradient-to-r from-[#9091EB] to-[#A0A1F5] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.4s"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow 1 -->
                        <div class="flex items-center pt-36 animate-slideIn" style="animation-delay: 0.3s">
                            <div class="flex flex-col items-center gap-3">
                                <div class="relative group/arrow">
                                    <div class="absolute inset-0 blur-xl bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] opacity-50 group-hover/arrow:opacity-75 transition-opacity"></div>
                                    <i class="relative fas fa-arrow-right text-6xl text-transparent bg-clip-text bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] animate-pulse drop-shadow-2xl"></i>
                                </div>
                                <span class="text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] tracking-wider">KIRIM</span>
                            </div>
                        </div>

                        <!-- Step 2: Admin Validasi -->
                        <div class="flex flex-col items-center group animate-slideIn" style="animation-delay: 0.4s">
                            <div class="relative">
                                <div class="absolute -inset-2 bg-gradient-to-br from-[#9091EB] to-[#7071C9] rounded-[2rem] opacity-0 group-hover:opacity-100 blur-2xl transition-all duration-700"></div>
                                <div class="relative glass-card rounded-[2rem] p-10 w-64 text-center transform group-hover:scale-110 group-hover:-translate-y-6 group-hover:-rotate-1 transition-all duration-700 border-2 border-white/80 shadow-2xl hover:shadow-[#9091EB]/40 bg-gradient-to-br from-white/95 to-[#D2DAFF]/90">
                                    <div class="absolute -top-5 -right-5 w-12 h-12 bg-gradient-to-br from-[#9091EB] to-[#7071C9] rounded-full flex items-center justify-center text-white font-black text-lg shadow-2xl border-4 border-white group-hover:rotate-[360deg] transition-transform duration-700">
                                        <span class="drop-shadow-lg">2</span>
                                    </div>
                                    <div class="relative mb-6">
                                        <div class="absolute inset-0 bg-[#9091EB] rounded-3xl blur-xl opacity-40 group-hover:opacity-70 group-hover:scale-110 transition-all duration-500"></div>
                                        <div class="relative w-24 h-24 mx-auto bg-gradient-to-br from-[#9091EB] via-[#8081D9] to-[#7071C9] rounded-3xl flex items-center justify-center text-white text-4xl shadow-2xl group-hover:rotate-12 group-hover:scale-125 transition-all duration-700">
                                            <i class="fas fa-user-shield drop-shadow-lg"></i>
                                        </div>
                                        <div class="absolute top-0 right-0 w-3 h-3 bg-[#9091EB] rounded-full animate-ping"></div>
                                        <div class="absolute bottom-0 left-0 w-3 h-3 bg-[#7071C9] rounded-full animate-ping" style="animation-delay: 0.5s"></div>
                                    </div>
                                    <div class="text-xs font-black text-white bg-gradient-to-r from-[#9091EB] to-[#7071C9] px-5 py-2 rounded-full inline-block mb-5 shadow-lg tracking-wider">STEP 2</div>
                                    <h3 class="text-xl font-black bg-gradient-to-br from-[#9091EB] to-[#7071C9] bg-clip-text text-transparent mb-4 drop-shadow">Admin</h3>
                                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Memvalidasi & menugaskan teknisi</p>
                                    <div class="mt-6 flex justify-center gap-1.5">
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#9091EB] to-[#7071C9] rounded-full animate-pulse shadow-lg"></div>
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#8081D9] to-[#9091EB] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.2s"></div>
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#7071C9] to-[#8081D9] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.4s"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow 2 -->
                        <div class="flex items-center pt-36 animate-slideIn" style="animation-delay: 0.5s">
                            <div class="flex flex-col items-center gap-3">
                                <div class="relative group/arrow">
                                    <div class="absolute inset-0 blur-xl bg-gradient-to-r from-[#9091EB] to-[#B1B2FF] opacity-50 group-hover/arrow:opacity-75 transition-opacity"></div>
                                    <i class="relative fas fa-arrow-right text-6xl text-transparent bg-clip-text bg-gradient-to-r from-[#9091EB] to-[#B1B2FF] animate-pulse drop-shadow-2xl" style="animation-delay: 0.2s"></i>
                                </div>
                                <span class="text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-[#9091EB] to-[#B1B2FF] tracking-wider">TUGASKAN</span>
                            </div>
                        </div>

                        <!-- Step 3: Teknisi -->
                        <div class="flex flex-col items-center group animate-slideIn" style="animation-delay: 0.6s">
                            <div class="relative">
                                <div class="absolute -inset-2 bg-gradient-to-br from-[#AAC4FF] to-[#9091EB] rounded-[2rem] opacity-0 group-hover:opacity-100 blur-2xl transition-all duration-700"></div>
                                <div class="relative glass-card rounded-[2rem] p-10 w-64 text-center transform group-hover:scale-110 group-hover:-translate-y-6 group-hover:rotate-1 transition-all duration-700 border-2 border-white/80 shadow-2xl hover:shadow-[#AAC4FF]/40 bg-gradient-to-br from-white/95 to-[#AAC4FF]/80">
                                    <div class="absolute -top-5 -right-5 w-12 h-12 bg-gradient-to-br from-[#AAC4FF] to-[#9091EB] rounded-full flex items-center justify-center text-white font-black text-lg shadow-2xl border-4 border-white group-hover:rotate-[360deg] transition-transform duration-700">
                                        <span class="drop-shadow-lg">3</span>
                                    </div>
                                    <div class="relative mb-6">
                                        <div class="absolute inset-0 bg-[#AAC4FF] rounded-3xl blur-xl opacity-40 group-hover:opacity-70 group-hover:scale-110 transition-all duration-500"></div>
                                        <div class="relative w-24 h-24 mx-auto bg-gradient-to-br from-[#AAC4FF] via-[#A0A1F5] to-[#9091EB] rounded-3xl flex items-center justify-center text-white text-4xl shadow-2xl group-hover:rotate-12 group-hover:scale-125 transition-all duration-700">
                                            <i class="fas fa-tools drop-shadow-lg"></i>
                                        </div>
                                        <div class="absolute top-0 right-0 w-3 h-3 bg-[#AAC4FF] rounded-full animate-ping"></div>
                                        <div class="absolute bottom-0 left-0 w-3 h-3 bg-[#9091EB] rounded-full animate-ping" style="animation-delay: 0.5s"></div>
                                    </div>
                                    <div class="text-xs font-black text-white bg-gradient-to-r from-[#AAC4FF] to-[#9091EB] px-5 py-2 rounded-full inline-block mb-5 shadow-lg tracking-wider">STEP 3</div>
                                    <h3 class="text-xl font-black bg-gradient-to-br from-[#AAC4FF] to-[#9091EB] bg-clip-text text-transparent mb-4 drop-shadow">Teknisi</h3>
                                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Melakukan perbaikan & upload bukti</p>
                                    <div class="mt-6 flex justify-center gap-1.5">
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#AAC4FF] to-[#9091EB] rounded-full animate-pulse shadow-lg"></div>
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#A0A1F5] to-[#AAC4FF] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.2s"></div>
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#9091EB] to-[#A0A1F5] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.4s"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow 3 -->
                        <div class="flex items-center pt-36 animate-slideIn" style="animation-delay: 0.7s">
                            <div class="flex flex-col items-center gap-3">
                                <div class="relative group/arrow">
                                    <div class="absolute inset-0 blur-xl bg-gradient-to-r from-[#AAC4FF] to-[#B1B2FF] opacity-50 group-hover/arrow:opacity-75 transition-opacity"></div>
                                    <i class="relative fas fa-arrow-right text-6xl text-transparent bg-clip-text bg-gradient-to-r from-[#AAC4FF] to-[#B1B2FF] animate-pulse drop-shadow-2xl" style="animation-delay: 0.4s"></i>
                                </div>
                                <span class="text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-[#AAC4FF] to-[#B1B2FF] tracking-wider">SELESAI</span>
                            </div>
                        </div>

                        <!-- Step 4: Completed -->
                        <div class="flex flex-col items-center group animate-slideIn" style="animation-delay: 0.8s">
                            <div class="relative">
                                <div class="absolute -inset-2 bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-[2rem] opacity-0 group-hover:opacity-100 blur-2xl transition-all duration-700"></div>
                                <div class="relative glass-card rounded-[2rem] p-10 w-64 text-center transform group-hover:scale-110 group-hover:-translate-y-6 group-hover:-rotate-1 transition-all duration-700 border-2 border-white/80 shadow-2xl hover:shadow-[#B1B2FF]/40 bg-gradient-to-br from-white/95 to-[#B1B2FF]/20">
                                    <div class="absolute -top-5 -right-5 w-12 h-12 bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-full flex items-center justify-center text-white font-black text-2xl shadow-2xl border-4 border-white group-hover:rotate-[360deg] transition-transform duration-700">
                                        <span class="drop-shadow-lg">✓</span>
                                    </div>
                                    <div class="relative mb-6">
                                        <div class="absolute inset-0 bg-[#B1B2FF] rounded-3xl blur-xl opacity-40 group-hover:opacity-70 group-hover:scale-110 transition-all duration-500 animate-pulse"></div>
                                        <div class="relative w-24 h-24 mx-auto bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-3xl flex items-center justify-center text-white text-4xl shadow-2xl group-hover:rotate-12 group-hover:scale-125 transition-all duration-700">
                                            <i class="fas fa-check-circle drop-shadow-lg"></i>
                                        </div>
                                        <div class="absolute top-0 right-0 w-3 h-3 bg-[#B1B2FF] rounded-full animate-ping"></div>
                                        <div class="absolute bottom-0 left-0 w-3 h-3 bg-[#9091EB] rounded-full animate-ping" style="animation-delay: 0.5s"></div>
                                    </div>
                                    <div class="text-xs font-black text-white bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] px-5 py-2 rounded-full inline-block mb-5 shadow-lg tracking-wider">DONE ✓</div>
                                    <h3 class="text-xl font-black bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] bg-clip-text text-transparent mb-4 drop-shadow">Selesai</h3>
                                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Laporan ditutup & arsip tersimpan</p>
                                    <div class="mt-6 flex justify-center gap-1.5">
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] rounded-full animate-pulse shadow-lg"></div>
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#A0A1F5] to-[#B1B2FF] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.2s"></div>
                                        <div class="w-2 h-2 bg-gradient-to-r from-[#9091EB] to-[#A0A1F5] rounded-full animate-pulse shadow-lg" style="animation-delay: 0.4s"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Flow (Visible on Mobile) -->
                <div class="lg:hidden space-y-6">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center">
                        <div class="glass-card rounded-3xl p-6 w-full max-w-xs text-center border border-white/50 shadow-xl">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mb-4 shadow-lg">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="text-sm font-bold text-white bg-blue-500 px-3 py-1 rounded-full inline-block mb-3">Step 1</div>
                            <h3 class="font-bold text-slate-800 mb-2">Mahasiswa</h3>
                            <p class="text-sm text-slate-600">Melaporkan kerusakan dengan foto & deskripsi</p>
                        </div>
                        <i class="fas fa-arrow-down text-3xl text-[#B1B2FF] my-4 animate-pulse"></i>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center">
                        <div class="glass-card rounded-3xl p-6 w-full max-w-xs text-center border border-white/50 shadow-xl">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl mb-4 shadow-lg">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div class="text-sm font-bold text-white bg-purple-500 px-3 py-1 rounded-full inline-block mb-3">Step 2</div>
                            <h3 class="font-bold text-slate-800 mb-2">Admin</h3>
                            <p class="text-sm text-slate-600">Memvalidasi & menugaskan teknisi</p>
                        </div>
                        <i class="fas fa-arrow-down text-3xl text-[#B1B2FF] my-4 animate-pulse"></i>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center">
                        <div class="glass-card rounded-3xl p-6 w-full max-w-xs text-center border border-white/50 shadow-xl">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center text-white text-2xl mb-4 shadow-lg">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="text-sm font-bold text-white bg-orange-500 px-3 py-1 rounded-full inline-block mb-3">Step 3</div>
                            <h3 class="font-bold text-slate-800 mb-2">Teknisi</h3>
                            <p class="text-sm text-slate-600">Melakukan perbaikan & upload bukti</p>
                        </div>
                        <i class="fas fa-arrow-down text-3xl text-[#B1B2FF] my-4 animate-pulse"></i>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex flex-col items-center">
                        <div class="glass-card rounded-3xl p-6 w-full max-w-xs text-center border border-white/50 shadow-xl">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white text-2xl mb-4 shadow-lg">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="text-sm font-bold text-white bg-emerald-500 px-3 py-1 rounded-full inline-block mb-3">Step 4</div>
                            <h3 class="font-bold text-slate-800 mb-2">Selesai</h3>
                            <p class="text-sm text-slate-600">Laporan ditutup & arsip tersimpan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#9a9bff] to-[#f5f5ff]0 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tools text-white"></i>
                        </div>
                        <span class="text-xl font-bold">SIKAT Polsri</span>
                    </div>
                    <p class="text-slate-400 max-w-sm">
                        Sistem Informasi Kerusakan Aset dan Tindak lanjut Politeknik Negeri Sriwijaya. Solusi cepat untuk kampus yang lebih baik.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4 text-lg">Tautan</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-[#c4c5ff] transition-colors">Beranda</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-[#c4c5ff] transition-colors">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-[#c4c5ff] transition-colors">Daftar</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Kontak</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li class="flex items-center"><i class="fas fa-envelope w-6"></i> admin@polsri.ac.id</li>
                        <li class="flex items-center"><i class="fas fa-phone w-6"></i> (+62) 821-8627-0228</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt w-6"></i> Palembang, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 text-center text-slate-500 text-sm">
                &copy; {{ date('Y') }} SIKAT Polsri. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
