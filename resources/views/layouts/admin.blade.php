<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - CinePlex Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cyan: { 400: '#00f0ff' },
                        pink: { 400: '#ff00c8' },
                        purple: { 400: '#b400ff' },
                        dark: { 
                            bg: '#0a0a0f',
                            card: 'rgba(20, 20, 25, 0.9)'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Orbitron', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #0a0a0f; color: #e5e7eb; font-family: 'Inter', sans-serif; }
        .cyber-font { font-family: 'Orbitron', sans-serif; }
        .glass-panel {
            background: rgba(20, 20, 25, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .nav-active {
            background: linear-gradient(90deg, rgba(0, 240, 255, 0.1) 0%, transparent 100%);
            border-left: 2px solid #00f0ff;
            color: #00f0ff;
        }
        .nav-item:hover:not(.nav-active) {
            background: rgba(255, 255, 255, 0.03);
            color: white;
        }
        /* Dashboard specific replacements */
        .content-card { @apply glass-panel rounded-2xl p-6 border border-gray-800; }
        .btn-primary { @apply bg-cyan-600 hover:bg-cyan-500 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 shadow-lg shadow-cyan-900/20; }
        .btn-secondary { @apply bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200; }
        .btn-danger { @apply bg-red-600 hover:bg-red-500 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200; }
        
        table { @apply w-full text-left border-collapse; }
        th { @apply py-4 px-4 font-bold text-gray-400 border-b border-gray-800; }
        td { @apply py-4 px-4 border-b border-gray-800/50; }
        tr:hover td { @apply bg-white/5; }
    </style>
</head>
<body class="antialiased min-h-screen flex bg-[#0a0a0f] text-gray-300">
    <!-- Sidebar -->
    <aside class="w-64 fixed inset-y-0 left-0 z-50 glass-panel border-r border-gray-800 flex flex-col">
        <div class="h-20 flex items-center px-8 border-b border-gray-800">
            <span class="cyber-font text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                CINEPLEX<span class="text-xs text-gray-500 ml-2">OS</span>
            </span>
        </div>

        <nav class="flex-1 py-8 space-y-2 px-4">
            <p class="px-4 text-xs font-bold text-gray-600 uppercase tracking-widest mb-4">Main Menu</p>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'nav-active' : 'text-gray-400' }}">
                <i class="fas fa-grid-2 text-lg w-6"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.movies.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.movies.*') ? 'nav-active' : 'text-gray-400' }}">
                <i class="fas fa-film text-lg w-6"></i>
                <span class="font-medium">Movies DB</span>
            </a>

            <p class="px-4 text-xs font-bold text-gray-600 uppercase tracking-widest mt-8 mb-4">System</p>

            <a href="{{ route('home') }}" target="_blank" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-gray-400">
                <i class="fas fa-external-link-alt text-lg w-6"></i>
                <span class="font-medium">Live Site</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <div class="flex items-center gap-3 px-4 py-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-cyan-500 to-purple-500 flex items-center justify-center">
                    <span class="font-bold text-white text-xs">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">@yield('page-title')</h1>
                <p class="text-gray-500 mt-1">@yield('page-subtitle', 'Manage your cinema content')</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-4 py-2 rounded-full glass-panel border border-cyan-500/20 text-cyan-400 text-sm flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    System Online
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
