@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('teknisi.tasks.index') }}" class="inline-flex items-center text-slate-600 hover:text-emerald-600 transition-colors font-bold group">
            <div class="w-8 h-8 rounded-lg bg-slate-100 group-hover:bg-gradient-to-br group-hover:from-emerald-500 group-hover:to-teal-600 flex items-center justify-center text-slate-500 group-hover:text-white transition-all mr-2">
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
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="inline-block px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-xs font-bold rounded-full shadow-md mb-3">
                                {{ $report->category }}
                            </span>
                            <h1 class="text-2xl font-bold text-slate-800">{{ $report->title }}</h1>
                        </div>
                        @if($report->status === 'process')
                            <span class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30">
                                <i class="fas fa-cog fa-spin mr-1"></i> Dalam Proses
                            </span>
                        @else
                            <span class="px-4 py-2 bg-gradient-to-r from-emerald-400 to-green-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-green-500/30">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @endif
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-4">
                        <p class="text-slate-700 font-medium">{{ $report->description }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3 text-sm">
                        <div class="flex items-center bg-emerald-100 text-emerald-700 px-3 py-2 rounded-xl font-bold">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $report->location }}
                        </div>
                        <div class="flex items-center bg-cyan-100 text-cyan-700 px-3 py-2 rounded-xl font-bold">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ $report->created_at->translatedFormat('d F Y') }}
                        </div>
                        <div class="flex items-center bg-[#ebebff] text-white px-3 py-2 rounded-xl font-bold">
                            <i class="fas fa-user mr-2"></i>
                            {{ $report->user->name }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Before -->
                <div class="glass-card rounded-2xl p-4 shadow-lg border-t-4 border-rose-500">
                    <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center text-white mr-2 shadow-md">
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

                <!-- After -->
                <div class="glass-card rounded-2xl p-4 shadow-lg border-t-4 border-emerald-500">
                    <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white mr-2 shadow-md">
                            <i class="fas fa-check-double text-sm"></i>
                        </div>
                        Foto Perbaikan
                    </h3>
                    @if($report->image_after)
                        <div class="rounded-xl overflow-hidden shadow-lg group relative">
                            <img src="{{ asset('storage/' . $report->image_after) }}" alt="After" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                            <span class="text-slate-400 text-sm font-medium">Belum ada foto</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right: Action Panel -->
        <div class="space-y-6">
            <!-- Complete Task Form -->
            @if($report->status === 'process')
            <div class="glass-card rounded-2xl p-6 shadow-lg border-t-4 border-emerald-500">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white mr-3 shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    Selesaikan Tugas
                </h3>

                <form action="{{ route('teknisi.tasks.complete', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <!-- Upload Photo -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            <i class="fas fa-camera mr-1 text-emerald-500"></i> Foto Hasil Perbaikan <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative group">
                            <input type="file" id="image_after" name="image_after" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewImage(this)" required>
                            <div class="w-full h-36 border-3 border-dashed border-emerald-300 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50 flex flex-col items-center justify-center transition-all group-hover:border-emerald-500" id="drop-zone">
                                <div id="preview-container" class="hidden w-full h-full p-2">
                                    <img id="preview-img" src="#" alt="Preview" class="w-full h-full object-contain rounded-lg">
                                </div>
                                <div id="upload-placeholder" class="text-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center mx-auto mb-2 text-white shadow-md group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-xl"></i>
                                    </div>
                                    <p class="text-xs text-slate-700 font-bold">Upload foto hasil</p>
                                    <p class="text-xs text-slate-500">JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                        </div>
                        @error('image_after') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            <i class="fas fa-sticky-note mr-1 text-amber-500"></i> Catatan (Opsional)
                        </label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none font-medium text-slate-800 resize-none" placeholder="Catatan perbaikan..."></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/40 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl text-lg">
                        <i class="fas fa-check-circle mr-2"></i> Tandai Selesai
                    </button>
                </form>
            </div>
            @else
            <!-- Completion Info -->
            <div class="glass-card rounded-2xl p-6 shadow-lg border-t-4 border-emerald-500">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-check-double text-2xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Tugas Selesai!</h3>
                    <p class="text-sm text-slate-600 mb-4">Diselesaikan pada:</p>
                    <div class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-xl font-bold text-sm inline-block">
                        {{ \Carbon\Carbon::parse($report->completed_at)->translatedFormat('l, d F Y H:i') }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Reporter Info -->
            <div class="glass-card rounded-2xl p-6 shadow-lg border-t-4 border-[#B1B2FF]">
                <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    Pelapor
                </h3>
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white shadow-lg text-lg font-bold">
                        {{ strtoupper(substr($report->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-lg">{{ $report->user->name }}</p>
                        <p class="text-xs text-slate-500">{{ $report->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-info-circle text-sm"></i>
                    </div>
                    Informasi Singkat
                </h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <span class="text-sm text-slate-600">Kategori</span>
                        <span class="text-sm font-bold text-slate-800">{{ $report->category }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <span class="text-sm text-slate-600">Lokasi</span>
                        <span class="text-sm font-bold text-slate-800">{{ $report->location }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <span class="text-sm text-[#a4b0ff] font-bold">Dilaporkan</span>
                        <span class="text-sm font-bold text-slate-800">{{ $report->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const container = document.getElementById('preview-container');
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }
</script>
@endsection
