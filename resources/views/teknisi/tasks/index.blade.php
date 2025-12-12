@extends('layouts.app')

@section('title', 'Tugas Perbaikan')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-tasks text-primary mr-2"></i>
            Tugas Perbaikan Saya
        </h1>
        <p class="text-gray-600">Daftar tugas perbaikan yang ditugaskan kepada Anda</p>
    </div>

    <!-- Tasks Grid -->
    @if($tasks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tasks as $task)
                <div class="card hover:shadow-xl transition-shadow duration-300">
                    <!-- Priority Indicator -->
                    <div class="flex items-center justify-between mb-4">
                        @if($task->status === 'process')
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-spinner mr-1"></i>Sedang Dikerjakan
                            </span>
                        @elseif($task->status === 'done')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>Selesai
                            </span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @endif
                        <span class="text-xs text-gray-500">ID: #{{ $task->id }}</span>
                    </div>

                    <!-- Image -->
                    @if($task->image_before)
                        <div class="mb-4 -mx-6">
                            <img 
                                src="{{ asset('storage/' . $task->image_before) }}" 
                                alt="{{ $task->title }}"
                                class="w-full h-40 object-cover"
                            >
                        </div>
                    @endif

                    <!-- Title -->
                    <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $task->title }}</h3>

                    <!-- Info -->
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-600 flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-primary"></i>
                            <span>{{ $task->location }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-tag mr-2 text-primary"></i>
                            {{ $task->category }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-user mr-2 text-primary"></i>
                            Dilaporkan oleh: {{ $task->user->name }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-calendar mr-2 text-primary"></i>
                            {{ $task->created_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') }} WIB
                        </p>
                        @if($task->status === 'done' && $task->completed_at)
                        <p class="text-sm text-green-600 font-semibold flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Selesai: {{ $task->completed_at->locale('id')->isoFormat('D MMM YYYY') }}
                        </p>
                        @endif
                    </div>

                    <!-- Description Preview -->
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                        {{ Str::limit($task->description, 80) }}
                    </p>

                    <!-- Action Button -->
                    <a href="{{ route('teknisi.tasks.show', $task) }}" class="block text-center btn-primary">
                        @if($task->status === 'done')
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        @else
                            <i class="fas fa-wrench mr-2"></i> Kerjakan Tugas
                        @endif
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $tasks->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Ada Tugas</h3>
            <p class="text-gray-500">Belum ada tugas perbaikan yang ditugaskan kepada Anda</p>
        </div>
    @endif
</div>
@endsection
