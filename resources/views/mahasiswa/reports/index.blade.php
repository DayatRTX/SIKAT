@extends('layouts.app')

@section('title', 'Riwayat Laporan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header - Vibrant -->
    <div class="relative glass-card rounded-2xl p-6 shadow-lg overflow-hidden">
        <!-- Decorative Gradient -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-[#f7f8ff]0/20 to-pink-500/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full blur-2xl -ml-10 -mb-10"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white mr-3 shadow-lg shadow-[#4a4bcc]/30">
                        <i class="fas fa-history"></i>
                    </div>
                    Riwayat Laporan
                </h1>
                <p class="text-slate-600 text-sm mt-2 ml-13">Kelola dan pantau status laporan kerusakan Anda.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('mahasiswa.reports.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#6567dd] via-[#5658cc] to-[#4a4bcc] hover:from-[#5658cc] hover:via-[#4a4bcc] hover:to-[#3e3fbb] text-white text-sm font-bold rounded-xl shadow-lg shadow-[#4a4bcc]/40 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i> Buat Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- Reports Grid - Colorful Masonry -->
    @if($reports->count() > 0)
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
            @foreach($reports as $index => $report)
                @php
                    $colors = [
                        ['from-[#B1B2FF]', 'to-[#9091EB]', 'shadow-[#4a4bcc]/30', 'bg-[#B1B2FF]', 'text-white', 'border-[#B1B2FF]'],
                        ['from-cyan-500', 'to-blue-600', 'shadow-blue-500/30', 'bg-cyan-100', 'text-cyan-700', 'border-cyan-500'],
                        ['from-[#f7f8ff]0', 'to-pink-600', 'shadow-pink-500/30', 'bg-[#eff1ff]', 'text-[#a4b0ff]', 'border-[#f7f8ff]0'],
                        ['from-amber-500', 'to-orange-600', 'shadow-orange-500/30', 'bg-amber-100', 'text-amber-700', 'border-amber-500'],
                        ['from-emerald-500', 'to-teal-600', 'shadow-teal-500/30', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-500'],
                    ];
                    $color = $colors[$index % count($colors)];
                @endphp
                <div class="break-inside-avoid glass-card rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group relative border-t-4 {{ $color[5] }}">
                    <!-- Image & Overlay -->
                    <div class="relative h-48 overflow-hidden">
                        @if($report->image_before)
                            <img src="{{ asset('storage/' . $report->image_before) }}" alt="{{ $report->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} opacity-20 flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-white/50"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badge - Vibrant -->
                        <div class="absolute top-3 right-3">
                            @if($report->status === 'pending')
                                <span class="px-3 py-1.5 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-xs font-bold rounded-full shadow-lg shadow-orange-500/40">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                            @elseif($report->status === 'process')
                                <span class="px-3 py-1.5 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold rounded-full shadow-lg shadow-blue-500/40">
                                    <i class="fas fa-cog fa-spin mr-1"></i> Proses
                                </span>
                            @elseif($report->status === 'done')
                                <span class="px-3 py-1.5 bg-gradient-to-r from-emerald-400 to-green-500 text-white text-xs font-bold rounded-full shadow-lg shadow-green-500/40">
                                    <i class="fas fa-check mr-1"></i> Selesai
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-gradient-to-r from-rose-400 to-red-500 text-white text-xs font-bold rounded-full shadow-lg shadow-red-500/40">
                                    <i class="fas fa-times mr-1"></i> Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold {{ $color[4] }} {{ $color[3] }} px-3 py-1 rounded-full">
                                {{ $report->category }}
                            </span>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2 py-1 rounded-md">
                                {{ $report->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-2 line-clamp-1 group-hover:gradient-text transition-all duration-300">
                            {{ $report->title }}
                        </h3>
                        
                        <p class="text-sm text-slate-600 mb-4 line-clamp-2">
                            {{ $report->description }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-200/50">
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center text-xs text-slate-600 font-medium">
                                    <i class="fas fa-map-marker-alt mr-1.5 {{ $color[4] }}"></i>
                                    {{ Str::limit($report->location, 15) }}
                                </div>
                                @if($report->status === 'done' && $report->completed_at)
                                    <div class="flex items-center text-xs text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md">
                                        <i class="fas fa-check-circle mr-1.5"></i>
                                        {{ \Carbon\Carbon::parse($report->completed_at)->format('d M Y') }}
                                    </div>
                                @endif
                            </div>
                            
                            <a href="{{ route('mahasiswa.reports.show', $report) }}" class="flex items-center px-4 py-2 bg-gradient-to-r {{ $color[0] }} {{ $color[1] }} text-white text-xs font-bold rounded-xl shadow-md {{ $color[2] }} hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                Detail <i class="fas fa-arrow-right ml-1.5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $reports->links() }}
        </div>
    @else
        <div class="glass-card rounded-2xl p-12 text-center shadow-lg">
            <div class="w-24 h-24 bg-gradient-to-br from-[#6567dd] to-[#5658cc] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-[#4a4bcc]/30">
                <i class="fas fa-folder-open text-4xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Belum Ada Laporan</h3>
            <p class="text-slate-600 mb-6">Anda belum membuat laporan kerusakan apapun.</p>
            <a href="{{ route('mahasiswa.reports.create') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-[#6567dd] via-[#5658cc] to-[#4a4bcc] text-white text-sm font-bold rounded-xl shadow-lg shadow-[#4a4bcc]/40 transition-all duration-300 hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Buat Laporan Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
