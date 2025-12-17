@extends('layouts.app')

@section('title', 'Trending Movies - CinePlex')

@section('content')
<div class="min-h-screen pt-8 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero Section -->
    <div class="text-center mb-16">
      <div class="flex justify-center mb-6">
        <div class="relative">
          <div class="w-20 h-20 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center">
            <i class="fas fa-fire text-white text-2xl"></i>
          </div>
          <div class="absolute -inset-4 bg-red-500 rounded-full blur-xl opacity-50 animate-pulse"></div>
        </div>
      </div>
      
      <h1 class="cyber-font text-4xl md:text-6xl font-black mb-6">
        <span class="bg-gradient-to-r from-red-400 via-orange-400 to-pink-400 bg-clip-text text-transparent neon-text">
          TRENDING NOW
        </span>
      </h1>
      <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto">
        Discover what's hot and trending in the world of cinema. Real-time updates on the most watched and talked about movies.
      </p>
    </div>

    <!-- Live Stats Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
      <div class="glass-effect rounded-2xl p-6 border border-red-400/20 relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-20 h-20 bg-red-400 rounded-full blur-2xl opacity-20"></div>
        <div class="flex items-center justify-between">
          <div>
            <div class="text-3xl font-bold text-red-400 mb-2" id="liveViewers">2,847</div>
            <div class="text-gray-400 text-sm">LIVE VIEWERS</div>
          </div>
          <div class="w-3 h-3 bg-red-400 rounded-full animate-pulse"></div>
        </div>
      </div>

      <div class="glass-effect rounded-2xl p-6 border border-orange-400/20 relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-20 h-20 bg-orange-400 rounded-full blur-2xl opacity-20"></div>
        <div class="flex items-center justify-between">
          <div>
            <div class="text-3xl font-bold text-orange-400 mb-2">{{ count($trending) }}</div>
            <div class="text-gray-400 text-sm">TRENDING MOVIES</div>
          </div>
          <i class="fas fa-chart-line text-orange-400 text-xl"></i>
        </div>
      </div>

      <div class="glass-effect rounded-2xl p-6 border border-amber-400/20 relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-20 h-20 bg-amber-400 rounded-full blur-2xl opacity-20"></div>
        <div class="flex items-center justify-between">
          <div>
            <div class="text-3xl font-bold text-amber-400 mb-2">8.4</div>
            <div class="text-gray-400 text-sm">AVG RATING</div>
          </div>
          <i class="fas fa-star text-amber-400 text-xl"></i>
        </div>
      </div>

      <div class="glass-effect rounded-2xl p-6 border border-pink-400/20 relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-20 h-20 bg-pink-400 rounded-full blur-2xl opacity-20"></div>
        <div class="flex items-center justify-between">
          <div>
            <div class="text-3xl font-bold text-pink-400 mb-2">12K+</div>
            <div class="text-gray-400 text-sm">DAILY VIEWS</div>
          </div>
          <i class="fas fa-eye text-pink-400 text-xl"></i>
        </div>
      </div>
    </div>

    <!-- Top 3 Trending Movies -->
    <section class="mb-20">
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
          <div class="w-2 h-8 bg-gradient-to-b from-red-400 to-pink-400 rounded-full"></div>
          <h2 class="cyber-font text-2xl md:text-3xl font-bold text-white">TOP TRENDING</h2>
        </div>
        <div class="flex items-center space-x-2 text-red-400">
          <i class="fas fa-crown"></i>
          <span class="text-sm font-semibold">THIS WEEK</span>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($trending->take(3) as $index => $movie)
          <div class="group relative rounded-2xl overflow-hidden transition-all duration-500 hover:scale-105">
            <!-- Ranking Badge -->
            <div class="absolute top-4 left-4 z-10">
              @if($index === 0)
                <div class="bg-gradient-to-r from-yellow-500 to-amber-500 text-white font-bold px-4 py-2 rounded-full shadow-lg flex items-center space-x-2">
                  <i class="fas fa-crown"></i>
                  <span>#{{ $index + 1 }}</span>
                </div>
              @elseif($index === 1)
                <div class="bg-gradient-to-r from-gray-400 to-gray-600 text-white font-bold px-4 py-2 rounded-full shadow-lg">
                  #{{ $index + 1 }}
                </div>
              @else
                <div class="bg-gradient-to-r from-amber-700 to-amber-900 text-white font-bold px-4 py-2 rounded-full shadow-lg">
                  #{{ $index + 1 }}
                </div>
              @endif
            </div>

            <!-- Movie Card -->
            <div class="relative bg-gradient-to-br from-gray-900 to-black border border-white/10 rounded-2xl overflow-hidden">
              <a href="{{ route('movie.show', $movie['id']) }}">
                <img src="{{ $movie['poster'] }}" 
                     alt="{{ $movie['title'] }}" 
                     class="w-full h-80 object-cover group-hover:scale-110 transition duration-700">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent">
                  <div class="absolute bottom-0 p-6 w-full">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $movie['title'] }}</h3>
                    <p class="text-cyan-400 text-sm mb-3">{{ $movie['year'] }} • {{ $movie['genre'] }}</p>
                    <p class="text-gray-300 text-sm line-clamp-2 mb-4">{{ $movie['description'] }}</p>
                    
                    <div class="flex items-center justify-between">
                      <div class="flex items-center space-x-2">
                        <div class="bg-amber-400 text-black px-2 py-1 rounded text-xs font-bold">
                          <i class="fas fa-star mr-1"></i>{{ rand(8, 9) }}.{{ rand(0, 9) }}
                        </div>
                        <span class="text-red-400 text-xs font-semibold">
                          <i class="fas fa-fire mr-1"></i>TRENDING
                        </span>
                      </div>
                        <button onclick="openTrailer('{{ $movie['trailer'] }}', '{{ $movie['title'] }}')" 
                          class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition">
                          <i class="fas fa-play"></i>
                        </button>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <!-- All Trending Movies -->
    <section class="mb-16">
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
          <div class="w-2 h-8 bg-gradient-to-b from-orange-400 to-red-400 rounded-full"></div>
          <h2 class="cyber-font text-2xl md:text-3xl font-bold text-white">TRENDING COLLECTION</h2>
        </div>
        <span class="glass-effect px-4 py-2 rounded-full text-orange-400 text-sm border border-orange-400/30">
          {{ count($trending) }} MOVIES
        </span>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($trending as $movie)
          <div class="group relative rounded-xl overflow-hidden transition-all duration-500 hover:scale-105">
            <div class="relative bg-gradient-to-br from-gray-900 to-black border border-white/10 rounded-xl overflow-hidden h-full">
              <a href="{{ route('movie.show', $movie['id']) }}">
                <img src="{{ $movie['thumb'] }}" 
                     alt="{{ $movie['title'] }}" 
                     class="w-full aspect-[2/3] object-cover group-hover:scale-110 transition duration-700"
                     loading="lazy">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-0 p-3 w-full">
                    <h3 class="font-semibold text-white text-sm mb-1 line-clamp-2">{{ $movie['title'] }}</h3>
                    <p class="text-cyan-400 text-xs">{{ $movie['year'] }}</p>
                  </div>
                </div>
              </a>

              <!-- Trending Badge -->
              <div class="absolute top-2 left-2">
                <div class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded border border-red-400/50">
                  <i class="fas fa-fire mr-1"></i>HOT
                </div>
              </div>

              <!-- Rating -->
              <div class="absolute top-2 right-2">
                <div class="bg-black/80 backdrop-blur-sm text-amber-400 text-xs font-bold px-2 py-1 rounded border border-amber-400/30">
                  {{ rand(7, 9) }}.{{ rand(0, 9) }}
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  </div>
</div>

<!-- Live Stats Animation -->
<script>
  // Animate live viewer count
  function animateLiveViewers() {
    const viewerElement = document.getElementById('liveViewers');
    let viewers = 2847;
    
    setInterval(() => {
      viewers += Math.floor(Math.random() * 10) - 3; // Random fluctuation
      viewers = Math.max(2800, Math.min(3000, viewers)); // Keep within range
      viewerElement.textContent = viewers.toLocaleString();
    }, 3000);
  }
  
  document.addEventListener('DOMContentLoaded', animateLiveViewers);
</script>
@endsection