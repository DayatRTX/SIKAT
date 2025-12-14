@extends('layouts.app')

@section('title', 'Kelola Laporan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header - Vibrant -->
    <div class="relative glass-card rounded-2xl p-6 shadow-lg overflow-hidden">
        <!-- Decorative Gradient -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-[#f5f5ff]0/20 to-[#f5f5ff]0/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full blur-2xl -ml-10 -mb-10"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white mr-3 shadow-lg shadow-[#B1B2FF]/30">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    Panel Admin
                </h1>
                <p class="text-slate-600 text-sm mt-2 ml-13">Kelola dan verifikasi laporan kerusakan fasilitas.</p>
            </div>
            
            <!-- Stats Summary -->
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="px-4 py-2 bg-gradient-to-r from-amber-100 to-orange-100 rounded-xl border border-amber-200">
                    <span class="text-xs text-slate-600">Pending</span>
                    <p class="text-lg font-bold text-amber-600">{{ $reports->where('status', 'pending')->count() }}</p>
                </div>
                <div class="px-4 py-2 bg-gradient-to-r from-cyan-100 to-blue-100 rounded-xl border border-cyan-200">
                    <span class="text-xs text-slate-600">Proses</span>
                    <p class="text-lg font-bold text-cyan-600">{{ $reports->where('status', 'process')->count() }}</p>
                </div>
                <div class="px-4 py-2 bg-gradient-to-r from-emerald-100 to-green-100 rounded-xl border border-emerald-200">
                    <span class="text-xs text-slate-600">Selesai</span>
                    <p class="text-lg font-bold text-emerald-600">{{ $reports->where('status', 'done')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table - Colorful -->
    <div class="glass-card rounded-2xl overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] text-white">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Laporan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reports as $index => $report)
                        @php
                            $colors = [
                                ['border-violet-400', 'from-[#f5f5ff]', 'to-[#f0f4ff]'],
                                ['border-cyan-400', 'from-cyan-50', 'to-blue-50'],
                                ['border-fuchsia-400', 'from-[#f7f8ff]', 'to-pink-50'],
                                ['border-amber-400', 'from-amber-50', 'to-orange-50'],
                                ['border-emerald-400', 'from-emerald-50', 'to-teal-50'],
                            ];
                            $color = $colors[$index % count($colors)];
                        @endphp
                        <tr class="hover:bg-gradient-to-r hover:{{ $color[1] }} hover:{{ $color[2] }} transition-all duration-300 border-l-4 {{ $color[0] }} group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    @if($report->image_before)
                                        <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0 shadow-md group-hover:shadow-lg transition-shadow">
                                            <img src="{{ asset('storage/' . $report->image_before) }}" alt="{{ $report->title }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center flex-shrink-0 shadow-md">
                                            <i class="fas fa-image text-slate-400"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-bold text-slate-800 truncate text-sm">{{ $report->title }}</p>
                                        <p class="text-xs text-slate-500">oleh <span class="font-medium text-[#9a9bff]">{{ $report->user->name }}</span></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] text-white border-0 shadow-md">
                                    {{ $report->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-700 font-medium flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-rose-400"></i>
                                    {{ Str::limit($report->location, 20) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($report->status === 'pending')
                                    <span class="px-3 py-1.5 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-xs font-bold rounded-full shadow-md shadow-orange-500/30">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                @elseif($report->status === 'process')
                                    <span class="px-3 py-1.5 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold rounded-full shadow-md shadow-blue-500/30">
                                        <i class="fas fa-cog fa-spin mr-1"></i> Proses
                                    </span>
                                @elseif($report->status === 'done')
                                    <span class="px-3 py-1.5 bg-gradient-to-r from-emerald-400 to-green-500 text-white text-xs font-bold rounded-full shadow-md shadow-green-500/30">
                                        <i class="fas fa-check mr-1"></i> Selesai
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 bg-gradient-to-r from-rose-400 to-red-500 text-white text-xs font-bold rounded-full shadow-md shadow-red-500/30">
                                        <i class="fas fa-times mr-1"></i> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded-md font-medium">
                                    {{ $report->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.reports.show', $report) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#6567dd] to-[#5658cc] text-white text-xs font-bold rounded-xl shadow-md shadow-[#B1B2FF]/30 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="w-20 h-20 bg-gradient-to-br from-[#6567dd] to-[#5658cc] rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-[#B1B2FF]/30">
                                    <i class="fas fa-inbox text-3xl text-white"></i>
                                </div>
                                <p class="text-slate-800 font-bold text-lg">Belum Ada Laporan</p>
                                <p class="text-slate-500 text-sm mt-1">Semua laporan akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($reports->hasPages())
        <div class="mt-6">
            {{ $reports->links() }}
        </div>
    @endif
</div>
@endsection
