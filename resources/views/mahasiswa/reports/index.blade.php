@extends('layouts.app')

@section('title', 'Riwayat Laporan')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-list text-primary mr-2"></i>
            Riwayat Laporan Saya
        </h1>
        <p class="text-gray-600">Lihat status dan detail laporan yang telah Anda buat</p>
    </div>

    <!-- Reports Grid -->
    @if($reports->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reports as $report)
                <div class="card hover:shadow-xl transition-shadow duration-300">
                    <!-- Image -->
                    @if($report->image_before)
                        <div class="mb-4 -mx-6 -mt-6">
                            <img 
                                src="{{ asset('storage/' . $report->image_before) }}" 
                                alt="{{ $report->title }}"
                                class="w-full h-48 object-cover rounded-t-xl"
                            >
                        </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="mb-3">
                        @if($report->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-clock mr-1"></i>Menunggu Validasi
                            </span>
                        @elseif($report->status === 'process')
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-spinner mr-1"></i>Sedang Diperbaiki
                            </span>
                        @elseif($report->status === 'done')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>Selesai
                            </span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $report->title }}</h3>

                    <!-- Info -->
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-600 flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-primary"></i>
                            <span>{{ $report->location }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-tag mr-2 text-primary"></i>
                            {{ $report->category }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-calendar mr-2 text-primary"></i>
                            {{ $report->created_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') }} WIB
                        </p>
                        @if($report->status === 'done' && $report->completed_at)
                        <p class="text-sm text-green-600 font-semibold flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Selesai: {{ $report->completed_at->locale('id')->isoFormat('D MMM YYYY') }}
                        </p>
                        @endif
                        @if($report->technician)
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-user-cog mr-2 text-primary"></i>
                                {{ $report->technician->name }}
                            </p>
                        @endif
                    </div>

                    <!-- Description Preview -->
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                        {{ Str::limit($report->description, 100) }}
                    </p>

                    <!-- Button -->
                    <a href="{{ route('mahasiswa.reports.show', $report) }}" class="block text-center btn-primary">
                        <i class="fas fa-eye mr-2"></i> Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $reports->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Laporan</h3>
            <p class="text-gray-500 mb-6">Anda belum membuat laporan apapun</p>
            <a href="{{ route('mahasiswa.reports.create') }}" class="inline-flex items-center btn-primary">
                <i class="fas fa-plus-circle mr-2"></i> Buat Laporan Pertama
            </a>
        </div>
    @endif
</div>
@endsection
