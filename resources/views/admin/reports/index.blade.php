@extends('layouts.app')

@section('title', 'Kelola Laporan')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-clipboard-list text-primary mr-2"></i>
            Kelola Laporan Kerusakan
        </h1>
        <p class="text-gray-600">Validasi dan tugaskan laporan kepada teknisi</p>
    </div>

    <!-- Filter -->
    <div class="card mb-6">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex items-center space-x-4">
            <div class="flex-1">
                <select name="status" class="input-field" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="process" {{ request('status') === 'process' ? 'selected' : '' }}>Proses</option>
                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Selesai</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            @if(request('status'))
                <a href="{{ route('admin.reports.index') }}" class="text-sm text-gray-600 hover:text-primary">
                    <i class="fas fa-times mr-1"></i> Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Reports Table -->
    @if($reports->count() > 0)
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-tertiary">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Judul</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pelapor</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Lokasi</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kategori</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Teknisi</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($reports as $report)
                            <tr class="hover:bg-tertiary/30 transition-colors">
                                <td class="px-4 py-3 text-sm font-mono text-gray-600">#{{ $report->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ Str::limit($report->title, 30) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $report->user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($report->location, 20) }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 bg-tertiary text-gray-700 rounded text-xs">
                                        {{ $report->category }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($report->status === 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                            Pending
                                        </span>
                                    @elseif($report->status === 'process')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                            Proses
                                        </span>
                                    @elseif($report->status === 'done')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $report->technician ? $report->technician->name : '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.reports.show', $report) }}" class="text-primary hover:text-secondary font-semibold text-sm">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $reports->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Ada Laporan</h3>
            <p class="text-gray-500">Belum ada laporan yang masuk atau sesuai filter</p>
        </div>
    @endif
</div>
@endsection
