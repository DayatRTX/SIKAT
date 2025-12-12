<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiGAP Polsri - Sistem Gangguan & Perbaikan Politeknik Negeri Sriwijaya</title>
    <meta name="description" content="Platform terpercaya untuk melaporkan dan memantau perbaikan fasilitas kampus Politeknik Negeri Sriwijaya">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-background">
    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-md fixed w-full top-0 z-50 border-b border-tertiary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-linear-to-br from-primary to-secondary rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-tools text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-transparent" style="background: linear-gradient(to right, #B1B2FF, #AAC4FF); -webkit-background-clip: text; background-clip: text;">
                            SiGAP Polsri
                        </h1>
                        <p class="text-xs text-gray-500 hidden md:block">Sistem Gangguan & Perbaikan</p>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-primary font-semibold hover:bg-tertiary rounded-full transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 text-white font-semibold rounded-full hover:shadow-lg transition-all duration-300 hover:scale-105" style="background: linear-gradient(to right, #B1B2FF, #AAC4FF);">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 px-4 overflow-hidden">
        <!-- Background Gradient -->
        <div class="absolute inset-0 -z-10" style="background: linear-gradient(135deg, #D2DAFF 0%, #EEF1FF 100%);"></div>
        
        <!-- Decorative Circles -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-8 animate-fade-in">
                    <div class="inline-block">
                        <span class="px-4 py-2 bg-primary/10 text-primary font-semibold rounded-full text-sm border border-primary/20">
                            <i class="fas fa-star mr-1"></i> Platform Laporan Terpercaya
                        </span>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                        Lapor Kerusakan Fasilitas Polsri dengan 
                        <span class="text-transparent" style="background: linear-gradient(to right, #B1B2FF, #AAC4FF); -webkit-background-clip: text; background-clip: text;">
                            Cepat & Mudah
                        </span>
                    </h1>
                    
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Bantu kami menjaga kenyamanan kampus. Lapor kerusakan, pantau progress perbaikan, dan lihat hasilnya secara real-time.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105" style="background: linear-gradient(to right, #B1B2FF, #AAC4FF);">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Lapor Sekarang
                        </a>
                        <a href="#cara-kerja" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary font-bold rounded-xl border-2 border-primary hover:bg-primary hover:text-white transition-all duration-300">
                            <i class="fas fa-play-circle mr-2"></i>
                            Cara Kerja
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary">24/7</div>
                            <div class="text-sm text-gray-600">Sistem Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary">100%</div>
                            <div class="text-sm text-gray-600">Gratis</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary">Real-time</div>
                            <div class="text-sm text-gray-600">Update Status</div>
                        </div>
                    </div>
                </div>

                <!-- Illustration -->
                <div class="relative lg:block hidden">
                    <div class="relative z-10">
                        <!-- SVG Illustration -->
                        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-tertiary">
                            <svg viewBox="0 0 400 400" class="w-full h-auto">
                                <!-- Background -->
                                <rect x="0" y="0" width="400" height="400" fill="#EEF1FF" rx="20"/>
                                
                                <!-- Phone Frame -->
                                <rect x="100" y="50" width="200" height="300" fill="white" rx="20" stroke="#B1B2FF" stroke-width="3"/>
                                
                                <!-- Screen Content -->
                                <rect x="120" y="80" width="160" height="30" fill="#D2DAFF" rx="5"/>
                                <rect x="120" y="120" width="100" height="15" fill="#AAC4FF" rx="3"/>
                                <rect x="120" y="145" width="140" height="15" fill="#AAC4FF" rx="3"/>
                                
                                <!-- Image Icon -->
                                <rect x="120" y="175" width="160" height="100" fill="#B1B2FF" rx="8"/>
                                <circle cx="200" cy="215" r="15" fill="white" opacity="0.7"/>
                                <polygon points="140,245 180,205 220,245 260,215 260,260 140,260" fill="white" opacity="0.5"/>
                                
                                <!-- Button -->
                                <rect x="140" y="290" width="120" height="35" fill="#B1B2FF" rx="17.5"/>
                                <text x="200" y="313" text-anchor="middle" fill="white" font-size="14" font-weight="bold">Upload</text>
                                
                                <!-- Checkmark Icon -->
                                <circle cx="320" cy="100" r="30" fill="#4ADE80" opacity="0.9"/>
                                <polyline points="305,100 315,110 335,90" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                
                                <!-- Tools Icon -->
                                <g transform="translate(60, 320)">
                                    <path d="M10,0 L20,0 L20,30 L10,30 Z" fill="#AAC4FF"/>
                                    <circle cx="15" cy="35" r="8" fill="#AAC4FF"/>
                                </g>
                            </svg>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-6 -right-6 w-20 h-20 rounded-2xl shadow-xl flex items-center justify-center animate-bounce-slow" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-20 h-20 rounded-2xl shadow-xl flex items-center justify-center animate-bounce-slow" style="background: linear-gradient(135deg, #AAC4FF, #B1B2FF); animation-delay: 0.5s;">
                            <i class="fas fa-tools text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wide">Keunggulan</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Mengapa Memilih SiGAP Polsri?
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Platform terpercaya untuk melaporkan dan memantau perbaikan fasilitas kampus
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-primary/10" style="background: linear-gradient(135deg, #D2DAFF, #EEF1FF);">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
                        <i class="fas fa-bolt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Real-time Update</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau status laporan Anda secara langsung. Dari pending hingga selesai, semua terupdate otomatis.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-primary/10" style="background: linear-gradient(135deg, #D2DAFF, #EEF1FF);">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #AAC4FF, #B1B2FF);">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Respon Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tim teknisi kami siap menangani laporan Anda dengan cepat dan profesional 24/7.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-primary/10" style="background: linear-gradient(135deg, #D2DAFF, #EEF1FF);">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Transparan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Lihat foto sebelum dan sesudah perbaikan. Teknisi yang ditugaskan juga bisa Anda ketahui.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="cara-kerja" class="py-20 px-4" style="background: linear-gradient(135deg, #EEF1FF, #FFFFFF);">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wide">Alur Kerja</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Cara Melaporkan Kerusakan
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Hanya 4 langkah mudah untuk melaporkan kerusakan fasilitas kampus
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                <!-- Connection Lines (Hidden on mobile) -->
                <div class="hidden md:block absolute top-16 left-0 right-0 h-1 opacity-20" style="background: linear-gradient(to right, #B1B2FF, #AAC4FF, #B1B2FF);"></div>

                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="w-32 h-32 mx-auto rounded-full flex items-center justify-center mb-6 shadow-xl relative z-10" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
                        <i class="fas fa-camera text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-1/2 -translate-x-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center font-bold text-primary border-4 border-primary z-20">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Foto Kerusakan</h3>
                    <p class="text-gray-600">
                        Ambil foto kondisi kerusakan fasilitas yang ingin dilaporkan
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="w-32 h-32 mx-auto rounded-full flex items-center justify-center mb-6 shadow-xl relative z-10" style="background: linear-gradient(135deg, #AAC4FF, #B1B2FF);">
                        <i class="fas fa-upload text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-1/2 -translate-x-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center font-bold text-primary border-4 border-secondary z-20">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Upload & Isi Form</h3>
                    <p class="text-gray-600">
                        Isi detail lokasi, kategori, dan deskripsi kerusakan
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="w-32 h-32 mx-auto rounded-full flex items-center justify-center mb-6 shadow-xl relative z-10" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
                        <i class="fas fa-user-cog text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-1/2 -translate-x-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center font-bold text-primary border-4 border-primary z-20">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Teknisi Memperbaiki</h3>
                    <p class="text-gray-600">
                        Teknisi kami akan segera menangani perbaikan
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="relative text-center">
                    <div class="w-32 h-32 mx-auto rounded-full flex items-center justify-center mb-6 shadow-xl relative z-10" style="background: linear-gradient(135deg, #AAC4FF, #B1B2FF);">
                        <i class="fas fa-check-circle text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-1/2 -translate-x-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center font-bold text-primary border-4 border-secondary z-20">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Selesai!</h3>
                    <p class="text-gray-600">
                        Lihat hasil perbaikan dan foto after di dashboard Anda
                    </p>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-16">
                <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-4 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 text-lg" style="background: linear-gradient(to right, #B1B2FF, #AAC4FF);">
                    <i class="fas fa-rocket mr-2"></i>
                    Mulai Lapor Sekarang - Gratis!
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Membantu Menjaga Kampus Kita?
            </h2>
            <p class="text-xl mb-8 opacity-90">
                Bergabunglah dengan ratusan mahasiswa lainnya yang sudah menggunakan SiGAP Polsri
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary font-bold rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl border-2 border-white hover:bg-white hover:text-primary transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sudah Punya Akun
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #B1B2FF, #AAC4FF);">
                            <i class="fas fa-tools text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold">SiGAP Polsri</h3>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Sistem Gangguan & Perbaikan Politeknik Negeri Sriwijaya. Memudahkan mahasiswa melaporkan kerusakan fasilitas kampus.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Link Cepat</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('login') }}" class="hover:text-primary transition-colors">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-primary transition-colors">Daftar</a></li>
                        <li><a href="#cara-kerja" class="hover:text-primary transition-colors">Cara Kerja</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                            Palembang, Sumatera Selatan
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-primary"></i>
                            support@polsri.ac.id
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-primary"></i>
                            (0711) 123-4567
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Politeknik Negeri Sriwijaya. All rights reserved.</p>
                <p class="mt-2 text-sm">
                    Dibuat dengan <i class="fas fa-heart text-red-500"></i> untuk kampus yang lebih baik
                </p>
            </div>
        </div>
    </footer>

    <!-- Custom Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce-slow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Fix for gradient classes */
        .bg-linear-to-br {
            background: linear-gradient(135deg, var(--tw-gradient-stops, #B1B2FF, #AAC4FF));
        }
    </style>
</body>
</html>
