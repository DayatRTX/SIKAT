@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('mahasiswa.reports.index') }}" class="text-primary hover:text-secondary font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat
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
                </div>
                @if($report->status === 'done' && $report->completed_at)
                    <div class="flex items-center space-x-4 text-sm text-green-700 font-semibold">
                        <span><i class="fas fa-check-circle mr-1"></i> Diselesaikan pada: {{ $report->completed_at->translatedFormat('l, d F Y, H:i') }} WIB</span>
                        <span class="text-gray-600">({{ $report->created_at->diffForHumans($report->completed_at, true) }})</span>
                    </div>
                @endif
            </div>
            <!-- Status Badge -->
            <div>
                @if($report->status === 'pending')
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                        <i class="fas fa-clock mr-1"></i>Menunggu Validasi
                    </span>
                @elseif($report->status === 'process')
                    <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                        <i class="fas fa-spinner mr-1"></i>Sedang Diperbaiki
                    </span>
                @elseif($report->status === 'done')
                    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                        <i class="fas fa-check-circle mr-1"></i>Selesai
                    </span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
                        <i class="fas fa-times-circle mr-1"></i>Ditolak
                    </span>
                @endif
            </div>
        </div>

        <!-- Location -->
        <div class="mb-4 p-4 bg-tertiary rounded-lg">
            <p class="text-sm font-semibold text-gray-700 mb-1">
                <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Lokasi Kerusakan
            </p>
            <p class="text-gray-800">{{ $report->location }}</p>
        </div>

        <!-- Technician Info -->
        @if($report->technician)
            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                <p class="text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-user-cog mr-2 text-primary"></i> Teknisi yang Menangani
                </p>
                <p class="text-gray-800">{{ $report->technician->name }}</p>
            </div>
        @endif

        <!-- Reject Reason -->
        @if($report->status === 'rejected' && $report->reject_reason)
            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded">
                <p class="text-sm font-semibold text-red-700 mb-1">
                    <i class="fas fa-info-circle mr-2"></i> Alasan Penolakan
                </p>
                <p class="text-gray-800">{{ $report->reject_reason }}</p>
            </div>
        @endif
    </div>

    <!-- Description -->
    <div class="card mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-3">
            <i class="fas fa-align-left mr-2 text-primary"></i> Deskripsi Kerusakan
        </h2>
        <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
    </div>

    <!-- Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Before Image -->
        @if($report->image_before)
            <div class="card">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-camera mr-2 text-primary"></i> Foto Sebelum Perbaikan
                </h3>
                <img 
                    src="{{ asset('storage/' . $report->image_before) }}" 
                    alt="Foto Sebelum"
                    class="w-full rounded-lg shadow-md cursor-pointer hover:scale-105 transition-transform"
                    onclick="openImageModal(this.src)"
                >
            </div>
        @endif

        <!-- After Image -->
        @if($report->image_after)
            <div class="card">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-camera mr-2 text-green-500"></i> Foto Setelah Perbaikan
                </h3>
                <img 
                    src="{{ asset('storage/' . $report->image_after) }}" 
                    alt="Foto Sesudah"
                    class="w-full rounded-lg shadow-md cursor-pointer hover:scale-105 transition-transform"
                    onclick="openImageModal(this.src)"
                >
            </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Full Size" class="max-w-full max-h-full rounded-lg">
</div>

@push('scripts')
<script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
