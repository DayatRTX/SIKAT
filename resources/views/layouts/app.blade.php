<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIKAT Polsri') - Sistem Keluhan & Aduan Terpadu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-gradient-to-br from-[#EEF1FF] via-[#D2DAFF] to-[#AAC4FF] overflow-hidden">
    <div x-data="{ sidebarOpen: false }" class="h-full flex">
        <!-- Sidebar Desktop & Mobile -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:relative lg:translate-x-0 inset-y-0 left-0 z-50 w-72 sidebar-glass shadow-2xl transition-transform duration-300 ease-in-out flex flex-col"
        >
            <!-- Logo & Brand -->
            <div class="p-6 border-b border-white/30">
                <div class="flex items-center space-x-3 animate-fadeInUp">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#B1B2FF] to-[#AAC4FF] rounded-2xl flex items-center justify-center shadow-lg transform hover:scale-110 transition-all duration-300">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-[#B1B2FF] to-[#AAC4FF] bg-clip-text text-transparent">SIKAT Polsri</h1>
                        <p class="text-xs text-gray-600 font-medium">Sistem Gangguan & Perbaikan</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'sidebar-active text-white' : 'text-gray-700 hover:bg-white/40' }}">
                    <i class="fas fa-home text-lg {{ request()->routeIs('dashboard') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                    <span>Dashboard</span>
                </a>

                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.reports.create') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 group {{ request()->routeIs('mahasiswa.reports.create') ? 'sidebar-active text-white' : 'text-gray-700 hover:bg-white/40' }}">
                        <i class="fas fa-plus-circle text-lg {{ request()->routeIs('mahasiswa.reports.create') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                        <span>Buat Laporan</span>
                    </a>
                    <a href="{{ route('mahasiswa.reports.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 group {{ request()->routeIs('mahasiswa.reports.index') ? 'sidebar-active text-white' : 'text-gray-700 hover:bg-white/40' }}">
                        <i class="fas fa-list text-lg {{ request()->routeIs('mahasiswa.reports.index') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                        <span>Riwayat Laporan</span>
                    </a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 group {{ request()->routeIs('admin.reports.*') ? 'sidebar-active text-white' : 'text-gray-700 hover:bg-white/40' }}">
                        <i class="fas fa-clipboard-list text-lg {{ request()->routeIs('admin.reports.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                        <span>Kelola Laporan</span>
                    </a>
                @elseif(auth()->user()->role === 'teknisi')
                    <a href="{{ route('teknisi.tasks.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 group {{ request()->routeIs('teknisi.tasks.*') ? 'sidebar-active text-white' : 'text-gray-700 hover:bg-white/40' }}">
                        <i class="fas fa-tasks text-lg {{ request()->routeIs('teknisi.tasks.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                        <span>Tugas Perbaikan</span>
                    </a>
                @endif
            </nav>

            <!-- User Profile in Sidebar (Mobile) -->
            <div class="p-4 border-t border-white/30 lg:hidden">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#B1B2FF] to-[#AAC4FF] rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-600 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-600 rounded-xl font-semibold text-sm transition-all duration-300">
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
        <div class="flex-1 flex flex-col h-full overflow-hidden">
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

                        <!-- Page Title (Desktop) -->
                        <div class="hidden lg:block">
                            <h2 class="text-lg font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        </div>

                        <!-- User Menu (Desktop) -->
                        <div x-data="{ dropdownOpen: false }" class="hidden lg:flex items-center space-x-4 relative">
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-600 capitalize">{{ auth()->user()->role }}</p>
                            </div>
                            <button @click="dropdownOpen = !dropdownOpen" class="w-11 h-11 bg-gradient-to-br from-[#B1B2FF] to-[#AAC4FF] rounded-full flex items-center justify-center text-white font-bold shadow-lg hover:scale-110 transition-all duration-300 ring-4 ring-white/50">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
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
                                class="absolute right-0 top-14 w-56 card-glass rounded-2xl shadow-2xl overflow-hidden"
                            >
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-3 px-5 py-3.5 hover:bg-white/40 transition-all text-gray-700 font-semibold">
                                        <i class="fas fa-sign-out-alt text-red-500"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
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

    @stack('scripts')
</body>
</html>
    <!-- Navbar Glassmorphism -->
    <nav class="glass-strong shadow-premium sticky top-0 z-50 border-b border-white/30 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3 animate-fadeIn">
                    <div class="w-10 h-10 bg-gradient-primary rounded-xl flex items-center justify-center shadow-premium transform hover:scale-110 transition-all duration-300">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold gradient-text">SIKAT Polsri</h1>
                        <p class="text-xs text-gray-600 font-medium">Sistem Gangguan & Perbaikan</p>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4 animate-fadeIn-delay-1">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-primary capitalize font-medium">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="relative group">
                        <button class="w-10 h-10 bg-gradient-primary rounded-full flex items-center justify-center text-white font-bold shadow-premium hover:scale-110 transition-all duration-300 ring-2 ring-white/50">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 glass-strong rounded-xl shadow-premium-lg border border-white/50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2">
                            <div class="py-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-white/50 transition-all flex items-center space-x-2 rounded-lg font-medium">
                                        <i class="fas fa-sign-out-alt text-primary"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout with Sidebar -->
    <div class="flex min-h-screen">
        <!-- Sidebar Glassmorphism -->
        <aside class="w-64 glass border-r border-white/30 shadow-premium m-4 rounded-2xl animate-fadeIn-delay-2">
            <div class="p-6">
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gradient-primary text-white shadow-premium' : 'text-gray-700 hover:bg-white/50' }}">
                        <i class="fas fa-home {{ request()->routeIs('dashboard') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                        <span class="font-semibold">Dashboard</span>
                    </a>

                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.reports.create') }}" class="group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('mahasiswa.reports.create') ? 'bg-gradient-primary text-white shadow-premium' : 'text-gray-700 hover:bg-white/50' }}">
                            <i class="fas fa-plus-circle {{ request()->routeIs('mahasiswa.reports.create') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                            <span class="font-semibold">Buat Laporan</span>
                        </a>
                        <a href="{{ route('mahasiswa.reports.index') }}" class="group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('mahasiswa.reports.index') ? 'bg-gradient-primary text-white shadow-premium' : 'text-gray-700 hover:bg-white/50' }}">
                            <i class="fas fa-list {{ request()->routeIs('mahasiswa.reports.index') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                            <span class="font-semibold">Riwayat Laporan</span>
                        </a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.reports.index') }}" class="group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.reports.*') ? 'bg-gradient-primary text-white shadow-premium' : 'text-gray-700 hover:bg-white/50' }}">
                            <i class="fas fa-clipboard-list {{ request()->routeIs('admin.reports.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                            <span class="font-semibold">Kelola Laporan</span>
                        </a>
                    @elseif(auth()->user()->role === 'teknisi')
                        <a href="{{ route('teknisi.tasks.index') }}" class="group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('teknisi.tasks.*') ? 'bg-gradient-primary text-white shadow-premium' : 'text-gray-700 hover:bg-white/50' }}">
                            <i class="fas fa-tasks {{ request()->routeIs('teknisi.tasks.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                            <span class="font-semibold">Tugas Perbaikan</span>
                        </a>
                    @endif
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 animate-fadeIn-delay-3">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 glass-strong border-l-4 border-green-500 text-green-700 p-5 rounded-xl shadow-premium animate-fadeIn">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 glass-strong border-l-4 border-red-500 text-red-700 p-5 rounded-xl shadow-premium animate-fadeIn">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 glass-strong border-l-4 border-red-500 text-red-700 p-5 rounded-xl shadow-premium animate-fadeIn">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mr-3 mt-1 text-xl"></i>
                        <div>
                            <p class="font-bold mb-2 text-lg">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="font-medium">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Footer Glassmorphism -->
    <footer class="glass-strong border-t border-white/30 py-6 shadow-premium">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-600 text-sm">
            <p class="font-medium">&copy; 2025 SIKAT Polsri - Politeknik Negeri Sriwijaya. All rights reserved.</p>
            <p class="text-xs text-gray-500 mt-1">Dibuat dengan ❤️ untuk kampus yang lebih baik</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">SIKAT Polsri</h1>
                        <p class="text-xs text-gray-500">Sistem Gangguan & Perbaikan</p>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="relative group">
                        <button class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold hover:bg-secondary transition-all">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-tertiary opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <div class="py-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-tertiary transition-all flex items-center space-x-2">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout with Sidebar -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg border-r border-tertiary">
            <div class="p-6">
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-tertiary transition-all {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-gray-700' }}">
                        <i class="fas fa-home"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.reports.create') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-tertiary transition-all {{ request()->routeIs('mahasiswa.reports.create') ? 'bg-primary text-white' : 'text-gray-700' }}">
                            <i class="fas fa-plus-circle"></i>
                            <span class="font-medium">Buat Laporan</span>
                        </a>
                        <a href="{{ route('mahasiswa.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-tertiary transition-all {{ request()->routeIs('mahasiswa.reports.index') ? 'bg-primary text-white' : 'text-gray-700' }}">
                            <i class="fas fa-list"></i>
                            <span class="font-medium">Riwayat Laporan</span>
                        </a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-tertiary transition-all {{ request()->routeIs('admin.reports.*') ? 'bg-primary text-white' : 'text-gray-700' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="font-medium">Kelola Laporan</span>
                        </a>
                    @elseif(auth()->user()->role === 'teknisi')
                        <a href="{{ route('teknisi.tasks.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-tertiary transition-all {{ request()->routeIs('teknisi.tasks.*') ? 'bg-primary text-white' : 'text-gray-700' }}">
                            <i class="fas fa-tasks"></i>
                            <span class="font-medium">Tugas Perbaikan</span>
                        </a>
                    @endif
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md animate-pulse">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mr-3 mt-1"></i>
                        <div>
                            <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-tertiary py-4">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-600 text-sm">
            <p>&copy; 2024 SIKAT Polsri - Politeknik Negeri Sriwijaya. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
