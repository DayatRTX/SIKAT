@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-gradient-to-br from-[#6567dd] via-[#5658cc] to-[#4a4bcc] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-[#4a4bcc]/30">
            <i class="fas fa-edit text-2xl text-white"></i>
        </div>
        <h1 class="text-3xl font-bold gradient-text mb-2">Buat Laporan Baru</h1>
        <p class="text-slate-600">Sampaikan keluhan fasilitas kampus dengan detail.</p>
    </div>

    <!-- Form Card - Vibrant -->
    <div class="glass-card rounded-2xl p-8 shadow-xl relative overflow-hidden">
        <!-- Decorative Gradient -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-[#f5f5ff]0/10 to-[#f7f8ff]0/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/10 to-blue-500/10 rounded-full blur-2xl -ml-16 -mb-16"></div>
        
        <form action="{{ route('mahasiswa.reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
            @csrf

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-heading mr-2 text-[#f5f5ff]0"></i>Judul Laporan <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" 
                    class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#f5f5ff]0/20 focus:border-[#f5f5ff]0 transition-all outline-none placeholder-slate-400 font-medium text-slate-800" 
                    placeholder="Contoh: AC Ruang 301 Bocor" required>
                @error('title') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Lokasi -->
                <div>
                    <label for="location" class="block text-sm font-bold text-slate-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-cyan-500"></i>Lokasi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" 
                        class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all outline-none placeholder-slate-400 font-medium text-slate-800" 
                        placeholder="Gedung, Lantai, Ruangan" required>
                    @error('location') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-bold text-slate-700 mb-2">
                        <i class="fas fa-tag mr-2 text-[#f7f8ff]0"></i>Kategori <span class="text-rose-500">*</span>
                    </label>
                    <select id="category" name="category" 
                        class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#f7f8ff]0/20 focus:border-[#f7f8ff]0 transition-all outline-none cursor-pointer font-medium text-slate-800" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Listrik" {{ old('category') == 'Listrik' ? 'selected' : '' }}>⚡ Listrik</option>
                        <option value="AC" {{ old('category') == 'AC' ? 'selected' : '' }}>❄️ AC / Pendingin</option>
                        <option value="Furniture" {{ old('category') == 'Furniture' ? 'selected' : '' }}>🪑 Furniture</option>
                        <option value="Proyektor" {{ old('category') == 'Proyektor' ? 'selected' : '' }}>📽️ Proyektor</option>
                        <option value="Toilet" {{ old('category') == 'Toilet' ? 'selected' : '' }}>🚽 Toilet</option>
                        <option value="Pintu/Jendela" {{ old('category') == 'Pintu/Jendela' ? 'selected' : '' }}>🚪 Pintu / Jendela</option>
                        <option value="Jaringan" {{ old('category') == 'Jaringan' ? 'selected' : '' }}>📡 Jaringan / WiFi</option>
                        <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                    </select>
                    @error('category') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-align-left mr-2 text-amber-500"></i>Deskripsi Detail <span class="text-rose-500">*</span>
                </label>
                <textarea id="description" name="description" rows="4" 
                    class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none placeholder-slate-400 resize-none font-medium text-slate-800" 
                    placeholder="Jelaskan kerusakan yang terjadi..." required>{{ old('description') }}</textarea>
                @error('description') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <!-- Drag & Drop Image Upload - Colorful -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-camera mr-2 text-emerald-500"></i>Foto Bukti (Wajib)
                </label>
                <div class="relative group">
                    <input type="file" id="image_before" name="image_before" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewImage(this)">
                    <div class="w-full h-44 border-3 border-dashed border-emerald-300 rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50 flex flex-col items-center justify-center transition-all group-hover:border-emerald-500 group-hover:bg-gradient-to-br group-hover:from-emerald-100 group-hover:to-teal-100" id="drop-zone">
                        <div id="preview-container" class="hidden w-full h-full p-3">
                            <img id="preview-img" src="#" alt="Preview" class="w-full h-full object-contain rounded-xl">
                        </div>
                        <div id="upload-placeholder" class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-3 text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                                <i class="fas fa-cloud-upload-alt text-2xl"></i>
                            </div>
                            <p class="text-sm text-slate-700 font-bold">Klik atau seret foto ke sini</p>
                            <p class="text-xs text-slate-500 mt-1">JPG, PNG (Max 2MB)</p>
                        </div>
                    </div>
                </div>
                @error('image_before') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button - Gradient -->
            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#6567dd] via-[#5658cc] to-[#4a4bcc] hover:from-[#5658cc] hover:via-[#4a4bcc] hover:to-[#3e3fbb] text-white font-bold rounded-xl shadow-lg shadow-[#4a4bcc]/40 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl text-lg">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan
                </button>
            </div>
        </form>
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
