@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header - Vibrant -->
    <div class="relative glass-card rounded-2xl p-6 shadow-lg overflow-hidden">
        <!-- Decorative Gradient -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-[#B1B2FF]/15 to-[#D2DAFF]/15 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full blur-2xl -ml-10 -mb-10"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] flex items-center justify-center text-white mr-3 shadow-lg shadow-[#B1B2FF]/30">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    Manajemen User
                </h1>
                <p class="text-slate-600 text-sm mt-2 ml-13">Kelola semua akun pengguna sistem SIKAT Polsri.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] hover:from-[#5658cc] hover:via-[#4a4bcc] hover:to-[#3e3fbb] text-white text-sm font-bold rounded-xl shadow-lg shadow-[#4a4bcc]/40 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i> Tambah User
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="glass-card rounded-2xl p-4 shadow-lg border-l-4 border-slate-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase">Total User</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-500 to-slate-700 flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-4 shadow-lg border-l-4 border-[#B1B2FF]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase">Admin</p>
                    <p class="text-2xl font-bold text-[#9a9bff] mt-1">{{ $stats['admin'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#6567dd] to-[#5658cc] flex items-center justify-center text-white shadow-lg shadow-[#B1B2FF]/30">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-4 shadow-lg border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase">Teknisi</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $stats['teknisi'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-wrench"></i>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-4 shadow-lg border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase">Mahasiswa</p>
                    <p class="text-2xl font-bold text-cyan-600 mt-1">{{ $stats['mahasiswa'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white shadow-lg shadow-cyan-500/30">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-300 text-emerald-700 px-4 py-3 rounded-xl flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-100 border border-rose-300 text-rose-700 px-4 py-3 rounded-xl flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="glass-card rounded-2xl p-4 shadow-lg">
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full pl-10 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#f5f5ff]0/20 focus:border-[#B1B2FF] transition-all outline-none font-medium text-slate-800" 
                        placeholder="Cari nama atau email...">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>
            </div>
            <div class="w-full md:w-48">
                <select name="role" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#f5f5ff]0/20 focus:border-[#B1B2FF] transition-all outline-none font-medium text-slate-800">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="teknisi" {{ request('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                    <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#6567dd] to-[#5658cc] text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all whitespace-nowrap">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-300 transition-all text-center whitespace-nowrap">
                        <i class="fas fa-times mr-2"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users - Desktop Table / Mobile Cards -->
    
    <!-- Mobile Card View -->
    <div class="lg:hidden space-y-4">
        @forelse($users as $user)
            @php
                $roleColors = [
                    'admin' => ['from-[#B1B2FF]', 'to-[#9091EB]', 'text-white', 'bg-[#B1B2FF]', 'border-violet-400'],
                    'teknisi' => ['from-emerald-500', 'to-teal-600', 'text-emerald-700', 'bg-emerald-100', 'border-emerald-400'],
                    'mahasiswa' => ['from-cyan-500', 'to-blue-600', 'text-cyan-700', 'bg-cyan-100', 'border-cyan-400'],
                ];
                $color = $roleColors[$user->role] ?? $roleColors['mahasiswa'];
            @endphp
            <div class="glass-card rounded-2xl p-4 shadow-lg border-l-4 {{ $color[4] }}">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} flex items-center justify-center text-white font-bold shadow-md text-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-slate-800 truncate">
                            {{ $user->name }}
                            @if($user->id === auth()->id())
                                <span class="text-xs text-[#9a9bff] font-medium">(Anda)</span>
                            @endif
                        </p>
                        <p class="text-sm text-slate-500 truncate">{{ $user->email }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-2 text-xs mb-3">
                    <div class="bg-slate-50 rounded-lg p-2">
                        <span class="text-slate-500">Role</span>
                        <p class="font-bold flex items-center mt-0.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold {{ $color[2] }} {{ $color[3] }}">
                                @if($user->role === 'admin')
                                    <i class="fas fa-user-shield mr-1"></i>
                                @elseif($user->role === 'teknisi')
                                    <i class="fas fa-wrench mr-1"></i>
                                @else
                                    <i class="fas fa-user-graduate mr-1"></i>
                                @endif
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-2">
                        <span class="text-slate-500">Terdaftar</span>
                        <p class="font-bold text-slate-700">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-end space-x-2">
                    <a href="{{ route('admin.users.show', $user) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-cyan-100 text-cyan-600 rounded-xl hover:bg-cyan-200 transition-all font-bold text-sm">
                        <i class="fas fa-eye mr-1"></i> Lihat
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-amber-100 text-amber-600 rounded-xl hover:bg-amber-200 transition-all font-bold text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-rose-100 text-rose-600 rounded-xl hover:bg-rose-200 transition-all font-bold text-sm">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="glass-card rounded-2xl p-8 text-center shadow-lg">
                <div class="w-20 h-20 bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-[#B1B2FF]/30">
                    <i class="fas fa-users text-3xl text-white"></i>
                </div>
                <p class="text-slate-800 font-bold text-lg">Tidak Ada User</p>
                <p class="text-slate-500 text-sm mt-1">Belum ada user yang terdaftar.</p>
            </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block glass-card rounded-2xl overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] text-white">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $index => $user)
                        @php
                            $roleColors = [
                                'admin' => ['from-[#B1B2FF]', 'to-[#9091EB]', 'text-white', 'bg-[#B1B2FF]', 'border-violet-400'],
                                'teknisi' => ['from-emerald-500', 'to-teal-600', 'text-emerald-700', 'bg-emerald-100', 'border-emerald-400'],
                                'mahasiswa' => ['from-cyan-500', 'to-blue-600', 'text-cyan-700', 'bg-cyan-100', 'border-cyan-400'],
                            ];
                            $color = $roleColors[$user->role] ?? $roleColors['mahasiswa'];
                        @endphp
                        <tr class="hover:bg-gradient-to-r hover:from-[#f5f5ff] hover:to-[#f0f4ff] transition-all duration-300 border-l-4 {{ $color[4] }} group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} flex items-center justify-center text-white font-bold shadow-md">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">{{ $user->name }}</p>
                                        @if($user->id === auth()->id())
                                            <span class="text-xs text-[#9a9bff] font-medium">(Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 font-medium">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $color[2] }} {{ $color[3] }}">
                                    @if($user->role === 'admin')
                                        <i class="fas fa-user-shield mr-1"></i>
                                    @elseif($user->role === 'teknisi')
                                        <i class="fas fa-wrench mr-1"></i>
                                    @else
                                        <i class="fas fa-user-graduate mr-1"></i>
                                    @endif
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded-md font-medium">
                                    {{ $user->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="p-2 bg-cyan-100 text-cyan-600 rounded-lg hover:bg-cyan-200 transition-all" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2 bg-amber-100 text-amber-600 rounded-lg hover:bg-amber-200 transition-all" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-rose-100 text-rose-600 rounded-lg hover:bg-rose-200 transition-all" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="w-20 h-20 bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-[#B1B2FF]/30">
                                    <i class="fas fa-users text-3xl text-white"></i>
                                </div>
                                <p class="text-slate-800 font-bold text-lg">Tidak Ada User</p>
                                <p class="text-slate-500 text-sm mt-1">Belum ada user yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="mt-6">
            {{ $users->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
