@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Command Center')
@section('page-subtitle', 'Real-time overview of platform statistics')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="glass-panel p-6 rounded-2xl border border-cyan-500/20 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-film text-6xl text-cyan-400"></i>
            </div>
            <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Total Movies</p>
            <h3 class="text-3xl font-bold text-white mt-1">{{ $totalMovies }}</h3>
            <div class="mt-4 flex items-center text-xs text-cyan-400 gap-1">
                <i class="fas fa-arrow-up"></i>
                <span>Database Active</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="glass-panel p-6 rounded-2xl border border-purple-500/20 relative overflow-hidden group">
             <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-users text-6xl text-purple-400"></i>
            </div>
            <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Total Users</p>
            <h3 class="text-3xl font-bold text-white mt-1">1</h3>
            <div class="mt-4 flex items-center text-xs text-purple-400 gap-1">
                <i class="fas fa-shield-alt"></i>
                <span>Admin Access</span>
            </div>
        </div>
        
        <!-- Stat Card 3: Analytics -->
        <div class="glass-panel p-6 rounded-2xl border border-pink-500/20 relative overflow-hidden group col-span-1 md:col-span-2">
            <h4 class="text-white font-bold mb-4">Top Genres Distribution</h4>
            <div class="h-32">
                <canvas id="genreChart"></canvas>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('genreChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($genreLabels),
                datasets: [{
                    label: 'Movies',
                    data: @json($genreData),
                    backgroundColor: [
                        'rgba(0, 240, 255, 0.6)',
                        'rgba(255, 0, 200, 0.6)',
                        'rgba(180, 0, 255, 0.6)',
                        'rgba(0, 255, 128, 0.6)',
                        'rgba(255, 128, 0, 0.6)'
                    ],
                    borderColor: [
                        '#00f0ff',
                        '#ff00c8',
                        '#b400ff',
                        '#00ff80',
                        '#ff8000'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.1)' },
                        ticks: { color: '#9ca3af' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af' }
                    }
                }
            }
        });
    </script>


    <!-- Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Moves -->
        <div class="lg:col-span-2 glass-panel rounded-2xl border border-gray-800 p-6">
             <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Recent Additions</h3>
                <a href="{{ route('admin.movies.index') }}" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">View All</a>
            </div>

            <div class="space-y-4">
                @forelse($recentMovies as $movie)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                    <img src="{{ $movie->thumb }}" alt="" class="w-16 h-24 object-cover rounded-lg shadow-lg">
                    <div class="flex-1">
                        <h4 class="text-white font-medium group-hover:text-cyan-400 transition-colors">{{ $movie->title }}</h4>
                        <div class="flex items-center gap-3 text-sm text-gray-500 mt-1">
                            <span><i class="fas fa-calendar-alt mr-1"></i> {{ $movie->year }}</span>
                            <span><i class="fas fa-film mr-1"></i> {{ $movie->genre }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.movies.edit', $movie) }}" class="p-2 bg-gray-700 hover:bg-cyan-600 rounded-lg text-white transition-colors"><i class="fas fa-pen"></i></a>
                    </div>
                </div>
                @empty
                <div class="text-center py-10 text-gray-500">
                    No movies found.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="glass-panel rounded-2xl border border-gray-800 p-6 h-fit">
            <h3 class="text-xl font-bold text-white mb-6">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.movies.create') }}" class="block w-full p-4 rounded-xl bg-gradient-to-r from-cyan-900/50 to-blue-900/50 border border-cyan-500/30 hover:border-cyan-400 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="text-left">
                            <span class="block text-white font-medium group-hover:translate-x-1 transition-transform">Add New Movie</span>
                            <span class="text-xs text-gray-400">Import new content</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
