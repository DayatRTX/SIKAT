<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKAT Polsri - Sistem Informasi Kerusakan Aset dan Tindak lanjut Politeknik Negeri Sriwijaya</title>
    <meta name="description" content="Ada yang rusak? SIKAT sekarang! Platform terpercaya untuk melaporkan dan memantau perbaikan fasilitas kampus Politeknik Negeri Sriwijaya">
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
                        Laporkan kerusakan fasilitas kampus dengan mudah. Pantau progress perbaikan secara real-time. Bersama kita wujudkan kampus yang nyaman!
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
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-200">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#9a9bff]">24/7</div>
                            <div class="text-sm text-slate-600">Sistem Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#9a9bff]">100%</div>
                            <div class="text-sm text-slate-600">Gratis</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#9a9bff]">Real-time</div>
                            <div class="text-sm text-slate-600">Update Status</div>
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
                    <p class="text-slate-600">Admin memvalidasi dan menugaskan teknisi. Anda dapat memantau status secara real-time.</p>
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
                        <li class="flex items-center"><i class="fas fa-phone w-6"></i> (0711) 353414</li>
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
