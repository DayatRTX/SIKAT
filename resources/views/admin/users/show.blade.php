@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-slate-600 hover:text-[#9a9bff] transition-colors font-bold group">
            <div class="w-8 h-8 rounded-lg bg-slate-100 group-hover:bg-gradient-to-br group-hover:from-[#f5f5ff]0 group-hover:to-[#93b5ff] flex items-center justify-center text-slate-500 group-hover:text-white transition-all mr-2">
                <i class="fas fa-arrow-left"></i>
            </div>
            Kembali
        </a>
    </div>

    @php
        $roleColors = [
            'admin' => ['from-[#B1B2FF]', 'to-[#9091EB]', 'text-white', 'bg-[#B1B2FF]', 'shadow-[#B1B2FF]/30'],
            'teknisi' => ['from-emerald-500', 'to-teal-600', 'text-emerald-700', 'bg-emerald-100', 'shadow-emerald-500/30'],
            'mahasiswa' => ['from-cyan-500', 'to-blue-600', 'text-cyan-700', 'bg-cyan-100', 'shadow-cyan-500/30'],
        ];
        $color = $roleColors[$user->role] ?? $roleColors['mahasiswa'];
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: User Profile -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Profile Card -->
            <div class="glass-card rounded-2xl p-6 shadow-lg text-center relative overflow-hidden">
                <!-- Decorative Gradient -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br {{ $color[0] }}/20 {{ $color[1] }}/20 rounded-full blur-2xl -mr-10 -mt-10"></div>
                
                <div class="relative z-10">
                    @if($user->photo)
                        <div class="w-24 h-24 rounded-2xl overflow-hidden shadow-lg {{ $color[4] }} mx-auto mb-4">
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} flex items-center justify-center text-white text-4xl font-bold shadow-lg {{ $color[4] }} mx-auto mb-4">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    
                    <h2 class="text-xl font-bold text-slate-800 mb-1">{{ $user->name }}</h2>
                    <p class="text-sm text-slate-500 mb-3">{{ $user->email }}</p>
                    
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $color[2] }} {{ $color[3] }}">
                        @if($user->role === 'admin')
                            <i class="fas fa-user-shield mr-2"></i>
                        @elseif($user->role === 'teknisi')
                            <i class="fas fa-wrench mr-2"></i>
                        @else
                            <i class="fas fa-user-graduate mr-2"></i>
                        @endif
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>

            <!-- Info Card -->
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-info-circle text-sm"></i>
                    </div>
                    Informasi Akun
                </h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <span class="text-sm text-slate-600">ID</span>
                        <span class="text-sm font-bold text-slate-800">#{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <span class="text-sm text-slate-600">Terdaftar</span>
                        <span class="text-sm font-bold text-slate-800">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <span class="text-sm text-slate-600">Terakhir Update</span>
                        <span class="text-sm font-bold text-slate-800">{{ $user->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="glass-card rounded-2xl p-6 shadow-lg space-y-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="w-full py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold rounded-xl shadow-md flex items-center justify-center hover:shadow-lg hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-edit mr-2"></i> Edit User
                </a>
                @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-rose-500 to-red-600 text-white font-bold rounded-xl shadow-md flex items-center justify-center hover:shadow-lg hover:-translate-y-0.5 transition-all">
                            <i class="fas fa-trash mr-2"></i> Hapus User
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Right: Statistics -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Report Stats (For Mahasiswa) -->
            @if($user->role === 'mahasiswa')
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white mr-3 shadow-lg shadow-cyan-500/30">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    Statistik Laporan
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 text-center border-t-4 border-slate-400">
                        <p class="text-3xl font-bold text-slate-800">{{ $reportStats['total'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Total Laporan</p>
                    </div>
                    <div class="bg-amber-50 rounded-xl p-4 text-center border-t-4 border-amber-400">
                        <p class="text-3xl font-bold text-amber-600">{{ $reportStats['pending'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Pending</p>
                    </div>
                    <div class="bg-cyan-50 rounded-xl p-4 text-center border-t-4 border-cyan-400">
                        <p class="text-3xl font-bold text-cyan-600">{{ $reportStats['process'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Proses</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 text-center border-t-4 border-emerald-400">
                        <p class="text-3xl font-bold text-emerald-600">{{ $reportStats['done'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Selesai</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Task Stats (For Teknisi) -->
            @if($user->role === 'teknisi' && $taskStats)
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white mr-3 shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-tasks"></i>
                    </div>
                    Statistik Tugas
                </h3>
                
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 text-center border-t-4 border-slate-400">
                        <p class="text-3xl font-bold text-slate-800">{{ $taskStats['total'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Total Tugas</p>
                    </div>
                    <div class="bg-cyan-50 rounded-xl p-4 text-center border-t-4 border-cyan-400">
                        <p class="text-3xl font-bold text-cyan-600">{{ $taskStats['process'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Dikerjakan</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 text-center border-t-4 border-emerald-400">
                        <p class="text-3xl font-bold text-emerald-600">{{ $taskStats['done'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Selesai</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Admin Info -->
            @if($user->role === 'admin')
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white mr-3 shadow-lg shadow-[#B1B2FF]/30">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    Hak Akses Admin
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-[#f5f5ff] rounded-xl p-4 flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-[#ebebff] flex items-center justify-center text-[#9a9bff]">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Kelola Laporan</p>
                            <p class="text-xs text-slate-500">Verifikasi & assign teknisi</p>
                        </div>
                    </div>
                    <div class="bg-[#f5f5ff] rounded-xl p-4 flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-[#ebebff] flex items-center justify-center text-[#9a9bff]">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Manajemen User</p>
                            <p class="text-xs text-slate-500">CRUD semua pengguna</p>
                        </div>
                    </div>
                    <div class="bg-[#f5f5ff] rounded-xl p-4 flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-[#ebebff] flex items-center justify-center text-[#9a9bff]">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Dashboard Admin</p>
                            <p class="text-xs text-slate-500">Statistik & monitoring</p>
                        </div>
                    </div>
                    <div class="bg-[#f5f5ff] rounded-xl p-4 flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-[#ebebff] flex items-center justify-center text-[#9a9bff]">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Pengaturan Sistem</p>
                            <p class="text-xs text-slate-500">Konfigurasi aplikasi</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Activity Timeline -->
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#f7f8ff]0 to-pink-600 flex items-center justify-center text-white mr-3 shadow-lg shadow-[#f7f8ff]0/30">
                        <i class="fas fa-history"></i>
                    </div>
                    Aktivitas Terbaru
                </h3>
                
                @if($activities && $activities->count() > 0)
                    <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                        @foreach($activities as $activity)
                            @php
                                $activityIcons = [
                                    'create_report' => ['icon' => 'fa-plus-circle', 'color' => 'from-emerald-500 to-green-600', 'bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
                                    'update_report' => ['icon' => 'fa-edit', 'color' => 'from-amber-500 to-orange-600', 'bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
                                    'validate_report' => ['icon' => 'fa-check-circle', 'color' => 'from-cyan-500 to-blue-600', 'bg' => 'bg-cyan-100', 'text' => 'text-cyan-600'],
                                    'reject_report' => ['icon' => 'fa-times-circle', 'color' => 'from-rose-500 to-red-600', 'bg' => 'bg-rose-100', 'text' => 'text-rose-600'],
                                    'assign_technician' => ['icon' => 'fa-user-plus', 'color' => 'from-[#B1B2FF] to-[#9091EB]', 'bg' => 'bg-[#ebebff]', 'text' => 'text-[#9a9bff]'],
                                    'complete_task' => ['icon' => 'fa-wrench', 'color' => 'from-emerald-500 to-teal-600', 'bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
                                    'update_profile' => ['icon' => 'fa-user-edit', 'color' => 'from-slate-500 to-slate-700', 'bg' => 'bg-slate-100', 'text' => 'text-slate-600'],
                                    'login' => ['icon' => 'fa-sign-in-alt', 'color' => 'from-[#B1B2FF] to-[#9091EB]', 'bg' => 'bg-[#ebebff]', 'text' => 'text-[#9a9bff]'],
                                ];
                                $activityStyle = $activityIcons[$activity->action] ?? ['icon' => 'fa-circle', 'color' => 'from-slate-400 to-slate-500', 'bg' => 'bg-slate-100', 'text' => 'text-slate-500'];
                            @endphp
                            <div class="flex items-start space-x-3 p-3 rounded-xl {{ $activityStyle['bg'] }} hover:shadow-md transition-all">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br {{ $activityStyle['color'] }} flex items-center justify-center text-white flex-shrink-0 shadow-md">
                                    <i class="fas {{ $activityStyle['icon'] }} text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold {{ $activityStyle['text'] }} truncate">{{ $activity->description }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-slate-400">
                        <i class="fas fa-clock text-4xl mb-3"></i>
                        <p class="text-sm font-medium">Belum ada aktivitas tercatat</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
