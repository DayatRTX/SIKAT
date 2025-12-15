@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="relative glass-card rounded-2xl p-6 shadow-lg overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-[#B1B2FF]/15 to-[#D2DAFF]/15 rounded-full blur-3xl -mr-10 -mt-10"></div>
        
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-slate-800 flex items-center">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] flex items-center justify-center text-white mr-3 shadow-lg shadow-[#B1B2FF]/30">
                    <i class="fas fa-user"></i>
                </div>
                Profil Saya
            </h1>
            <p class="text-slate-600 text-sm mt-2 ml-13">Kelola informasi akun dan aktivitas Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-sm animate-fadeIn">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-emerald-500 text-xl mr-3"></i>
                <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl shadow-sm animate-fadeIn">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle text-rose-500 text-xl mr-3"></i>
                <p class="text-rose-700 font-bold">Terdapat kesalahan:</p>
            </div>
            <ul class="list-disc list-inside text-rose-600 ml-8 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="glass-card rounded-2xl p-6 shadow-lg text-center">
                <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="photo-form">
                    @csrf
                    <div class="relative inline-block group">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg border-4 border-white">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] flex items-center justify-center text-white shadow-lg mx-auto border-4 border-white">
                                <span class="text-4xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <label for="photo" class="absolute bottom-0 right-1/2 transform translate-x-16 w-10 h-10 bg-[#B1B2FF] rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-[#9091EB] transition-all shadow-lg">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="document.getElementById('photo-form').submit()">
                    </div>
                </form>
                
                <h3 class="text-xl font-bold text-slate-800 mt-4">{{ $user->name }}</h3>
                <p class="text-sm text-slate-500">{{ $user->email }}</p>
                
                <div class="mt-4 inline-block">
                    @if($user->role === 'admin')
                        <span class="px-4 py-2 bg-gradient-to-r from-[#B1B2FF] to-[#9091EB] text-white text-xs font-bold rounded-full shadow-md">
                            <i class="fas fa-shield-alt mr-1"></i> Admin
                        </span>
                    @elseif($user->role === 'teknisi')
                        <span class="px-4 py-2 bg-gradient-to-r from-emerald-400 to-teal-500 text-white text-xs font-bold rounded-full shadow-md">
                            <i class="fas fa-wrench mr-1"></i> Teknisi
                        </span>
                    @else
                        <span class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold rounded-full shadow-md">
                            <i class="fas fa-user-graduate mr-1"></i> Mahasiswa
                        </span>
                    @endif
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    <p>Bergabung: {{ $user->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-chart-bar text-sm"></i>
                    </div>
                    Statistik
                </h3>
                
                <div class="space-y-3">
                    @if($user->role === 'mahasiswa')
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Total Laporan</span>
                            <span class="text-sm font-bold text-slate-800">{{ $stats['total_reports'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Pending</span>
                            <span class="text-sm font-bold text-amber-600">{{ $stats['pending'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Proses</span>
                            <span class="text-sm font-bold text-cyan-600">{{ $stats['process'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Selesai</span>
                            <span class="text-sm font-bold text-emerald-600">{{ $stats['done'] }}</span>
                        </div>
                    @elseif($user->role === 'teknisi')
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Total Tugas</span>
                            <span class="text-sm font-bold text-slate-800">{{ $stats['total_tasks'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Sedang Dikerjakan</span>
                            <span class="text-sm font-bold text-cyan-600">{{ $stats['in_progress'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Selesai</span>
                            <span class="text-sm font-bold text-emerald-600">{{ $stats['completed'] }}</span>
                        </div>
                    @else
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Total User</span>
                            <span class="text-sm font-bold text-slate-800">{{ $stats['total_users'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Total Laporan</span>
                            <span class="text-sm font-bold text-slate-800">{{ $stats['total_reports'] }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                            <span class="text-sm text-slate-600">Pending</span>
                            <span class="text-sm font-bold text-amber-600">{{ $stats['pending_reports'] }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-edit text-sm"></i>
                    </div>
                    Edit Profil
                </h3>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#B1B2FF]/20 focus:border-[#B1B2FF] transition-all outline-none font-medium text-slate-800" 
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#B1B2FF]/20 focus:border-[#B1B2FF] transition-all outline-none font-medium text-slate-800" 
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru (Opsional)</label>
                            <input type="password" name="password" 
                                class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#B1B2FF]/20 focus:border-[#B1B2FF] transition-all outline-none font-medium text-slate-800" 
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" 
                                class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#B1B2FF]/20 focus:border-[#B1B2FF] transition-all outline-none font-medium text-slate-800" 
                                placeholder="Ulangi password baru">
                        </div>

                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] hover:from-[#9091EB] hover:via-[#8081D9] hover:to-[#7071C9] text-white font-bold rounded-xl shadow-lg shadow-[#B1B2FF]/40 transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="glass-card rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-pink-600 flex items-center justify-center text-white mr-2 shadow-md">
                        <i class="fas fa-history text-sm"></i>
                    </div>
                    Aktivitas Terbaru
                </h3>

                @if($activityLogs->count() > 0)
                    <div class="space-y-3">
                        @foreach($activityLogs as $log)
                            <div class="flex items-start space-x-3 bg-slate-50 p-3 rounded-xl hover:bg-slate-100 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br 
                                    @if(str_contains($log->action, 'created')) from-cyan-400 to-blue-500
                                    @elseif(str_contains($log->action, 'updated')) from-amber-400 to-orange-500
                                    @elseif(str_contains($log->action, 'completed')) from-emerald-400 to-green-500
                                    @elseif(str_contains($log->action, 'rejected')) from-rose-400 to-red-500
                                    @else from-violet-400 to-purple-500
                                    @endif
                                    flex items-center justify-center text-white shadow-md flex-shrink-0">
                                    <i class="fas 
                                        @if(str_contains($log->action, 'created')) fa-plus
                                        @elseif(str_contains($log->action, 'updated') || str_contains($log->action, 'photo')) fa-edit
                                        @elseif(str_contains($log->action, 'completed')) fa-check
                                        @elseif(str_contains($log->action, 'rejected')) fa-times
                                        @elseif(str_contains($log->action, 'assigned')) fa-user-cog
                                        @else fa-bolt
                                        @endif
                                        text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-slate-800">{{ $log->description }}</p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        <i class="far fa-clock mr-1"></i>
                                        {{ $log->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-history text-slate-300 text-3xl"></i>
                        </div>
                        <p class="text-slate-500">Belum ada aktivitas</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
