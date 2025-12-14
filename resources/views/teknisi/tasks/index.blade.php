@extends('layouts.app')

@section('title', 'Tugas Saya')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header - Vibrant -->
    <div class="relative glass-card rounded-2xl p-6 shadow-lg overflow-hidden">
        <!-- Decorative Gradient -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full blur-2xl -ml-10 -mb-10"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white mr-3 shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-wrench"></i>
                    </div>
                    Tugas Perbaikan
                </h1>
                <p class="text-slate-600 text-sm mt-2 ml-13">Kelola tugas perbaikan yang ditugaskan kepada Anda.</p>
            </div>
            
            <!-- Stats -->
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="px-4 py-2 bg-gradient-to-r from-cyan-100 to-blue-100 rounded-xl border border-cyan-200">
                    <span class="text-xs text-slate-600">Dikerjakan</span>
                    <p class="text-lg font-bold text-cyan-600">{{ $tasks->where('status', 'process')->count() }}</p>
                </div>
                <div class="px-4 py-2 bg-gradient-to-r from-emerald-100 to-green-100 rounded-xl border border-emerald-200">
                    <span class="text-xs text-slate-600">Selesai</span>
                    <p class="text-lg font-bold text-emerald-600">{{ $tasks->where('status', 'done')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Grid - Colorful -->
    @if($tasks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tasks as $index => $task)
                @php
                    $colors = [
                        ['from-emerald-500', 'to-teal-600', 'shadow-emerald-500/30', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-500'],
                        ['from-cyan-500', 'to-blue-600', 'shadow-blue-500/30', 'bg-cyan-100', 'text-cyan-700', 'border-cyan-500'],
                        ['from-[#B1B2FF]', 'to-[#9091EB]', 'shadow-[#4a4bcc]/30', 'bg-[#B1B2FF]', 'text-white', 'border-[#B1B2FF]'],
                        ['from-amber-500', 'to-orange-600', 'shadow-orange-500/30', 'bg-amber-100', 'text-amber-700', 'border-amber-500'],
                        ['from-[#f7f8ff]0', 'to-pink-600', 'shadow-pink-500/30', 'bg-[#eff1ff]', 'text-[#a4b0ff]', 'border-[#f7f8ff]0'],
                    ];
                    $color = $colors[$index % count($colors)];
                @endphp
                <div class="glass-card rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group relative border-t-4 {{ $color[5] }}">
                    <!-- Image -->
                    <div class="relative h-40 overflow-hidden">
                        @if($task->image_before)
                            <img src="{{ asset('storage/' . $task->image_before) }}" alt="{{ $task->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} opacity-20 flex items-center justify-center">
                                <i class="fas fa-tools text-5xl text-white/50"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            @if($task->status === 'process')
                                <span class="px-3 py-1.5 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold rounded-full shadow-lg shadow-blue-500/40">
                                    <i class="fas fa-cog fa-spin mr-1"></i> Dikerjakan
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-gradient-to-r from-emerald-400 to-green-500 text-white text-xs font-bold rounded-full shadow-lg shadow-green-500/40">
                                    <i class="fas fa-check mr-1"></i> Selesai
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold {{ $color[4] }} {{ $color[3] }} px-3 py-1 rounded-full">
                                {{ $task->category }}
                            </span>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2 py-1 rounded-md">
                                {{ $task->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-2 line-clamp-1">
                            {{ $task->title }}
                        </h3>
                        
                        <p class="text-sm text-slate-600 mb-4 line-clamp-2">
                            {{ $task->description }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-200/50">
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center text-xs text-slate-600 font-medium">
                                    <i class="fas fa-map-marker-alt mr-1.5 text-rose-400"></i>
                                    {{ Str::limit($task->location, 15) }}
                                </div>
                                <div class="flex items-center text-xs text-slate-500">
                                    <i class="fas fa-user mr-1.5"></i>
                                    {{ $task->user->name }}
                                </div>
                            </div>
                            
                            <a href="{{ route('teknisi.tasks.show', $task) }}" class="flex items-center px-4 py-2 bg-gradient-to-r {{ $color[0] }} {{ $color[1] }} text-white text-xs font-bold rounded-xl shadow-md {{ $color[2] }} hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                Lihat <i class="fas fa-arrow-right ml-1.5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($tasks->hasPages())
            <div class="mt-8">
                {{ $tasks->links() }}
            </div>
        @endif
    @else
        <div class="glass-card rounded-2xl p-12 text-center shadow-lg">
            <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30">
                <i class="fas fa-clipboard-check text-4xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Tidak Ada Tugas</h3>
            <p class="text-slate-600">Anda belum memiliki tugas perbaikan saat ini.</p>
        </div>
    @endif
</div>
@endsection
