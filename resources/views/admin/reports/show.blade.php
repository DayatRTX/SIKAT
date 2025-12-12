@extends('layouts.app')

@section('title', 'Detail Laporan - Admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.reports.index') }}" class="text-primary hover:text-secondary font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Report Info -->
            <div class="card">
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
                                <span class="text-gray-600">(Durasi: {{ $report->created_at->diffForHumans($report->completed_at, true) }})</span>
                            </div>
                        @endif
                    </div>
                    <!-- Status -->
                    @if($report->status === 'pending')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-clock mr-1"></i>Pending
                        </span>
                    @elseif($report->status === 'process')
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-spinner mr-1"></i>Proses
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

                <div class="space-y-4">
                    <!-- Reporter -->
                    <div class="p-4 bg-tertiary rounded-lg">
                        <p class="text-sm font-semibold text-gray-700 mb-1">
                            <i class="fas fa-user mr-2 text-primary"></i> Pelapor
                        </p>
                        <p class="text-gray-800">{{ $report->user->name }} ({{ $report->user->email }})</p>
                    </div>

                    <!-- Location -->
                    <div class="p-4 bg-tertiary rounded-lg">
                        <p class="text-sm font-semibold text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Lokasi
                        </p>
                        <p class="text-gray-800">{{ $report->location }}</p>
                    </div>

                    <!-- Technician -->
                    @if($report->technician)
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm font-semibold text-gray-700 mb-1">
                                <i class="fas fa-user-cog mr-2 text-primary"></i> Teknisi yang Ditugaskan
                            </p>
                            <p class="text-gray-800">{{ $report->technician->name }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="card">
                <h2 class="text-lg font-bold text-gray-800 mb-3">
                    <i class="fas fa-align-left mr-2 text-primary"></i> Deskripsi Kerusakan
                </h2>
                <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
            </div>

            <!-- Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($report->image_before)
                    <div class="card">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-camera mr-2 text-primary"></i> Foto Sebelum
                        </h3>
                        <img 
                            src="{{ asset('storage/' . $report->image_before) }}" 
                            alt="Before"
                            class="w-full rounded-lg shadow-md"
                        >
                    </div>
                @endif

                @if($report->image_after)
                    <div class="card">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-camera mr-2 text-green-500"></i> Foto Sesudah
                        </h3>
                        <img 
                            src="{{ asset('storage/' . $report->image_after) }}" 
                            alt="After"
                            class="w-full rounded-lg shadow-md"
                        >
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="space-y-6">
            <!-- Validate Report (Only for Pending) -->
            @if($report->status === 'pending')
                <div class="card">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-check-double mr-2 text-primary"></i> Validasi Laporan
                    </h3>
                    
                    <!-- Accept Form -->
                    <form action="{{ route('admin.reports.validate', $report) }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="action" value="accept">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition-all">
                            <i class="fas fa-check mr-2"></i> Terima Laporan
                        </button>
                    </form>

                    <!-- Reject Form -->
                    <form action="{{ route('admin.reports.validate', $report) }}" method="POST" id="rejectForm">
                        @csrf
                        <input type="hidden" name="action" value="reject">
                        <textarea 
                            name="reject_reason" 
                            class="input-field mb-3" 
                            rows="3"
                            placeholder="Alasan penolakan..."
                            required
                        ></textarea>
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-all">
                            <i class="fas fa-times mr-2"></i> Tolak Laporan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Assign Technician (For Accepted/Pending Reports) -->
            @if($report->status !== 'rejected' && $report->status !== 'done')
                <div class="card">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-user-cog mr-2 text-primary"></i> Tugaskan Teknisi
                    </h3>
                    <form action="{{ route('admin.reports.assign', $report) }}" method="POST">
                        @csrf
                        <select name="technician_id" class="input-field mb-4" required>
                            <option value="">Pilih Teknisi</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}" {{ $report->technician_id == $tech->id ? 'selected' : '' }}>
                                    {{ $tech->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full btn-primary">
                            <i class="fas fa-user-plus mr-2"></i> Tugaskan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Report Summary -->
            <div class="card bg-tertiary">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Lapor:</span>
                        <span class="font-semibold">{{ $report->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    @if($report->completed_at)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Diselesaikan:</span>
                        <span class="font-semibold text-green-600">{{ $report->completed_at->translatedFormat('d F Y') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kategori:</span>
                        <span class="font-semibold">{{ $report->category }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-semibold capitalize">{{ $report->status }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
