@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-slate-600 hover:text-[#9a9bff] transition-colors font-bold group">
            <div class="w-8 h-8 rounded-lg bg-slate-100 group-hover:bg-gradient-to-br group-hover:from-[#f5f5ff]0 group-hover:to-[#93b5ff] flex items-center justify-center text-slate-500 group-hover:text-white transition-all mr-2">
                <i class="fas fa-arrow-left"></i>
            </div>
            Kembali
        </a>
    </div>

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 via-orange-500 to-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-orange-500/30">
            <i class="fas fa-user-edit text-2xl text-white"></i>
        </div>
        <h1 class="text-3xl font-bold gradient-text mb-2">Edit User</h1>
        <p class="text-slate-600">Perbarui data pengguna <span class="font-bold text-[#9a9bff]">{{ $user->name }}</span></p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-8 shadow-xl relative overflow-hidden">
        <!-- Decorative Gradient -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-amber-500/10 to-rose-500/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-cyan-500/10 to-blue-500/10 rounded-full blur-2xl -ml-16 -mb-16"></div>
        
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            @method('PUT')

            <!-- User Avatar Preview -->
            <div class="flex justify-center mb-6">
                @php
                    $roleColors = [
                        'admin' => 'from-[#6567dd] to-[#5658cc]',
                        'teknisi' => 'from-emerald-500 to-teal-600',
                        'mahasiswa' => 'from-cyan-500 to-blue-600',
                    ];
                    $avatarColor = $roleColors[$user->role] ?? $roleColors['mahasiswa'];
                @endphp
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br {{ $avatarColor }} flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            </div>

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-user mr-2 text-[#f5f5ff]0"></i>Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                    class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#f5f5ff]0/20 focus:border-[#f5f5ff]0 transition-all outline-none placeholder-slate-400 font-medium text-slate-800" 
                    placeholder="Masukkan nama lengkap" required>
                @error('name') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-envelope mr-2 text-cyan-500"></i>Email <span class="text-rose-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                    class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all outline-none placeholder-slate-400 font-medium text-slate-800" 
                    placeholder="email@example.com" required>
                @error('email') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-user-tag mr-2 text-[#f7f8ff]0"></i>Role <span class="text-rose-500">*</span>
                </label>
                <select id="role" name="role" 
                    class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-[#f7f8ff]0/20 focus:border-[#f7f8ff]0 transition-all outline-none cursor-pointer font-medium text-slate-800" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>🛡️ Admin</option>
                    <option value="teknisi" {{ old('role', $user->role) == 'teknisi' ? 'selected' : '' }}>🔧 Teknisi</option>
                    <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>🎓 Mahasiswa</option>
                </select>
                @error('role') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <!-- Password Section -->
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                <p class="text-sm text-amber-700 font-medium mb-3">
                    <i class="fas fa-info-circle mr-1"></i> Kosongkan password jika tidak ingin mengubahnya
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">
                            <i class="fas fa-lock mr-2 text-amber-500"></i>Password Baru
                        </label>
                        <input type="password" id="password" name="password" 
                            class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none placeholder-slate-400 font-medium text-slate-800" 
                            placeholder="Minimal 8 karakter">
                        @error('password') <p class="text-rose-500 text-xs mt-2 font-medium"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">
                            <i class="fas fa-lock mr-2 text-emerald-500"></i>Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                            class="w-full px-4 py-3.5 bg-white/80 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none placeholder-slate-400 font-medium text-slate-800" 
                            placeholder="Ulangi password">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex gap-4">
                <a href="{{ route('admin.users.index') }}" class="flex-1 py-4 bg-slate-200 text-slate-700 font-bold rounded-xl text-center hover:bg-slate-300 transition-all text-lg">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="flex-1 py-4 bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 hover:from-amber-600 hover:via-orange-600 hover:to-rose-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/40 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl text-lg">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
