@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Welcome Header - Vibrant -->
    <div class="relative glass-card rounded-2xl p-6 shadow-lg animate-fadeIn overflow-hidden">
        <!-- Decorative Gradient Blobs -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-[#f5f5ff]0/20 to-[#f7f8ff]0/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full blur-2xl -ml-10 -mb-10"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Selamat Datang, <span class="gradient-text">{{ auth()->user()->name }}</span>! 👋
                </h1>
                <p class="text-slate-600 text-sm mt-1">
                    @if(auth()->user()->role === 'mahasiswa')
                        Kelola laporan kerusakan fasilitas kampus dengan mudah.
                    @elseif(auth()->user()->role === 'admin')
                        Pantau dan kelola semua laporan kerusakan.
                    @else
                        Lihat dan selesaikan tugas perbaikan Anda.
                    @endif
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-full text-sm font-bold text-white shadow-lg shadow-[#B1B2FF]/30">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Grid - Colorful Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Laporan - Purple -->
        <div class="glass-card rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 group border-l-4 border-[#B1B2FF]">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] flex items-center justify-center text-white shadow-lg shadow-[#B1B2FF]/40 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <i class="fas fa-clipboard-list text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total</p>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['total'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending - Orange/Amber -->
        <div class="glass-card rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 group border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-lg shadow-orange-500/40 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pending</p>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['pending'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses - Cyan/Blue -->
        <div class="glass-card rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 group border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white shadow-lg shadow-blue-500/40 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <i class="fas fa-cog fa-spin text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Proses</p>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['process'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai - Emerald/Green -->
        <div class="glass-card rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 group border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/40 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Selesai</p>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['done'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Reports List -->
        <div class="lg:col-span-2 glass-card rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-slate-200/50 bg-gradient-to-r from-[#B1B2FF]/5 to-cyan-500/5 flex justify-between items-center">
                <h2 class="text-lg font-bold text-slate-800 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] flex items-center justify-center text-white mr-3 shadow-md">
                        <i class="fas fa-history text-sm"></i>
                    </div>
                    Laporan Terbaru
                </h2>
                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.reports.index') }}" class="px-4 py-2 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                @else
                    <a href="{{ route('teknisi.tasks.index') }}" class="px-4 py-2 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                @endif
            </div>
            
            <div class="divide-y divide-slate-100">
                @forelse($recentReports as $report)
                    <a href="{{ auth()->user()->role === 'mahasiswa' ? route('mahasiswa.reports.show', $report) : (auth()->user()->role === 'admin' ? route('admin.reports.show', $report) : route('teknisi.tasks.show', $report)) }}" class="block p-4 hover:bg-gradient-to-r hover:from-[#f5f5ff]/50 hover:to-cyan-50/50 transition-all duration-300 group">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 flex-1 min-w-0">
                                <!-- Status Icon -->
                                <div class="flex-shrink-0">
                                    @if($report->status === 'pending')
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-md shadow-orange-500/30">
                                            <i class="fas fa-clock text-lg"></i>
                                        </div>
                                    @elseif($report->status === 'process')
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white shadow-md shadow-blue-500/30">
                                            <i class="fas fa-cog fa-spin text-lg"></i>
                                        </div>
                                    @elseif($report->status === 'done')
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/30">
                                            <i class="fas fa-check text-lg"></i>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-400 to-red-500 flex items-center justify-center text-white shadow-md shadow-red-500/30">
                                            <i class="fas fa-times text-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-sm font-bold text-slate-800 truncate group-hover:text-[#9a9bff] transition-colors">
                                            {{ $report->title }}
                                        </h3>
                                        <span class="text-xs font-medium text-slate-500 whitespace-nowrap ml-2 bg-slate-100 px-2 py-1 rounded-md">
                                            {{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('d M, H:i') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-xs text-slate-600 space-x-3">
                                        <span class="flex items-center bg-[#ebebff] text-[#8384ff] px-2 py-0.5 rounded-md font-medium">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ Str::limit($report->location, 20) }}
                                        </span>
                                        @if($report->status === 'done' && $report->completed_at)
                                            <span class="flex items-center text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-md font-bold">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ \Carbon\Carbon::parse($report->completed_at)->translatedFormat('d M, H:i') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Arrow -->
                            <div class="ml-4 flex-shrink-0">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 group-hover:bg-gradient-to-br group-hover:from-[#f5f5ff]0 group-hover:to-[#93b5ff] flex items-center justify-center text-slate-400 group-hover:text-white transition-all duration-300">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center mb-4">
                            <i class="fas fa-inbox text-3xl text-slate-400"></i>
                        </div>
                        <p class="text-slate-500 font-medium">Belum ada laporan terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Weather Widget - Dark Vibrant -->
        <div class="bg-gradient-to-br from-slate-900 via-violet-900 to-slate-900 rounded-2xl p-6 text-white shadow-2xl relative overflow-hidden group">
            <!-- Decorative Blobs -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-[#f7f8ff]0/30 to-pink-500/30 rounded-full blur-3xl -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/30 to-blue-500/30 rounded-full blur-2xl -ml-10 -mb-10"></div>
            <div class="absolute top-1/2 left-1/2 w-20 h-20 bg-gradient-to-br from-yellow-500/20 to-orange-500/20 rounded-full blur-xl transform -translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-xl font-bold flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center mr-3 shadow-lg">
                                <i class="fas fa-map-marker-alt text-sm"></i>
                            </span>
                            {{ $weather['city'] }}
                        </h3>
                        <p class="text-slate-400 text-sm mt-2">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-2xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                        <i class="fas fa-cloud-sun text-2xl text-white"></i>
                    </div>
                </div>
                
                <div class="flex items-end justify-between">
                    <div>
                        <div class="text-6xl font-extrabold mb-1 tracking-tighter bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">{{ $weather['temp'] }}°</div>
                        <p class="text-slate-300 font-semibold capitalize text-lg">{{ $weather['description'] }}</p>
                    </div>
                    <div class="text-right bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="text-lg font-bold text-cyan-400 mb-1">
                            <i class="fas fa-tint mr-1"></i> {{ $weather['humidity'] }}%
                        </div>
                        <div class="text-xs text-slate-400 font-medium">Kelembaban</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
