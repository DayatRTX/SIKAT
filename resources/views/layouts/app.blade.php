<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIKAT Polsri') - Sistem Informasi Kerusakan Aset dan Tindak lanjut</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/icon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#EEF1FF] via-[#D2DAFF] to-[#AAC4FF]">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
        <!-- Sidebar Desktop & Mobile -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:sticky lg:top-0 lg:translate-x-0 inset-y-0 left-0 z-50 w-72 h-screen sidebar-glass shadow-2xl transition-transform duration-300 ease-in-out flex flex-col"
        >
            <!-- Logo & Brand - Vibrant -->
            <div class="p-6 border-b border-white/30 relative overflow-hidden">
                <!-- Decorative blob -->
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-[#f7f8ff]0/20 to-pink-500/20 rounded-full blur-xl"></div>
                <div class="flex items-center space-x-3 animate-fadeInUp relative z-10">
                    <div class="w-12 h-12 rounded-2xl overflow-hidden shadow-lg shadow-[#4a4bcc]/40 transform hover:scale-110 transition-all duration-300 bg-white">
                        <img src="{{ asset('images/icon.jpg') }}" alt="SIKAT Polsri Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-[#4a4bcc] via-[#5658cc] to-[#6567dd] bg-clip-text text-transparent">S I K A T</h1>
                        <p class="text-xs text-slate-600 font-bold">Kerusakan Aset & Tindak Lanjut</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu - Vibrant -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'sidebar-active text-white shadow-lg shadow-[#B1B2FF]/30' : 'text-slate-700 hover:bg-white/60 hover:text-purple-700' }}">
                    <i class="fas fa-home text-lg {{ request()->routeIs('dashboard') ? '' : 'text-[#f5f5ff]0 group-hover:scale-110 transition-transform' }}"></i>
                    <span>Dashboard</span>
                </a>

                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.reports.create') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300 group {{ request()->routeIs('mahasiswa.reports.create') ? 'sidebar-active text-white shadow-lg shadow-[#B1B2FF]/30' : 'text-slate-700 hover:bg-white/60 hover:text-cyan-700' }}">
                        <i class="fas fa-plus-circle text-lg {{ request()->routeIs('mahasiswa.reports.create') ? '' : 'text-cyan-500 group-hover:scale-110 transition-transform' }}"></i>
                        <span>Buat Laporan</span>
                    </a>
                    <a href="{{ route('mahasiswa.reports.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300 group {{ request()->routeIs('mahasiswa.reports.index') ? 'sidebar-active text-white shadow-lg shadow-[#B1B2FF]/30' : 'text-slate-700 hover:bg-white/60 hover:text-[#a4b0ff]' }}">
                        <i class="fas fa-list text-lg {{ request()->routeIs('mahasiswa.reports.index') ? '' : 'text-[#f7f8ff]0 group-hover:scale-110 transition-transform' }}"></i>
                        <span>Riwayat Laporan</span>
                    </a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300 group {{ request()->routeIs('admin.reports.*') ? 'sidebar-active text-white shadow-lg shadow-[#B1B2FF]/30' : 'text-slate-700 hover:bg-white/60 hover:text-indigo-700' }}">
                        <i class="fas fa-clipboard-list text-lg {{ request()->routeIs('admin.reports.*') ? '' : 'text-[#f5f5ff]0 group-hover:scale-110 transition-transform' }}"></i>
                        <span>Kelola Laporan</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300 group {{ request()->routeIs('admin.users.*') ? 'sidebar-active text-white shadow-lg shadow-[#B1B2FF]/30' : 'text-slate-700 hover:bg-white/60 hover:text-[#a4b0ff]' }}">
                        <i class="fas fa-users-cog text-lg {{ request()->routeIs('admin.users.*') ? '' : 'text-[#f7f8ff]0 group-hover:scale-110 transition-transform' }}"></i>
                        <span>Manajemen User</span>
                    </a>
                @elseif(auth()->user()->role === 'teknisi')
                    <a href="{{ route('teknisi.tasks.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300 group {{ request()->routeIs('teknisi.tasks.*') ? 'sidebar-active text-white shadow-lg shadow-[#B1B2FF]/30' : 'text-slate-700 hover:bg-white/60 hover:text-emerald-700' }}">
                        <i class="fas fa-tasks text-lg {{ request()->routeIs('teknisi.tasks.*') ? '' : 'text-emerald-500 group-hover:scale-110 transition-transform' }}"></i>
                        <span>Tugas Perbaikan</span>
                    </a>
                @endif
            </nav>

            <!-- User Profile in Sidebar (Mobile) - Vibrant -->
            <div class="p-4 border-t border-white/30 lg:hidden">
                <div class="flex items-center space-x-3 mb-3">
                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full object-cover shadow-lg border-2 border-white">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-[#B1B2FF]/30">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-600 capitalize font-medium">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <a href="{{ route('profile') }}" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 bg-gradient-to-r from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] hover:from-[#9091EB] hover:via-[#8081D9] hover:to-[#7071C9] text-white rounded-xl font-bold text-sm shadow-md shadow-[#B1B2FF]/30 hover:-translate-y-0.5 transition-all duration-300 mb-2">
                    <i class="fas fa-user"></i>
                    <span>Profil Saya</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 bg-gradient-to-r from-rose-500 to-red-600 text-white rounded-xl font-bold text-sm shadow-md shadow-rose-500/30 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay for Mobile -->
        <div 
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 lg:hidden z-40"
        ></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Navbar -->
            <nav class="navbar-glass shadow-lg sticky top-0 z-30">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Mobile Menu Button -->
                        <button 
                            @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-xl hover:bg-white/40 transition-all duration-300"
                        >
                            <i class="fas fa-bars text-xl text-gray-700"></i>
                        </button>

                        <!-- Mobile Notification Bell -->
                        <div x-data="{ notifOpen: false }" class="lg:hidden relative">
                            <button @click="notifOpen = !notifOpen" class="relative p-2 text-slate-600 hover:text-[#9a9bff] hover:bg-[#f5f5ff] rounded-xl transition-all duration-300">
                                <i class="fas fa-bell text-xl"></i>
                                @if(auth()->user()->unreadNotificationsCount() > 0)
                                    <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center animate-pulse shadow-sm">
                                        {{ auth()->user()->unreadNotificationsCount() > 9 ? '9+' : auth()->user()->unreadNotificationsCount() }}
                                    </span>
                                @endif
                            </button>

                            <!-- Mobile Notification Dropdown -->
                            <div 
                                x-show="notifOpen"
                                @click.away="notifOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 top-12 w-72 card-glass rounded-2xl shadow-2xl overflow-hidden border border-white/30 z-50"
                            >
                                <div class="p-3 border-b border-slate-200 bg-gradient-to-r from-[#B1B2FF]/10 to-[#D2DAFF]/10">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-bold text-slate-800 text-sm">Notifikasi</h3>
                                        @if(auth()->user()->unreadNotificationsCount() > 0)
                                            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs text-[#9a9bff] hover:underline font-medium">
                                                    Tandai dibaca
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    @forelse(auth()->user()->notifications()->take(10)->get() as $notif)
                                        <a href="{{ route('notifications.read', $notif->id) }}" 
                                           class="block p-3 hover:bg-slate-50 transition-all border-b border-slate-100 {{ !$notif->is_read ? 'bg-blue-50/50' : '' }}">
                                            <div class="flex items-start gap-2">
                                                <div class="w-7 h-7 rounded-lg bg-{{ $notif->color }}-100 flex items-center justify-center flex-shrink-0">
                                                    <i class="fas {{ $notif->icon }} text-{{ $notif->color }}-500 text-xs"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-semibold text-xs text-slate-800 truncate">{{ $notif->title }}</p>
                                                    <p class="text-[11px] text-slate-600 line-clamp-2">{{ $notif->message }}</p>
                                                    <p class="text-[10px] text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                                </div>
                                                @if(!$notif->is_read)
                                                    <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0 mt-1"></div>
                                                @endif
                                            </div>
                                        </a>
                                    @empty
                                        <div class="p-6 text-center">
                                            <div class="w-10 h-10 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-2">
                                                <i class="fas fa-bell-slash text-slate-400 text-sm"></i>
                                            </div>
                                            <p class="text-xs text-slate-500">Tidak ada notifikasi</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Page Title (Desktop) -->
                        <div class="hidden lg:block">
                            <h2 class="text-lg font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        </div>

                        <!-- User Menu (Desktop) - Vibrant -->
                        <div class="hidden lg:flex items-center space-x-4 relative">
                            <!-- Notification Bell -->
                            <div x-data="{ notifOpen: false }" class="relative">
                                <button @click="notifOpen = !notifOpen" class="relative p-2 text-slate-600 hover:text-[#9a9bff] hover:bg-[#f5f5ff] rounded-xl transition-all duration-300">
                                    <i class="fas fa-bell text-xl"></i>
                                    @if(auth()->user()->unreadNotificationsCount() > 0)
                                        <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center animate-pulse shadow-sm">
                                            {{ auth()->user()->unreadNotificationsCount() > 9 ? '9+' : auth()->user()->unreadNotificationsCount() }}
                                        </span>
                                    @endif
                                </button>

                                <!-- Notification Dropdown -->
                                <div 
                                    x-show="notifOpen"
                                    @click.away="notifOpen = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 top-12 w-80 card-glass rounded-2xl shadow-2xl overflow-hidden border border-white/30 z-50"
                                >
                                    <div class="p-4 border-b border-slate-200 bg-gradient-to-r from-[#B1B2FF]/10 to-[#D2DAFF]/10">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-bold text-slate-800">Notifikasi</h3>
                                            @if(auth()->user()->unreadNotificationsCount() > 0)
                                                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs text-[#9a9bff] hover:underline font-medium">
                                                        Tandai semua dibaca
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="max-h-80 overflow-y-auto">
                                        @forelse(auth()->user()->notifications()->take(10)->get() as $notif)
                                            <a href="{{ route('notifications.read', $notif->id) }}" 
                                               class="block p-4 hover:bg-slate-50 transition-all border-b border-slate-100 {{ !$notif->is_read ? 'bg-blue-50/50' : '' }}">
                                                <div class="flex items-start gap-3">
                                                    <div class="w-8 h-8 rounded-lg bg-{{ $notif->color }}-100 flex items-center justify-center flex-shrink-0">
                                                        <i class="fas {{ $notif->icon }} text-{{ $notif->color }}-500 text-sm"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="font-semibold text-sm text-slate-800 truncate">{{ $notif->title }}</p>
                                                        <p class="text-xs text-slate-600 line-clamp-2">{{ $notif->message }}</p>
                                                        <p class="text-[10px] text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                                    </div>
                                                    @if(!$notif->is_read)
                                                        <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0 mt-2"></div>
                                                    @endif
                                                </div>
                                            </a>
                                        @empty
                                            <div class="p-8 text-center">
                                                <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-3">
                                                    <i class="fas fa-bell-slash text-slate-400"></i>
                                                </div>
                                                <p class="text-sm text-slate-500">Tidak ada notifikasi</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- User Info & Dropdown -->
                            <div x-data="{ dropdownOpen: false }" class="flex items-center space-x-4 relative">
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-600 capitalize font-medium">{{ auth()->user()->role }}</p>
                                </div>
                            <button @click="dropdownOpen = !dropdownOpen" class="relative group">
                                @if(auth()->user()->photo)
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="w-11 h-11 rounded-full object-cover shadow-lg ring-4 ring-white/60 hover:scale-110 transition-all duration-300">
                                @else
                                    <div class="w-11 h-11 bg-gradient-to-br from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB] rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-[#B1B2FF]/30 hover:scale-110 transition-all duration-300 ring-4 ring-white/60">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </button>

                            <!-- Dropdown -->
                            <div 
                                x-show="dropdownOpen"
                                @click.away="dropdownOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 top-14 w-56 card-glass rounded-2xl shadow-2xl overflow-hidden border border-white/30"
                            >
                                <a href="{{ route('profile') }}" class="w-full flex items-center space-x-3 px-5 py-3.5 hover:bg-gradient-to-r hover:from-[#B1B2FF]/10 hover:to-[#D2DAFF]/10 transition-all text-slate-700 hover:text-[#9a9bff] font-bold">
                                    <i class="fas fa-user text-[#9a9bff]"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-3 px-5 py-3.5 hover:bg-gradient-to-r hover:from-rose-50 hover:to-red-50 transition-all text-slate-700 hover:text-rose-600 font-bold border-t border-slate-200">
                                        <i class="fas fa-sign-out-alt text-rose-500"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1">
                <div class="p-6 lg:p-8 animate-fadeInUp">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="mb-6 card-glass border-l-4 border-green-500 p-5 rounded-2xl shadow-xl animate-fadeInUp">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-2xl mr-4"></i>
                                <span class="text-green-700 font-bold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 card-glass border-l-4 border-red-500 p-5 rounded-2xl shadow-xl animate-fadeInUp">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-500 text-2xl mr-4"></i>
                                <span class="text-red-700 font-bold">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 card-glass border-l-4 border-red-500 p-5 rounded-2xl shadow-xl animate-fadeInUp">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-4 mt-1"></i>
                                <div>
                                    <p class="font-bold text-red-700 text-lg mb-2">Terdapat kesalahan:</p>
                                    <ul class="list-disc list-inside space-y-1 text-red-600">
                                        @foreach($errors->all() as $error)
                                            <li class="font-semibold">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Persistent Background Music - data-turbo-permanent keeps this alive during navigation -->
    <div id="bgm-container" class="fixed bottom-6 right-6 z-50" data-turbo-permanent>
        <button id="bgm-toggle" class="group relative w-14 h-14 bg-gradient-to-br from-[#B1B2FF] to-[#9091EB] rounded-full shadow-2xl hover:shadow-[#B1B2FF]/50 transition-all duration-300 hover:scale-110 flex items-center justify-center">
            <i id="bgm-icon" class="fas fa-music-slash text-white text-xl"></i>
            <div class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-500 rounded-full border-2 border-white shadow-lg opacity-0 transition-opacity duration-300" id="bgm-playing-indicator"></div>
        </button>
    </div>

    <!-- Chart.js - loaded before @stack('scripts') to ensure availability -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
    @stack('scripts')
</body>
</html>
