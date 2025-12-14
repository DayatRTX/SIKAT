@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('mahasiswa.reports.index') }}" class="inline-flex items-center text-slate-600 hover:text-[#9a9bff] transition-colors font-bold group">
            <div class="w-8 h-8 rounded-lg bg-slate-100 group-hover:bg-gradient-to-br group-hover:from-[#f5f5ff]0 group-hover:to-[#93b5ff] flex items-center justify-center text-slate-500 group-hover:text-white transition-all mr-2">
                <i class="fas fa-arrow-left"></i>
            </div>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Photos & Description -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Main Info Card -->
            <div class="glass-card rounded-2xl p-6 shadow-lg relative overflow-hidden">
                <!-- Decorative Gradient -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-[#f5f5ff]0/10 to-[#f7f8ff]0/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="inline-block px-3 py-1.5 bg-gradient-to-r from-[#6567dd] to-[#5658cc] text-white text-xs font-bold rounded-full shadow-md mb-3">
                                {{ $report->category }}
                            </span>
                            <h1 class="text-2xl font-bold text-slate-800">{{ $report->title }}</h1>
                        </div>
                        <!-- Status Badge -->
                        <div>
                            @if($report->status === 'pending')
                                <span class="px-4 py-2 bg-gradient-to-r from-amber-400 to-orange-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-orange-500/30">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                            @elseif($report->status === 'process')
                                <span class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30">
                                    <i class="fas fa-cog fa-spin mr-1"></i> Proses
                                </span>
                            @elseif($report->status === 'done')
                                <span class="px-4 py-2 bg-gradient-to-r from-emerald-400 to-green-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-green-500/30">
                                    <i class="fas fa-check-circle mr-1"></i> Selesai
                                </span>
                            @else
                                <span class="px-4 py-2 bg-gradient-to-r from-rose-400 to-red-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-500/30">
                                    <i class="fas fa-times mr-1"></i> Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="prose max-w-none text-slate-700 mb-6 bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <p class="font-medium">{{ $report->description }}</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <div class="flex items-center bg-[#eff1ff] text-[#a4b0ff] px-4 py-2 rounded-xl font-bold">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $report->location }}
                        </div>
                        <div class="flex items-center bg-cyan-100 text-cyan-700 px-4 py-2 rounded-xl font-bold">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ $report->created_at->translatedFormat('l, d F Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photos - Colorful -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Before -->
                <div class="glass-card rounded-2xl p-4 shadow-lg border-t-4 border-[#B1B2FF]">
                    <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white mr-2 shadow-md">
                            <i class="fas fa-camera text-sm"></i>
                        </div>
                        Foto Kerusakan
                    </h3>
                    @if($report->image_before)
                        <div class="rounded-xl overflow-hidden shadow-lg group relative">
                            <img src="{{ asset('storage/' . $report->image_before) }}" alt="Before" class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    @else
                        <div class="h-64 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                            <div class="text-center text-slate-400">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <p class="text-sm font-medium">Tidak ada foto</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- After -->
                @if($report->status === 'done' && $report->image_after)
                <div class="glass-card rounded-2xl p-4 shadow-lg border-t-4 border-emerald-500">
                    <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white mr-2 shadow-md">
                            <i class="fas fa-check-double text-sm"></i>
                        </div>
                        Foto Perbaikan
                    </h3>
                    <div class="rounded-xl overflow-hidden shadow-lg group relative">
                        <img src="{{ asset('storage/' . $report->image_after) }}" alt="After" class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Timeline & Details -->
        <div class="space-y-6">
            <!-- Timeline - Colorful -->
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#f7f8ff]0 to-pink-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-history text-sm"></i>
                    </div>
                    Riwayat Status
                </h3>
                
                <div class="relative pl-6 border-l-4 border-gradient-to-b from-[#f5f5ff]0 via-cyan-500 to-emerald-500 space-y-8">
                    <!-- Created -->
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-[#6567dd] to-[#5658cc] border-4 border-white shadow-lg"></div>
                        <div class="bg-[#f5f5ff] rounded-xl p-3 border border-[#ebebff]">
                            <h4 class="text-sm font-bold text-[#a4b0ff]">Laporan Dibuat</h4>
                            <p class="text-xs text-slate-600 mt-1">{{ $report->created_at->translatedFormat('d F Y, H:i') }}</p>
                            <p class="text-xs text-slate-500 mt-1">Menunggu verifikasi admin</p>
                        </div>
                    </div>

                    <!-- Process -->
                    @if($report->status === 'process' || $report->status === 'done')
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 border-4 border-white shadow-lg"></div>
                        <div class="bg-cyan-50 rounded-xl p-3 border border-cyan-100">
                            <h4 class="text-sm font-bold text-cyan-700">Sedang Dikerjakan</h4>
                            <p class="text-xs text-slate-600 mt-1">
                                @if($report->technician)
                                    Oleh: {{ $report->technician->name }}
                                @else
                                    Teknisi sedang menuju lokasi
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Done -->
                    @if($report->status === 'done')
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 border-4 border-white shadow-lg"></div>
                        <div class="bg-emerald-50 rounded-xl p-3 border border-emerald-100">
                            <h4 class="text-sm font-bold text-emerald-700">Selesai</h4>
                            <p class="text-xs text-slate-600 mt-1">{{ \Carbon\Carbon::parse($report->completed_at)->translatedFormat('d F Y, H:i') }}</p>
                            <p class="text-xs text-emerald-600 font-bold mt-1">
                                <i class="fas fa-check mr-1"></i> Masalah Teratasi
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Rejected -->
                    @if($report->status === 'rejected')
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-rose-500 to-red-600 border-4 border-white shadow-lg"></div>
                        <div class="bg-rose-50 rounded-xl p-3 border border-rose-100">
                            <h4 class="text-sm font-bold text-rose-700">Ditolak</h4>
                            <p class="text-xs text-rose-600 mt-1">{{ $report->reject_reason }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Technician Info -->
            @if($report->technician)
            <div class="glass-card rounded-2xl p-6 shadow-lg border-t-4 border-amber-500">
                <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-user-cog text-sm"></i>
                    </div>
                    Teknisi Bertugas
                </h3>
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white shadow-lg text-lg font-bold">
                        {{ strtoupper(substr($report->technician->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-lg">{{ $report->technician->name }}</p>
                        <p class="text-xs text-slate-500">{{ $report->technician->email }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
