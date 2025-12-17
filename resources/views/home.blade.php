@extends('layouts.app')

@section('title', 'CinePlex - Ultimate Movie Experience')

@section('content')
<!-- Hero Section with Particle Background -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <!-- Animated Particles -->
  <div class="absolute inset-0" id="particles-js"></div>
  
  <!-- Gradient Orbs -->
  <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse"></div>
  <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-pink-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    
    <!-- Main Title with Glitch Effect -->
    <div class="mb-8">
      <h1 class="cyber-font text-5xl sm:text-7xl lg:text-8xl xl:text-9xl font-black mb-6 leading-tight">
        <span class="bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-400 bg-clip-text text-transparent glitch" data-text="CINEPLEX">
          CINEPLEX
        </span>
      </h1>
      <p class="text-xl sm:text-2xl lg:text-3xl text-gray-300 mb-8 max-w-4xl mx-auto leading-relaxed">
        Welcome to the <span class="text-cyan-400 neon-text">Future of Cinema</span><br>
        Where Every Movie is an <span class="text-pink-400 neon-text">Experience</span>
      </p>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto mb-12">
      <div class="text-center">
        <div class="cyber-font text-2xl sm:text-3xl text-cyan-400 mb-2">{{ count($movies) }}+</div>
        <div class="text-gray-400 text-sm">BLOCKBUSTERS</div>
      </div>
      <div class="text-center">
        <div class="cyber-font text-2xl sm:text-3xl text-pink-400 mb-2">4K</div>
        <div class="text-gray-400 text-sm">QUALITY</div>
      </div>
      <div class="text-center">
        <div class="cyber-font text-2xl sm:text-3xl text-purple-400 mb-2">24/7</div>
        <div class="text-gray-400 text-sm">STREAMING</div>
      </div>
    </div>

    <!-- CTA Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
      <button class="group relative px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl font-semibold text-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/25">
        <span class="relative z-10 flex items-center gap-2">
          <i class="fas fa-rocket"></i>
          EXPLORE UNIVERSE
        </span>
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-700 rounded-xl blur group-hover:blur-md transition duration-300"></div>
      </button>
      
      <button onclick="scrollToFeatured()" class="group relative px-8 py-4 bg-transparent border-2 border-pink-500/50 rounded-xl font-semibold text-lg transition-all duration-300 hover:scale-105 hover:bg-pink-500/10 hover:border-pink-400">
        <span class="relative z-10 flex items-center gap-2">
          <i class="fas fa-play"></i>
          WATCH TRAILERS
        </span>
      </button>
    </div>
  </div>
  <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
    <div class="w-6 h-10 border-2 border-cyan-400 rounded-full flex justify-center">
      <div class="w-1 h-3 bg-cyan-400 rounded-full mt-2 animate-pulse"></div>
    </div>
  </div>
</section>

<!-- Featured Movies Carousel -->
<section id="featured" class="relative py-20 bg-gradient-to-b from-transparent to-gray-900/50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="text-center mb-16">
      <h2 class="cyber-font text-4xl md:text-5xl font-bold mb-6">
        <span class="bg-gradient-to-r from-cyan-400 to-pink-400 bg-clip-text text-transparent">
          FEATURED BLOCKBUSTERS
        </span>
      </h2>
      <p class="text-gray-400 text-lg max-w-2xl mx-auto">
        Curated selection of cinematic masterpieces that define modern storytelling
      </p>
    </div>

    <!-- Featured Movies Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 mb-20">
      @foreach($movies->take(3) as $movie)
      <div class="group relative rounded-2xl overflow-hidden transform transition-all duration-500 hover:scale-105">
        
        <!-- Hologram Effect -->
        <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 via-transparent to-pink-500/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
        
        <!-- Main Card -->
        <div class="relative glass-effect border border-cyan-500/20 rounded-2xl overflow-hidden h-full">
          <img src="{{ $movie['poster'] }}" 
               alt="{{ $movie['title'] }}" 
               class="w-full h-96 object-cover transform group-hover:scale-110 transition duration-700"
               loading="lazy">
          
          <!-- Overlay Content -->
          <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-500">
            <div class="absolute bottom-0 p-6 w-full">
              <h3 class="text-xl font-bold text-white mb-2">{{ $movie['title'] }}</h3>
              <p class="text-cyan-400 text-sm mb-3">{{ $movie['year'] }} • {{ $movie['genre'] }}</p>
              <p class="text-gray-300 text-sm mb-4 line-clamp-2">{{ $movie['description'] }}</p>
              
              <div class="flex gap-2">
                <!-- In the movie cards, update the trailer buttons: -->
                  <button onclick="openTrailer('{{ $movie['trailer'] }}', '{{ $movie['title'] }}')" 
                          class="flex-1 bg-cyan-500 hover:bg-cyan-600 text-white py-2 px-4 rounded-lg text-sm font-semibold transition flex items-center justify-center gap-2">
                    <i class="fas fa-play"></i> WATCH TRAILER
                  </button>
                <a href="{{ route('movie.show', $movie['id']) }}" 
                   class="flex-1 bg-transparent border border-pink-500 text-pink-400 hover:bg-pink-500/10 py-2 px-4 rounded-lg text-sm font-semibold text-center transition flex items-center justify-center gap-2">
                  <i class="fas fa-info-circle"></i> INFO
                </a>
              </div>
            </div>
          </div>

          <!-- Rating Badge -->
          <div class="absolute top-4 right-4">
            <div class="bg-black/80 backdrop-blur-sm text-amber-400 font-bold py-1 px-3 rounded-full border border-amber-400/50 flex items-center gap-1">
              <i class="fas fa-star text-amber-400"></i>
              {{ rand(7, 9) }}.<span class="text-pink-400">{{ rand(0, 9) }}</span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16"> <!-- UBAH mb-16 MENJADI mb-8 -->
        <div class="glass-effect rounded-2xl p-6 text-center border border-cyan-400/20">
            <div class="text-2xl text-cyan-400 mb-2">🎬</div>
            <div class="text-gray-400 text-sm">PREMIUM CONTENT</div>
        </div>
        <div class="glass-effect rounded-2xl p-6 text-center border border-pink-400/20">
            <div class="text-2xl text-pink-400 mb-2">🚀</div>
            <div class="text-gray-400 text-sm">NEXT-GEN TECH</div>
        </div>
        <div class="glass-effect rounded-2xl p-6 text-center border border-purple-400/20">
            <div class="text-2xl text-purple-400 mb-2">🌟</div>
            <div class="text-gray-400 text-sm">AWARD WINNING</div>
        </div>
        <div class="glass-effect rounded-2xl p-6 text-center border border-green-400/20">
            <div class="text-2xl text-green-400 mb-2">⚡</div>
            <div class="text-gray-400 text-sm">INSTANT STREAM</div>
        </div>
    </div>
  </div>
</section>

<!-- All Movies Section -->
<section class="py-16 bg-gradient-to-b from-gray-900/50 to-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="flex items-center justify-between mb-8">
      <div class="flex items-center gap-4">
        <div class="w-2 h-8 bg-gradient-to-b from-cyan-400 to-pink-400 rounded-full"></div>
        <h2 class="cyber-font text-3xl md:text-4xl font-bold text-white">
          MARVEL CINEMATIC UNIVERSE
        </h2>
      </div>
      
      <div class="flex items-center gap-4">
        <a href="{{ route('trending') }}" class="flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition">
          <span>VIEW TRENDING</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <!-- Movies Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
      @foreach($movies as $movie)
      <div class="group relative rounded-xl overflow-hidden bg-gradient-to-br from-gray-900 to-black border border-cyan-500/10 hover:border-cyan-500/30 transition-all duration-300 transform group-hover:-translate-y-2 h-full">
        <a href="{{ route('movie.show', $movie['id']) }}" class="block h-full">
          <img src="{{ $movie['thumb'] }}" 
               alt="{{ $movie['title'] }}" 
               class="w-full aspect-[2/3] object-cover group-hover:scale-110 transition duration-500"
               loading="lazy">
          
          <!-- Hologram Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
            <div class="absolute bottom-0 p-3 w-full">
              <h3 class="font-semibold text-white text-sm mb-1 line-clamp-2">{{ $movie['title'] }}</h3>
              <p class="text-cyan-400 text-xs">{{ $movie['year'] }}</p>
            </div>
          </div>
        </a>

        <!-- Digital Badge -->
        <div class="absolute top-2 right-2 bg-black/80 backdrop-blur-sm text-amber-400 text-xs font-bold px-2 py-1 rounded border border-amber-400/50">
          {{ rand(7, 9) }}.{{ rand(0, 9) }}
        </div>

        <!-- Quick Action - POSISI DIPERBAIKI -->
        <div class="absolute bottom-2 left-2 right-2 opacity-0 group-hover:opacity-100 transition duration-300 transform translate-y-2 group-hover:translate-y-0">
          <div class="flex gap-1">
            <button onclick="event.stopPropagation(); openTrailer('{{ $movie['trailer'] }}', '{{ $movie['title'] }}')" 
                    class="flex-1 bg-cyan-500 hover:bg-cyan-600 text-white py-1 px-2 rounded text-xs font-semibold transition flex items-center justify-center gap-1">
              <i class="fas fa-play text-[10px]"></i> 
              <span class="truncate">TRAILER</span>
            </button>
            <a href="{{ route('movie.show', $movie['id']) }}" 
               class="flex-1 bg-pink-500 hover:bg-pink-600 text-white py-1 px-2 rounded text-xs font-semibold transition flex items-center justify-center gap-1">
              <i class="fas fa-info text-[10px]"></i>
              <span class="truncate">INFO</span>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-16">
      <div class="glass-effect rounded-2xl p-8 border border-cyan-500/20 max-w-2xl mx-auto">
        <h3 class="cyber-font text-2xl md:text-3xl font-bold text-white mb-4">
          Ready to Dive In?
        </h3>
        <p class="text-gray-400 mb-6">
          Join thousands of movie enthusiasts experiencing the future of cinema
        </p>
        <a href="{{ route('genres') }}" 
           class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-pink-500 hover:from-cyan-600 hover:to-pink-600 text-white px-8 py-3 rounded-xl font-semibold transition transform hover:scale-105">
          <i class="fas fa-play-circle"></i>
          START EXPLORING
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Particles.js Configuration -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
  // Initialize particles
  particlesJS('particles-js', {
    particles: {
      number: { value: 80, density: { enable: true, value_area: 800 } },
      color: { value: "#00f0ff" },
      shape: { type: "circle" },
      opacity: { value: 0.5, random: true },
      size: { value: 3, random: true },
      line_linked: {
        enable: true,
        distance: 150,
        color: "#ff00c8",
        opacity: 0.4,
        width: 1
      },
      move: {
        enable: true,
        speed: 2,
        direction: "none",
        random: true,
        straight: false,
        out_mode: "out",
        bounce: false
      }
    },
    interactivity: {
      detect_on: "canvas",
      events: {
        onhover: { enable: true, mode: "repulse" },
        onclick: { enable: true, mode: "push" }
      }
    }
  });

  // Smooth scroll to featured section
  function scrollToFeatured() {
    document.getElementById('featured').scrollIntoView({ 
      behavior: 'smooth' 
    });
  }

  // Glitch effect
  document.addEventListener('DOMContentLoaded', function() {
    const glitch = document.querySelector('.glitch');
    setInterval(() => {
      glitch.style.transform = 'translate(' + (Math.random() * 4 - 2) + 'px, ' + (Math.random() * 4 - 2) + 'px)';
      setTimeout(() => {
        glitch.style.transform = 'translate(0, 0)';
      }, 100);
    }, 3000);
  });
</script>

<style>
  .glitch {
    position: relative;
    display: inline-block;
  }
  .glitch::before,
  .glitch::after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
  .glitch::before {
    left: 2px;
    text-shadow: -1px 0 #ff00c8;
    clip: rect(44px, 450px, 56px, 0);
    animation: glitch-anim 5s infinite linear alternate-reverse;
  }
  .glitch::after {
    left: -2px;
    text-shadow: -1px 0 #00f0ff; 
    clip: rect(44px, 450px, 56px, 0);
    animation: glitch-anim2 5s infinite linear alternate-reverse;
  }
  @keyframes glitch-anim {
    0% { clip: rect(42px, 9999px, 44px, 0); }
    5% { clip: rect(12px, 9999px, 59px, 0); }
    10% { clip: rect(48px, 9999px, 29px, 0); }
    15% { clip: rect(42px, 9999px, 73px, 0); }
    20% { clip: rect(63px, 9999px, 27px, 0); }
    25% { clip: rect(34px, 9999px, 55px, 0); }
    30% { clip: rect(86px, 9999px, 73px, 0); }
    35% { clip: rect(20px, 9999px, 20px, 0); }
    40% { clip: rect(26px, 9999px, 60px, 0); }
    45% { clip: rect(25px, 9999px, 66px, 0); }
    50% { clip: rect(57px, 9999px, 98px, 0); }
    55% { clip: rect(5px, 9999px, 46px, 0); }
    60% { clip: rect(82px, 9999px, 31px, 0); }
    65% { clip: rect(54px, 9999px, 27px, 0); }
    70% { clip: rect(28px, 9999px, 99px, 0); }
    75% { clip: rect(45px, 9999px, 69px, 0); }
    80% { clip: rect(23px, 9999px, 85px, 0); }
    85% { clip: rect(54px, 9999px, 84px, 0); }
    90% { clip: rect(45px, 9999px, 47px, 0); }
    95% { clip: rect(37px, 9999px, 20px, 0); }
    100% { clip: rect(4px, 9999px, 91px, 0); }
  }
  @keyframes glitch-anim2 {
    0% { clip: rect(65px, 9999px, 100px, 0); }
    5% { clip: rect(52px, 9999px, 74px, 0); }
    10% { clip: rect(79px, 9999px, 85px, 0); }
    15% { clip: rect(75px, 9999px, 5px, 0); }
    20% { clip: rect(67px, 9999px, 61px, 0); }
    25% { clip: rect(14px, 9999px, 79px, 0); }
    30% { clip: rect(1px, 9999px, 66px, 0); }
    35% { clip: rect(86px, 9999px, 30px, 0); }
    40% { clip: rect(23px, 9999px, 98px, 0); }
    45% { clip: rect(85px, 9999px, 72px, 0); }
    50% { clip: rect(71px, 9999px, 75px, 0); }
    55% { clip: rect(2px, 9999px, 48px, 0); }
    60% { clip: rect(30px, 9999px, 16px, 0); }
    65% { clip: rect(59px, 9999px, 50px, 0); }
    70% { clip: rect(41px, 9999px, 62px, 0); }
    75% { clip: rect(2px, 9999px, 82px, 0); }
    80% { clip: rect(47px, 9999px, 73px, 0); }
    85% { clip: rect(3px, 9999px, 27px, 0); }
    90% { clip: rect(26px, 9999px, 55px, 0); }
    95% { clip: rect(42px, 9999px, 97px, 0); }
    100% { clip: rect(38px, 9999px, 49px, 0); }
  }
</style>
@endsection