<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CinePlex</title>
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
                        purple: { 400: '#b400ff' }
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
        :root {
            --neon-cyan: #00f0ff;
            --neon-pink: #ff00c8;
            --neon-purple: #b400ff;
            --dark-bg: #0a0a0f;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-bg);
            color: white;
        }
        .cyber-font { font-family: 'Orbitron', sans-serif; }
        .neon-glow {
            box-shadow: 0 0 10px var(--neon-cyan), 0 0 20px var(--neon-cyan);
        }
        .glass-effect {
            background: rgba(10, 10, 15, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neon-text {
            text-shadow: 0 0 10px currentColor;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Animation -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?q=80&w=2071')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-black via-purple-900/40 to-cyan-900/40"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md p-8 m-4">
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center p-4 rounded-full border border-cyan-400/30 bg-black/50 mb-6 neon-glow">
                <i class="fas fa-user-astronaut text-4xl text-cyan-400"></i>
            </div>
            <h1 class="cyber-font text-4xl font-black tracking-wider">
                <span class="bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent neon-text">
                    ADMIN ACCESS
                </span>
            </h1>
            <p class="text-gray-400 mt-2 text-sm tracking-widest uppercase">Secure Gateway</p>
        </div>

        <div class="glass-effect rounded-2xl p-8 border border-cyan-400/30">
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/30 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                    <div class="text-sm text-red-200">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div class="group">
                    <label class="block text-cyan-400 text-xs font-bold uppercase tracking-widest mb-2">Identifier</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500 group-focus-within:text-cyan-400 transition-colors"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-black/50 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all font-mono"
                            placeholder="admin@access.com">
                    </div>
                </div>

                <div class="group">
                    <label class="block text-pink-400 text-xs font-bold uppercase tracking-widest mb-2">Passcode</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-500 group-focus-within:text-pink-400 transition-colors"></i>
                        </div>
                        <input type="password" name="password" required
                            class="w-full bg-black/50 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-gray-600 focus:outline-none focus:border-pink-400 focus:ring-1 focus:ring-pink-400 transition-all font-mono"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-600 bg-black/50 text-cyan-400 focus:ring-cyan-400 focus:ring-offset-0">
                        <span class="ml-2 text-sm text-gray-400 group-hover:text-white transition-colors">Keep Session Active</span>
                    </label>
                </div>

                <button type="submit" 
                    class="w-full relative group overflow-hidden rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 p-px">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-cyan-600 to-blue-600 opacity-50 group-hover:opacity-100 transition-opacity duration-300 blur-md"></div>
                    <div class="relative bg-black rounded-xl px-6 py-4 transition-all duration-300 group-hover:bg-opacity-0">
                        <div class="flex items-center justify-center gap-3">
                            <span class="cyber-font font-bold tracking-widest text-white group-hover:scale-105 transition-transform">INITIATE LOGIN</span>
                            <i class="fas fa-arrow-right text-cyan-400 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-cyan-400 transition-colors text-sm">
                <i class="fas fa-long-arrow-alt-left"></i>
                <span>Return to Public Access</span>
            </a>
        </div>
    </div>
</body>
</html>
