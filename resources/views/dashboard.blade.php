@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Header -->
    <div class="mb-8 animate-fadeIn">
        <h1 class="text-4xl font-bold text-gray-800 mb-3 text-shadow-sm">
            Selamat Datang, <span class="gradient-text">{{ auth()->user()->name }}</span>! 👋
        </h1>
        <p class="text-gray-600 text-lg font-medium">
            @if(auth()->user()->role === 'mahasiswa')
                Kelola laporan kerusakan fasilitas kampus dengan mudah dan cepat.
            @elseif(auth()->user()->role === 'admin')
                Pantau dan kelola semua laporan kerusakan dari mahasiswa secara real-time.
            @else
                Lihat dan selesaikan tugas perbaikan yang ditugaskan kepada Anda.
            @endif
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Statistics Cards Premium -->
        <div class="lg:col-span-2 grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Total Laporan -->
            <div class="relative group rounded-3xl p-6 overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer" style="background: linear-gradient(135deg, rgba(177, 178, 255, 0.15) 0%, rgba(170, 196, 255, 0.25) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3);">
                <!-- Large Background Icon -->
                <div class="absolute -right-6 -bottom-6 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-clipboard-list text-9xl text-[#B1B2FF]"></i>
                </div>
                
                <!-- Content -->
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#B1B2FF] to-[#AAC4FF] rounded-2xl flex items-center justify-center shadow-xl mb-4 transform group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-clipboard-list text-white text-3xl"></i>
                    </div>
                    <p class="text-xs uppercase tracking-wide text-gray-600 font-bold mb-2">Total Laporan</p>
                    <h3 class="text-5xl font-extrabold bg-gradient-to-r from-[#B1B2FF] to-[#AAC4FF] bg-clip-text text-transparent">{{ $stats['total'] }}</h3>
                </div>
            </div>

            <!-- Pending -->
            <div class="relative group rounded-3xl p-6 overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer" style="background: linear-gradient(135deg, rgba(252, 211, 77, 0.15) 0%, rgba(245, 158, 11, 0.25) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3);">
                <div class="absolute -right-6 -bottom-6 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-clock text-9xl text-yellow-500"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-xl mb-4 transform group-hover:rotate-6 transition-transform duration-300" style="background: linear-gradient(135deg, #FCD34D 0%, #F59E0B 100%);">
                        <i class="fas fa-clock text-white text-3xl"></i>
                    </div>
                    <p class="text-xs uppercase tracking-wide text-gray-600 font-bold mb-2">Pending</p>
                    <h3 class="text-5xl font-extrabold text-yellow-600">{{ $stats['pending'] }}</h3>
                </div>
            </div>

            <!-- Process -->
            <div class="relative group rounded-3xl p-6 overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer" style="background: linear-gradient(135deg, rgba(96, 165, 250, 0.15) 0%, rgba(59, 130, 246, 0.25) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3);">
                <div class="absolute -right-6 -bottom-6 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-spinner text-9xl text-blue-500"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-xl mb-4 transform group-hover:rotate-6 transition-transform duration-300" style="background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);">
                        <i class="fas fa-spinner text-white text-3xl"></i>
                    </div>
                    <p class="text-xs uppercase tracking-wide text-gray-600 font-bold mb-2">Proses</p>
                    <h3 class="text-5xl font-extrabold text-blue-600">{{ $stats['process'] }}</h3>
                </div>
            </div>

            <!-- Done -->
            <div class="relative group rounded-3xl p-6 overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer" style="background: linear-gradient(135deg, rgba(74, 222, 128, 0.15) 0%, rgba(34, 197, 94, 0.25) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3);">
                <div class="absolute -right-6 -bottom-6 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-check-circle text-9xl text-green-500"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-xl mb-4 transform group-hover:rotate-6 transition-transform duration-300" style="background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%);">
                        <i class="fas fa-check-circle text-white text-3xl"></i>
                    </div>
                    <p class="text-xs uppercase tracking-wide text-gray-600 font-bold mb-2">Selesai</p>
                    <h3 class="text-5xl font-extrabold text-green-600">{{ $stats['done'] }}</h3>
                </div>
            </div>
        </div>

        <!-- Weather Widget (Floating Premium Card) -->
        <div class="relative rounded-3xl p-8 overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl" style="background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(51, 65, 85, 0.95) 100%); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1);">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-400/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                        <i class="fas fa-cloud-sun text-white"></i>
                    </div>
                    <span>Cuaca Hari Ini</span>
                </h3>
                
                <div class="text-center">
                    <div class="mb-6 transform hover:scale-110 transition-all duration-300">
                        <i class="fas fa-sun text-8xl text-yellow-400 drop-shadow-2xl"></i>
                    </div>
                    
                    <h4 class="text-6xl font-black text-white mb-3 drop-shadow-lg">{{ $weather['temp'] }}°C</h4>
                    
                    <p class="text-white/90 text-lg mb-4 font-semibold">{{ $weather['description'] }}</p>
                    
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                        <i class="fas fa-map-marker-alt mr-2 text-yellow-400"></i>
                        <span class="text-white font-medium">{{ $weather['city'] }}</span>
                    </div>
                    
                    <div class="pt-4 border-t border-white/20">
                        <div class="inline-flex items-center text-white/80">
                            <i class="fas fa-tint mr-2 text-blue-400"></i>
                            <span class="font-semibold">Kelembaban: {{ $weather['humidity'] }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="glass-strong rounded-2xl p-8 shadow-premium border border-white/50 animate-fadeIn-delay-2">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-primary rounded-xl flex items-center justify-center mr-3 shadow-premium">
                    <i class="fas fa-history text-white"></i>
                </div>
                <span>Laporan Terbaru</span>
            </h2>
            @if(auth()->user()->role === 'mahasiswa')
                <a href="{{ route('mahasiswa.reports.index') }}" class="btn-premium text-white px-6 py-3 rounded-xl font-semibold text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @elseif(auth()->user()->role === 'admin')
                <a href="{{ route('admin.reports.index') }}" class="btn-premium text-white px-6 py-3 rounded-xl font-semibold text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @else
                <a href="{{ route('teknisi.tasks.index') }}" class="btn-premium text-white px-6 py-3 rounded-xl font-semibold text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @endif
        </div>

        @if($recentReports->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="glass rounded-xl">
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 rounded-l-xl">Judul</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Lokasi</th>
                            @if(auth()->user()->role !== 'mahasiswa')
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Pelapor</th>
                            @endif
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 rounded-r-xl">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/30">
                        @foreach($recentReports as $report)
                            <tr class="hover:bg-white/30 transition-all duration-300">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $report->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ $report->location }}</td>
                                @if(auth()->user()->role !== 'mahasiswa')
                                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ $report->user->name }}</td>
                                @endif
                                <td class="px-6 py-4">
                                    @if($report->status === 'pending')
                                        <span class="px-4 py-2 glass rounded-full text-xs font-bold text-yellow-700 shadow-premium inline-flex items-center">
                                            <i class="fas fa-clock mr-2"></i>Pending
                                        </span>
                                    @elseif($report->status === 'process')
                                        <span class="px-4 py-2 glass rounded-full text-xs font-bold text-blue-700 shadow-premium inline-flex items-center">
                                            <i class="fas fa-spinner mr-2"></i>Proses
                                        </span>
                                    @elseif($report->status === 'done')
                                        <span class="px-4 py-2 glass rounded-full text-xs font-bold text-green-700 shadow-premium inline-flex items-center">
                                            <i class="fas fa-check-circle mr-2"></i>Selesai
                                        </span>
                                    @else
                                        <span class="px-4 py-2 glass rounded-full text-xs font-bold text-red-700 shadow-premium inline-flex items-center">
                                            <i class="fas fa-times-circle mr-2"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                                    {{ $report->created_at->translatedFormat('l, d F Y, H:i') }} WIB
                                    @if($report->status === 'done' && $report->completed_at)
                                        <div class="text-xs text-green-600 font-semibold mt-1">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai: {{ $report->completed_at->translatedFormat('l, d F Y, H:i') }} WIB
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gradient-primary rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-premium-lg">
                    <i class="fas fa-inbox text-white text-5xl"></i>
                </div>
                <p class="text-gray-600 font-semibold text-lg">Belum ada laporan</p>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    @if(auth()->user()->role === 'mahasiswa')
        <div class="mt-6">
            <a href="{{ route('mahasiswa.reports.create') }}" class="inline-flex items-center btn-primary">
                <i class="fas fa-plus-circle mr-2"></i>
                Buat Laporan Baru
            </a>
        </div>
    @endif
</div>
@endsection
