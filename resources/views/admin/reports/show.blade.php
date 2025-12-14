@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center text-slate-600 hover:text-[#9a9bff] transition-colors font-bold group">
            <div class="w-8 h-8 rounded-lg bg-slate-100 group-hover:bg-gradient-to-br group-hover:from-[#f5f5ff]0 group-hover:to-[#9a9bff] flex items-center justify-center text-slate-500 group-hover:text-white transition-all mr-2">
                <i class="fas fa-arrow-left"></i>
            </div>
            Kembali ke Daftar
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header Card -->
            <div class="glass-card rounded-2xl p-6 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-[#f5f5ff]0/10 to-[#f5f5ff]0/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="inline-block px-3 py-1.5 bg-gradient-to-r from-[#6567dd] to-[#5658cc] text-white text-xs font-bold rounded-full shadow-md mb-3">
                                {{ $report->category }}
                            </span>
                            <h1 class="text-2xl font-bold text-slate-800">{{ $report->title }}</h1>
                        </div>
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

                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-4">
                        <p class="text-slate-700 font-medium">{{ $report->description }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3 text-sm">
                        <div class="flex items-center bg-[#eff1ff] text-[#a4b0ff] px-3 py-2 rounded-xl font-bold">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $report->location }}
                        </div>
                        <div class="flex items-center bg-cyan-100 text-cyan-700 px-3 py-2 rounded-xl font-bold">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ $report->created_at->translatedFormat('d F Y') }}
                        </div>
                        <div class="flex items-center bg-[#eff1ff] text-[#a4b0ff] px-3 py-2 rounded-xl font-bold">
                            <i class="fas fa-user mr-2"></i>
                            {{ $report->user->name }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="glass-card rounded-2xl p-4 shadow-lg border-t-4 border-[#B1B2FF]">
                    <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white mr-2 shadow-md">
                            <i class="fas fa-camera text-sm"></i>
                        </div>
                        Foto Kerusakan
                    </h3>
                    @if($report->image_before)
                        <div class="rounded-xl overflow-hidden shadow-lg group relative">
                            <img src="{{ asset('storage/' . $report->image_before) }}" alt="Before" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                            <span class="text-slate-400 text-sm font-medium">Tidak ada foto</span>
                        </div>
                    @endif
                </div>

                @if($report->status === 'done' && $report->image_after)
                <div class="glass-card rounded-2xl p-4 shadow-lg border-t-4 border-emerald-500">
                    <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white mr-2 shadow-md">
                            <i class="fas fa-check-double text-sm"></i>
                        </div>
                        Foto Perbaikan
                    </h3>
                    <div class="rounded-xl overflow-hidden shadow-lg group relative">
                        <img src="{{ asset('storage/' . $report->image_after) }}" alt="After" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Right: Actions & Info -->
        <div class="space-y-6">
            <!-- Action Panel -->
            @if($report->status === 'pending')
            <div class="glass-card rounded-2xl p-6 shadow-lg border-t-4 border-amber-500">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-tasks text-sm"></i>
                    </div>
                    Verifikasi
                </h3>

                <!-- Assign Technician -->
                <form action="{{ route('admin.reports.assign', $report) }}" method="POST" class="mb-4">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        <i class="fas fa-user-cog mr-1 text-cyan-500"></i> Pilih Teknisi
                    </label>
                    <select name="technician_id" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all outline-none font-medium text-slate-800" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach($technicians as $tech)
                            <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full mt-3 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-cyan-500/30 transition-all hover:-translate-y-0.5">
                        <i class="fas fa-check mr-2"></i> Tugaskan
                    </button>
                </form>

                <div class="relative text-center my-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <span class="relative bg-white px-3 text-xs text-slate-500 font-medium">ATAU</span>
                </div>

                <!-- Reject -->
                <form action="{{ route('admin.reports.reject', $report) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        <i class="fas fa-comment-slash mr-1 text-rose-500"></i> Alasan Penolakan
                    </label>
                    <textarea name="reject_reason" rows="2" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all outline-none font-medium text-slate-800 resize-none" placeholder="Masukkan alasan..." required></textarea>
                    <button type="submit" class="w-full mt-3 py-3 bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg shadow-rose-500/30 transition-all hover:-translate-y-0.5">
                        <i class="fas fa-times mr-2"></i> Tolak
                    </button>
                </form>
            </div>
            @endif

            <!-- Technician Info -->
            @if($report->technician)
            <div class="glass-card rounded-2xl p-6 shadow-lg border-t-4 border-cyan-500">
                <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white mr-2 shadow-md">
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

            <!-- Timeline -->
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#f7f8ff]0 to-pink-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-history text-sm"></i>
                    </div>
                    Riwayat
                </h3>
                
                <div class="relative pl-6 border-l-4 border-slate-200 space-y-6">
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-[#6567dd] to-[#5658cc] border-4 border-white shadow"></div>
                        <div class="bg-[#f5f5ff] rounded-xl p-3">
                            <h4 class="text-sm font-bold text-[#a4b0ff]">Dilaporkan</h4>
                            <p class="text-xs text-slate-600">{{ $report->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>

                    @if($report->status === 'process' || $report->status === 'done')
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 border-4 border-white shadow"></div>
                        <div class="bg-cyan-50 rounded-xl p-3">
                            <h4 class="text-sm font-bold text-cyan-700">Dikerjakan</h4>
                            <p class="text-xs text-slate-600">{{ $report->technician->name ?? '-' }}</p>
                        </div>
                    </div>
                    @endif

                    @if($report->status === 'done')
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 border-4 border-white shadow"></div>
                        <div class="bg-emerald-50 rounded-xl p-3">
                            <h4 class="text-sm font-bold text-emerald-700">Selesai</h4>
                            <p class="text-xs text-slate-600">{{ \Carbon\Carbon::parse($report->completed_at)->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($report->status === 'rejected')
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-5 h-5 rounded-full bg-gradient-to-br from-rose-500 to-red-600 border-4 border-white shadow"></div>
                        <div class="bg-rose-50 rounded-xl p-3">
                            <h4 class="text-sm font-bold text-rose-700">Ditolak</h4>
                            <p class="text-xs text-rose-600">{{ $report->reject_reason }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
