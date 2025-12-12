@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('teknisi.tasks.index') }}" class="text-primary hover:text-secondary font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Tugas
        </a>
    </div>

    <!-- Header -->
    <div class="card mb-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $report->title }}</h1>
                <div class="flex items-center space-x-4 text-sm text-gray-600 mb-2">
                    <span><i class="fas fa-calendar mr-1"></i> {{ $report->created_at->translatedFormat('l, d F Y, H:i') }} WIB</span>
                    <span><i class="fas fa-tag mr-1"></i> {{ $report->category }}</span>
                    <span><i class="fas fa-hashtag mr-1"></i> ID: {{ $report->id }}</span>
                </div>
                @if($report->status === 'done' && $report->completed_at)
                    <div class="flex items-center space-x-4 text-sm text-green-700 font-semibold">
                        <span><i class="fas fa-check-circle mr-1"></i> Diselesaikan pada: {{ $report->completed_at->translatedFormat('l, d F Y, H:i') }} WIB</span>
                        <span class="text-gray-600">({{ $report->created_at->diffForHumans($report->completed_at, true) }})</span>
                    </div>
                @endif
            </div>
            <!-- Status -->
            @if($report->status === 'process')
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                    <i class="fas fa-spinner mr-1"></i>Sedang Dikerjakan
                </span>
            @elseif($report->status === 'done')
                <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    <i class="fas fa-check-circle mr-1"></i>Selesai
                </span>
            @else
                <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                    <i class="fas fa-clock mr-1"></i>Pending
                </span>
            @endif
        </div>

        <div class="space-y-4">
            <!-- Reporter -->
            <div class="p-4 bg-tertiary rounded-lg">
                <p class="text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-user mr-2 text-primary"></i> Pelapor
                </p>
                <p class="text-gray-800">{{ $report->user->name }}</p>
            </div>

            <!-- Location -->
            <div class="p-4 bg-tertiary rounded-lg">
                <p class="text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Lokasi
                </p>
                <p class="text-gray-800">{{ $report->location }}</p>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="card mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-3">
            <i class="fas fa-align-left mr-2 text-primary"></i> Deskripsi Kerusakan
        </h2>
        <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
    </div>

    <!-- Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Before Image -->
        @if($report->image_before)
            <div class="card">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-camera mr-2 text-primary"></i> Foto Kondisi Kerusakan
                </h3>
                <img 
                    src="{{ asset('storage/' . $report->image_before) }}" 
                    alt="Before"
                    class="w-full rounded-lg shadow-md"
                >
            </div>
        @endif

        <!-- After Image -->
        @if($report->image_after)
            <div class="card">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-camera mr-2 text-green-500"></i> Foto Hasil Perbaikan
                </h3>
                <img 
                    src="{{ asset('storage/' . $report->image_after) }}" 
                    alt="After"
                    class="w-full rounded-lg shadow-md"
                >
            </div>
        @endif
    </div>

    <!-- Complete Task Form (Only if not done) -->
    @if($report->status !== 'done')
        <div class="card bg-gradient-to-br from-tertiary to-background">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-check-double mr-2 text-primary"></i> Selesaikan Perbaikan
            </h3>
            <p class="text-gray-600 mb-6">Upload foto hasil perbaikan untuk menyelesaikan tugas ini</p>

            <form action="{{ route('teknisi.tasks.complete', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Upload After Image -->
                <div>
                    <label for="image_after" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-camera mr-1"></i> Foto Hasil Perbaikan <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-primary rounded-lg p-6 text-center hover:border-secondary transition-all">
                        <input 
                            type="file" 
                            id="image_after" 
                            name="image_after" 
                            accept="image/*"
                            class="hidden"
                            onchange="previewAfterImage(event)"
                            required
                        >
                        <label for="image_after" class="cursor-pointer">
                            <div id="after-preview-container" class="mb-4 hidden">
                                <img id="after-preview" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg shadow-md">
                            </div>
                            <div id="after-upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-5xl text-primary mb-3"></i>
                                <p class="text-gray-700 font-semibold mb-1">Klik untuk upload foto hasil</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG (Max 2MB)</p>
                            </div>
                        </label>
                    </div>
                    @error('image_after')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-check-circle mr-2"></i> Tandai Selesai
                </button>
            </form>
        </div>
    @else
        <!-- Completed Message -->
        <div class="card bg-green-50 border-2 border-green-500">
            <div class="text-center py-6">
                <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tugas Selesai!</h3>
                <p class="text-gray-600">Perbaikan telah diselesaikan pada {{ $report->completed_at ? $report->completed_at->translatedFormat('l, d F Y, H:i') : $report->updated_at->translatedFormat('l, d F Y, H:i') }} WIB</p>
                @if($report->completed_at)
                    <p class="text-gray-500 text-sm mt-2">Durasi pengerjaan: {{ $report->created_at->diffForHumans($report->completed_at, true) }}</p>
                @endif
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function previewAfterImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('after-preview').src = e.target.result;
                document.getElementById('after-preview-container').classList.remove('hidden');
                document.getElementById('after-upload-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
