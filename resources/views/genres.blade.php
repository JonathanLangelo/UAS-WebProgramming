@extends('layouts.app')

@section('title', 'Movie Genres - CinePlex')

@section('content')
<div class="min-h-screen pt-8 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero Header -->
    <div class="text-center mb-16">
      <h1 class="cyber-font text-4xl md:text-6xl font-black mb-6">
        <span class="bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent neon-text">
          EXPLORE GENRES
        </span>
      </h1>
      <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto">
        Dive into our curated collection of movies across various genres. From action-packed adventures to heartwarming dramas.
      </p>
    </div>

    <!-- Genre Statistics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
      <div class="glass-effect rounded-2xl p-6 text-center border border-cyan-400/20">
        <div class="text-3xl text-cyan-400 mb-2">{{ count($genres) }}+</div>
        <div class="text-gray-400 text-sm">GENRES</div>
      </div>
      <div class="glass-effect rounded-2xl p-6 text-center border border-pink-400/20">
        <div class="text-3xl text-pink-400 mb-2">{{ count($movies) }}+</div>
        <div class="text-gray-400 text-sm">MOVIES</div>
      </div>
      <div class="glass-effect rounded-2xl p-6 text-center border border-purple-400/20">
        <div class="text-3xl text-purple-400 mb-2">24/7</div>
        <div class="text-gray-400 text-sm">STREAMING</div>
      </div>
      <div class="glass-effect rounded-2xl p-6 text-center border border-green-400/20">
        <div class="text-3xl text-green-400 mb-2">4K</div>
        <div class="text-gray-400 text-sm">QUALITY</div>
      </div>
    </div>

    <!-- Genre Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-16">
      @foreach($genres as $genre)
        @php
          $genreMovies = $movies->filter(function($movie) use ($genre) {
              return \Illuminate\Support\Str::contains($movie->genre, $genre);
          });
          $movieCount = count($genreMovies);
          
          // Genre icons and colors
          $genreIcons = [
            'Action' => '💥', 'Adventure' => '🏔️', 'Sci-Fi' => '🚀', 
            'Horror' => '👻', 'Comedy' => '😂', 'Drama' => '🎭',
            'Fantasy' => '🦄', 'Thriller' => '🔪', 'Mystery' => '🕵️',
            'Romance' => '💖', 'Animation' => '🐰', 'Crime' => '🔫'
          ];
          
          $genreColors = [
            'Action' => 'from-red-500 to-orange-500',
            'Adventure' => 'from-green-500 to-emerald-500', 
            'Sci-Fi' => 'from-blue-500 to-cyan-500',
            'Horror' => 'from-purple-500 to-pink-500',
            'Comedy' => 'from-yellow-500 to-amber-500',
            'Drama' => 'from-indigo-500 to-purple-500',
            'Fantasy' => 'from-pink-500 to-rose-500',
            'Thriller' => 'from-gray-500 to-slate-500',
            'Mystery' => 'from-violet-500 to-purple-500',
            'Romance' => 'from-rose-500 to-pink-500',
            'Animation' => 'from-cyan-500 to-blue-500',
            'Crime' => 'from-orange-500 to-red-500'
          ];
          
          $icon = $genreIcons[$genre] ?? '🎬';
          $color = $genreColors[$genre] ?? 'from-cyan-500 to-blue-500';
        @endphp
        
        <a href="#genre-{{ Str::slug($genre) }}" 
           class="group relative overflow-hidden rounded-2xl transition-all duration-500 hover:scale-105 hover:rotate-1">
          <div class="absolute inset-0 bg-gradient-to-br {{ $color }} opacity-80 group-hover:opacity-100 transition duration-500"></div>
          <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition duration-500"></div>
          
          <div class="relative p-6 text-center min-h-[140px] flex flex-col justify-center items-center">
            <div class="text-3xl mb-3 transform group-hover:scale-125 transition duration-300">
              {{ $icon }}
            </div>
            <h3 class="font-bold text-white text-lg mb-2">{{ $genre }}</h3>
            <p class="text-white/80 text-sm">{{ $movieCount }} movies</p>
          </div>
          
          <!-- Hover Effect -->
          <div class="absolute inset-0 border-2 border-transparent bg-gradient-to-r from-cyan-500 to-pink-500 opacity-0 group-hover:opacity-100 transition duration-500 rounded-2xl" 
               style="mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude; padding: 2px;"></div>
        </a>
      @endforeach
    </div>

    <!-- Movies by Genre Sections -->
    @foreach($genres as $genre)
      @php
        $genreMovies = $movies->filter(function($movie) use ($genre) {
            return \Illuminate\Support\Str::contains($movie->genre, $genre);
        });
      @endphp
      
      @if(count($genreMovies) > 0)
        <section id="genre-{{ Str::slug($genre) }}" class="mb-20 scroll-mt-24">
          <!-- Section Header -->
          <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-4">
              <div class="w-2 h-8 bg-gradient-to-b from-cyan-400 to-pink-400 rounded-full"></div>
              <h2 class="cyber-font text-2xl md:text-3xl font-bold text-white">{{ $genre }} COLLECTION</h2>
            </div>
            <span class="glass-effect px-4 py-2 rounded-full text-cyan-400 text-sm border border-cyan-400/30">
              {{ count($genreMovies) }} MOVIES
            </span>
          </div>

          <!-- Movies Grid -->
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach($genreMovies as $movie)
              <div class="group relative rounded-xl overflow-hidden transition-all duration-500 hover:scale-105">
                <!-- Main Card -->
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

                  <!-- Quick Actions -->
                  <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition duration-300">
                    <button onclick="openTrailer('{{ $movie['trailer'] }}', '{{ $movie['title'] }}')" 
                      class="bg-cyan-500 hover:bg-cyan-600 text-white p-2 rounded-lg text-xs transition">
                      <i class="fas fa-play"></i>
                    </button>
                  </div>

                  <!-- Rating Badge -->
                  <div class="absolute top-2 left-2">
                    <div class="bg-black/80 backdrop-blur-sm text-amber-400 text-xs font-bold px-2 py-1 rounded border border-amber-400/30">
                      <i class="fas fa-star text-amber-400 mr-1"></i>
                      {{ rand(7, 9) }}.{{ rand(0, 9) }}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </section>
      @endif
    @endforeach
  </div>
</div>

<!-- Smooth Scroll Script -->
<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
</script>
@endsection