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
            <div class="glass-strong rounded-2xl p-6 shadow-premium hover-lift border border-white/50 animate-fadeIn-delay-1">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-primary rounded-2xl flex items-center justify-center shadow-premium transform -rotate-6 hover:rotate-0 transition-all duration-300">
                            <i class="fas fa-clipboard-list text-white text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-semibold mb-1">Total Laporan</p>
                        <h3 class="text-4xl font-bold gradient-text">{{ $stats['total'] }}</h3>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="glass-strong rounded-2xl p-6 shadow-premium hover-lift border border-white/50 animate-fadeIn-delay-2">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-premium transform -rotate-6 hover:rotate-0 transition-all duration-300" style="background: linear-gradient(135deg, #FCD34D 0%, #F59E0B 100%);">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-semibold mb-1">Pending</p>
                        <h3 class="text-4xl font-bold text-yellow-600">{{ $stats['pending'] }}</h3>
                    </div>
                </div>
            </div>

            <!-- Process -->
            <div class="glass-strong rounded-2xl p-6 shadow-premium hover-lift border border-white/50 animate-fadeIn-delay-3">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-premium transform -rotate-6 hover:rotate-0 transition-all duration-300" style="background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);">
                            <i class="fas fa-spinner text-white text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-semibold mb-1">Proses</p>
                        <h3 class="text-4xl font-bold text-blue-600">{{ $stats['process'] }}</h3>
                    </div>
                </div>
            </div>

            <!-- Done -->
            <div class="glass-strong rounded-2xl p-6 shadow-premium hover-lift border border-white/50 animate-fadeIn-delay-4">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-premium transform -rotate-6 hover:rotate-0 transition-all duration-300" style="background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%);">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-semibold mb-1">Selesai</p>
                        <h3 class="text-4xl font-bold text-green-600">{{ $stats['done'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weather Widget (API Integration) -->
        <div class="glass-strong rounded-2xl p-6 shadow-premium border border-white/50 animate-fadeIn-delay-1 hover-lift">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                <div class="w-10 h-10 bg-gradient-primary rounded-xl flex items-center justify-center mr-3 shadow-premium">
                    <i class="fas fa-cloud-sun text-white"></i>
                </div>
                <span>Cuaca Hari Ini</span>
            </h3>
            <div class="text-center">
                <div class="mb-4 transform hover:scale-110 transition-all duration-300">
                    <i class="fas fa-sun text-7xl text-yellow-400 animate-pulse-glow"></i>
                </div>
                <h4 class="text-3xl font-bold gradient-text mb-2">{{ $weather['temp'] }}°C</h4>
                <p class="text-gray-700 mb-3 font-semibold">{{ $weather['description'] }}</p>
                <p class="text-sm text-gray-600 font-medium">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                    {{ $weather['city'] }}
                </p>
                <div class="mt-6 pt-4 border-t border-white/50">
                    <p class="text-sm text-gray-700 font-semibold">
                        <i class="fas fa-tint mr-2 text-blue-500"></i>
                        Kelembaban: {{ $weather['humidity'] }}%
                    </p>
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
                                    {{ $report->created_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') }} WIB
                                    @if($report->status === 'done' && $report->completed_at)
                                        <div class="text-xs text-green-600 font-semibold mt-1">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai: {{ $report->completed_at->locale('id')->isoFormat('D MMM YYYY') }}
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
