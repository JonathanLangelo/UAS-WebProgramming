@extends('layouts.app')

@section('title', $movie['title'] . ' - CinePlex')

@section('content')
<div class="min-h-screen pt-8 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Back Button -->
    <div class="mb-8">
      <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition group">
        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i>
        <span>Back to Home</span>
      </a>
    </div>

    <!-- Movie Hero Section -->
    <div class="grid lg:grid-cols-2 gap-12 items-start mb-16">
      
      <!-- Poster with Effects -->
      <div class="relative">
        <!-- Glow Effect -->
        <div class="absolute -inset-4 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-2xl blur-xl opacity-20"></div>
        
        <!-- Main Poster -->
        <div class="relative rounded-2xl overflow-hidden border border-cyan-500/30 bg-gradient-to-br from-gray-900 to-black">
          <img src="{{ $movie['poster'] }}" 
               alt="{{ $movie['title'] }}" 
               class="w-full h-auto object-cover">
        </div>

        <!-- Floating Rating -->
        <div class="absolute -top-4 -right-4">
          <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold py-3 px-4 rounded-2xl shadow-2xl flex items-center gap-2">
            <i class="fas fa-star"></i>
            <span class="text-lg">{{ rand(7, 9) }}.<span class="text-sm">{{ rand(0, 9) }}</span></span>
          </div>
        </div>
      </div>

      <!-- Movie Info -->
      <div class="space-y-6">
        <!-- Title & Metadata -->
        <div>
          <h1 class="cyber-font text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 leading-tight">
            {{ $movie['title'] }}
          </h1>
          
          <div class="flex flex-wrap items-center gap-4 mb-6">
            <span class="bg-cyan-500/20 text-cyan-400 px-3 py-1 rounded-full text-sm border border-cyan-400/30">
              {{ $movie['year'] }}
            </span>
            <span class="bg-pink-500/20 text-pink-400 px-3 py-1 rounded-full text-sm border border-pink-400/30">
              {{ $movie['genre'] }}
            </span>
            <span class="bg-purple-500/20 text-purple-400 px-3 py-1 rounded-full text-sm border border-purple-400/30">
              2h 18m
            </span>
          </div>
        </div>

        <!-- Synopsis -->
        <div class="glass-effect rounded-2xl p-6 border border-white/10">
          <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-scroll text-cyan-400"></i>
            Synopsis
          </h3>
          <p class="text-gray-300 leading-relaxed text-lg">
            {{ $movie['description'] }}
          </p>
        </div>

        <!-- Movie Details Grid -->
        <div class="grid grid-cols-2 gap-6">
          <div class="glass-effect rounded-2xl p-4 text-center border border-cyan-400/20">
            <div class="text-cyan-400 text-sm mb-1">Release Year</div>
            <div class="text-white font-semibold">{{ $movie['year'] }}</div>
          </div>
          <div class="glass-effect rounded-2xl p-4 text-center border border-pink-400/20">
            <div class="text-pink-400 text-sm mb-1">Genre</div>
            <div class="text-white font-semibold">{{ $movie['genre'] }}</div>
          </div>
        </div>

        <!-- Cast & Crew -->
        <div class="glass-effect rounded-2xl p-6 border border-white/10">
          <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-users text-purple-400"></i>
            Main Cast
          </h3>
          <div class="flex gap-4 overflow-x-auto pb-2">
            @foreach($movie['main_cast'] as $actor)
            <div class="flex-shrink-0 text-center">
              <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-sm mb-2">
                @php
                    $names = explode(' ', $actor);
                    $initials = '';
                    if(count($names) >= 2) {
                        $initials = substr($names[0], 0, 1) . substr($names[count($names)-1], 0, 1);
                    } else {
                        $initials = substr($actor, 0, 2);
                    }
                @endphp
                {{ $initials }}
              </div>
              <div class="text-xs text-gray-300 max-w-[80px]">{{ $actor }}</div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- Trailer Section -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="cyber-font text-3xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-play-circle text-cyan-400"></i>
            OFFICIAL TRAILER
            </h2>
        <div class="flex items-center gap-4">
        <span class="flex items-center gap-2 text-cyan-400">
            <i class="fas fa-eye"></i>
            <span class="text-sm">1.2M Views</span>
        </span>
        <button onclick="openTrailer('{{ $movie['trailer'] }}', '{{ $movie['title'] }}')" 
                class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center gap-2">
            <i class="fas fa-play"></i>
            PLAY TRAILER
        </button>
        </div>
    </div>

    <!-- Trailer Preview dengan Thumbnail -->
    <div class="relative rounded-2xl overflow-hidden border border-cyan-500/30 bg-black group cursor-pointer"
        onclick="openTrailer('{{ $movie['trailer'] }}', '{{ $movie['title'] }}')">
        
        <img src="{{ $movie['poster'] }}" 
            alt="{{ $movie['title'] }} Trailer" 
            class="w-full aspect-video object-cover group-hover:scale-105 transition duration-700">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/80 group-hover:bg-cyan-500/10 transition duration-300"></div>
        
        <div class="absolute inset-0 flex items-center justify-center">
        <div class="bg-cyan-500/90 group-hover:bg-cyan-600 text-white p-6 rounded-full transition-all duration-300 transform group-hover:scale-110 shadow-2xl">
            <i class="fas fa-play text-2xl"></i>
        </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white text-xl font-bold mb-2">{{ $movie['title'] }} - Official Trailer</h3>
        <p class="text-cyan-400 text-sm">Click to watch the full trailer</p>
        </div>
    </div>
    </section>

    <!-- Related Movies -->
    <section>
      <h2 class="cyber-font text-3xl font-bold text-white mb-8 flex items-center gap-3">
        <i class="fas fa-film text-pink-400"></i>
        YOU MIGHT ALSO LIKE
      </h2>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($movies->take(6) as $relatedMovie)
          @if($relatedMovie['id'] != $movie['id'])
          <a href="{{ route('movie.show', $relatedMovie['id']) }}" class="group">
            <div class="relative rounded-xl overflow-hidden bg-gradient-to-br from-gray-900 to-black border border-white/10 hover:border-cyan-500/30 transition-all duration-300 transform group-hover:-translate-y-2">
              <img src="{{ $relatedMovie['thumb'] }}" 
                   alt="{{ $relatedMovie['title'] }}" 
                   class="w-full aspect-[2/3] object-cover group-hover:scale-110 transition duration-500"
                   loading="lazy">
              
              <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                <div class="absolute bottom-0 p-3 w-full">
                  <h3 class="font-semibold text-white text-sm mb-1 line-clamp-2">{{ $relatedMovie['title'] }}</h3>
                  <p class="text-cyan-400 text-xs">{{ $relatedMovie['year'] }}</p>
                </div>
              </div>

              <div class="absolute top-2 right-2 bg-black/80 backdrop-blur-sm text-amber-400 text-xs font-bold px-2 py-1 rounded border border-amber-400/50">
                {{ rand(7, 9) }}.{{ rand(0, 9) }}
              </div>
            </div>
          </a>
          @endif
        @endforeach
      </div>
    </section>
  </div>
</div>

<!-- Modal Trailer - Sederhana tanpa tombol -->
<div id="trailerModal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" id="modalBackdrop"></div>
  
  <div class="relative w-full h-full flex items-center justify-center p-4">
    <!-- Modal Content -->
    <div class="relative w-full max-w-4xl bg-black rounded-xl overflow-hidden">
      <!-- Video Container -->
      <div class="aspect-video bg-black">
        <iframe id="trailerVideo" 
                class="w-full h-full" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen
                style="border: none;">
        </iframe>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('trailerModal');
    const iframe = document.getElementById('trailerVideo');
    const backdrop = document.getElementById('modalBackdrop');
    
    // Fungsi untuk membuka trailer
    window.openTrailer = function(trailerUrl, movieTitle) {
        const youtubeId = extractYouTubeId(trailerUrl);
        if (youtubeId) {
            const embedUrl = `https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&rel=0&modestbranding=1&showinfo=0&controls=1`;
            iframe.src = embedUrl;
        } else {
            iframe.src = trailerUrl;
        }
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup trailer
    window.closeTrailer = function() {
        iframe.src = '';
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Klik di luar modal untuk close
    backdrop.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        window.closeTrailer();
    });

    // ESC key untuk close
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            window.closeTrailer();
        }
    });

    // Klik di dalam modal (video) tidak close
    modal.querySelector('.relative').addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

function extractYouTubeId(url) {
    if (!url) return null;
    const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[7].length === 11) ? match[7] : null;
}
</script>
@endsection