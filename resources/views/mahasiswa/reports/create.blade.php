@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8 animate-fadeIn">
        <h1 class="text-4xl font-bold text-gray-800 mb-3 text-shadow-sm">
            <span class="gradient-text">Buat Laporan Kerusakan</span> ✍️
        </h1>
        <p class="text-gray-600 text-lg font-medium">Laporkan kerusakan atau gangguan fasilitas kampus dengan cepat dan mudah</p>
    </div>

    <!-- Form Card Glassmorphism -->
    <div class="glass-strong rounded-3xl p-8 shadow-premium-lg border-glow animate-fadeIn-delay-1">
        <form action="{{ route('mahasiswa.reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Judul Laporan -->
            <div class="relative">
                <label for="title" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-heading mr-2 text-primary"></i> Judul Laporan <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}"
                    class="w-full px-5 py-4 glass rounded-xl border border-white/50 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 font-medium text-gray-800 placeholder-gray-400 @error('title') border-red-500 ring-4 ring-red-500/20 @enderror" 
                    placeholder="Contoh: Lampu Ruang Kelas Mati"
                    required
                >
                @error('title')
                    <p class="text-red-600 text-sm mt-2 font-semibold flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="relative">
                <label for="location" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Lokasi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="location" 
                    name="location" 
                    value="{{ old('location') }}"
                    class="w-full px-5 py-4 glass rounded-xl border border-white/50 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 font-medium text-gray-800 placeholder-gray-400 @error('location') border-red-500 ring-4 ring-red-500/20 @enderror" 
                    placeholder="Contoh: Gedung A - Ruang 201"
                    required
                >
                @error('location')
                    <p class="text-red-600 text-sm mt-2 font-semibold flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="relative">
                <label for="category" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-tags mr-2 text-primary"></i> Kategori Kerusakan <span class="text-red-500">*</span>
                </label>
                <select 
                    id="category" 
                    name="category" 
                    class="w-full px-5 py-4 glass rounded-xl border border-white/50 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 font-medium text-gray-800 cursor-pointer @error('category') border-red-500 ring-4 ring-red-500/20 @enderror"
                    required
                >
                    <option value="">Pilih Kategori</option>
                    <option value="Listrik" {{ old('category') === 'Listrik' ? 'selected' : '' }}>⚡ Listrik</option>
                    <option value="AC" {{ old('category') === 'AC' ? 'selected' : '' }}>❄️ AC / Pendingin Ruangan</option>
                    <option value="Furniture" {{ old('category') === 'Furniture' ? 'selected' : '' }}>🪑 Furniture (Meja/Kursi)</option>
                    <option value="Proyektor" {{ old('category') === 'Proyektor' ? 'selected' : '' }}>📽️ Proyektor / LCD</option>
                    <option value="Toilet" {{ old('category') === 'Toilet' ? 'selected' : '' }}>🚽 Toilet / Sanitasi</option>
                    <option value="Pintu/Jendela" {{ old('category') === 'Pintu/Jendela' ? 'selected' : '' }}>🚪 Pintu / Jendela</option>
                    <option value="Jaringan" {{ old('category') === 'Jaringan' ? 'selected' : '' }}>📡 Jaringan / WiFi</option>
                    <option value="Lainnya" {{ old('category') === 'Lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                </select>
                @error('category')
                    <p class="text-red-600 text-sm mt-2 font-semibold flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="relative">
                <label for="description" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-align-left mr-2 text-primary"></i> Deskripsi Kerusakan <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    class="w-full px-5 py-4 glass rounded-xl border border-white/50 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 font-medium text-gray-800 placeholder-gray-400 resize-none @error('description') border-red-500 ring-4 ring-red-500/20 @enderror" 
                    placeholder="Jelaskan kondisi kerusakan secara detail..."
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-2 font-semibold flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Foto Premium -->
            <div class="relative">
                <label for="image_before" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-camera mr-2 text-primary"></i> Foto Bukti Kerusakan <span class="text-red-500">*</span>
                </label>
                <div class="glass border-2 border-dashed border-primary/30 rounded-2xl p-8 text-center hover:border-primary hover:shadow-premium-lg transition-all duration-300 group">
                    <input 
                        type="file" 
                        id="image_before" 
                        name="image_before" 
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(event)"
                        required
                    >
                    <label for="image_before" class="cursor-pointer">
                        <div id="preview-container" class="mb-4 hidden">
                            <img id="preview" src="" alt="Preview" class="max-h-80 mx-auto rounded-2xl shadow-premium-lg ring-4 ring-white/50">
                        </div>
                        <div id="upload-placeholder" class="group-hover:scale-105 transition-transform duration-300">
                            <div class="w-20 h-20 bg-gradient-primary rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-premium group-hover:shadow-premium-lg transform group-hover:rotate-6 transition-all duration-300">
                                <i class="fas fa-cloud-upload-alt text-white text-4xl"></i>
                            </div>
                            <p class="text-gray-800 font-bold mb-2 text-lg">Klik untuk upload foto</p>
                            <p class="text-sm text-gray-600 font-medium">Format: JPG, PNG (Max 2MB)</p>
                        </div>
                    </label>
                </div>
                @error('image_before')
                    <p class="text-red-600 text-sm mt-2 font-semibold flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-white/30">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 glass-strong rounded-xl text-gray-700 hover:bg-white/60 font-bold transition-all duration-300 hover-lift shadow-premium inline-flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn-premium text-white font-bold py-4 px-8 rounded-xl text-lg shadow-premium-lg hover-lift inline-flex items-center">
                    <i class="fas fa-paper-plane mr-3"></i> Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
