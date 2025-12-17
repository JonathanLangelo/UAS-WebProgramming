<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'CinePlex - Ultimate Movie Experience')</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            cyan: {
              400: '#00f0ff',
            },
            pink: {
              400: '#ff00c8',
            },
             purple: {
              400: '#b400ff',
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
  {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
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
      overflow-x: hidden;
    }
    
    .cyber-font { 
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 0.05em;
    }
    
    .neon-glow {
      box-shadow: 
        0 0 10px var(--neon-cyan),
        0 0 20px var(--neon-cyan),
        inset 0 0 10px rgba(0, 240, 255, 0.1);
    }
    
    .neon-text {
      text-shadow: 
        0 0 10px currentColor,
        0 0 20px currentColor,
        0 0 40px currentColor;
    }
    
    .glass-effect {
      background: rgba(10, 10, 15, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .hologram-border {
      border: 1px solid transparent;
      background: linear-gradient(45deg, var(--dark-bg), var(--dark-bg)) padding-box,
                  linear-gradient(45deg, var(--neon-cyan), var(--neon-pink), var(--neon-purple)) border-box;
    }
  </style>
</head>

<body class="text-white">
  <!-- Animated Background -->
  <div class="fixed inset-0 z-0 opacity-30">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?q=80&w=2071')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-black via-purple-900/20 to-cyan-900/20"></div>
  </div>

  <!-- Enhanced Navbar -->
  <nav class="fixed top-0 w-full z-50 glass-effect border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <div class="relative">
            <div class="w-3 h-3 bg-gradient-to-r from-cyan-400 to-pink-400 rounded-full neon-glow"></div>
            <div class="absolute -inset-1 bg-cyan-400 rounded-full blur opacity-75 animate-pulse"></div>
          </div>
          <a href="{{ route('home') }}" class="cyber-font text-2xl font-black">
            <span class="bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent neon-text">
              CINEPLEX
            </span>
          </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-1">
          <a href="{{ route('home') }}" 
             class="relative px-6 py-2 rounded-full font-medium transition-all duration-300 
                    {{ request()->routeIs('home') ? 'text-cyan-400 neon-text' : 'text-gray-300 hover:text-white' }}">
            <span>HOME</span>
            @if(request()->routeIs('home'))
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-cyan-400 rounded-full neon-glow"></div>
            @endif
          </a>
          
          <a href="{{ route('genres') }}" 
             class="relative px-6 py-2 rounded-full font-medium transition-all duration-300 
                    {{ request()->routeIs('genres') ? 'text-pink-400 neon-text' : 'text-gray-300 hover:text-white' }}">
            <span>GENRES</span>
            @if(request()->routeIs('genres'))
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-pink-400 rounded-full neon-glow"></div>
            @endif
          </a>
          
          <a href="{{ route('trending') }}" 
             class="relative px-6 py-2 rounded-full font-medium transition-all duration-300 
                    {{ request()->routeIs('trending') ? 'text-purple-400 neon-text' : 'text-gray-300 hover:text-white' }}">
            <span>TRENDING</span>
            @if(request()->routeIs('trending'))
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-purple-400 rounded-full neon-glow"></div>
            @endif
          </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button id="mobile-menu-btn" class="p-2 rounded-lg glass-effect border border-white/10">
            <i class="fas fa-bars text-cyan-400"></i>
          </button>
        </div>

        <!-- Search & Actions -->
        <div class="hidden md:flex items-center space-x-4">
          <form action="{{ route('search') }}" method="GET" class="relative group">
            <input type="text" 
                   name="q"
                   placeholder="Search movies..." 
                   value="{{ request('q') }}"
                   class="w-48 px-4 py-2 bg-black/50 border border-cyan-400/30 rounded-full 
                          text-sm focus:outline-none focus:border-cyan-400 focus:neon-glow
                          transition-all duration-300">
            <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-cyan-400/60 hover:text-cyan-400 transition-colors">
              <i class="fas fa-search"></i>
            </button>
          </form>
          
          <a href="{{ route('login') }}" class="p-2 rounded-lg glass-effect border border-white/10 hover:border-cyan-400/50 transition">
            <i class="fas fa-user text-cyan-400"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-16 left-0 w-full glass-effect border-t border-white/10">
      <div class="px-4 py-4 space-y-3">
        <a href="{{ route('home') }}" 
           class="block px-4 py-3 rounded-lg {{ request()->routeIs('home') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-300 hover:bg-white/5' }} transition">
          <i class="fas fa-home mr-3"></i>Home
        </a>
        <a href="{{ route('genres') }}" 
           class="block px-4 py-3 rounded-lg {{ request()->routeIs('genres') ? 'bg-pink-400/10 text-pink-400' : 'text-gray-300 hover:bg-white/5' }} transition">
          <i class="fas fa-film mr-3"></i>Genres
        </a>
        <a href="{{ route('trending') }}" 
           class="block px-4 py-3 rounded-lg {{ request()->routeIs('trending') ? 'bg-purple-400/10 text-purple-400' : 'text-gray-300 hover:bg-white/5' }} transition">
          <i class="fas fa-fire mr-3"></i>Trending
        </a>
        
        <!-- Mobile Search -->
        <div class="px-4 py-3">
          <form action="{{ route('search') }}" method="GET">
            <input type="text" 
                   name="q"
                   placeholder="Search movies..." 
                   value="{{ request('q') }}"
                   class="w-full px-4 py-2 bg-black/50 border border-cyan-400/30 rounded-full 
                          text-sm focus:outline-none focus:border-cyan-400">
          </form>
        </div>
      </div>
    </div>
  </nav>

  <main class="relative z-10 pt-16">
    @yield('content')
  </main>

  <!-- Enhanced Footer -->
  <footer class="relative z-10 glass-effect border-t border-white/10 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center">
        <!-- Logo -->
        <div class="cyber-font text-2xl font-black mb-4">
          <span class="bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
            CINEPLEX
          </span>
        </div>
        
        <!-- Credit -->
        <p class="text-gray-400 mb-6">
          Ultimate Movie Experience Platform<br>
          <span class="text-cyan-400 font-semibold">By Jonathan Immanuel Mazar Langelo</span>
        </p>
        
        <!-- Tech Stack -->
        <div class="flex justify-center items-center space-x-6 text-sm text-gray-500 mb-6">
          <span class="flex items-center space-x-2">
            <i class="fab fa-laravel text-red-500"></i>
            <span>Laravel</span>
          </span>
          <span class="flex items-center space-x-2">
            <i class="fab fa-js-square text-yellow-400"></i>
            <span>JavaScript</span>
          </span>
          <span class="flex items-center space-x-2">
            <i class="fab fa-css3-alt text-blue-500"></i>
            <span>Tailwind CSS</span>
          </span>
        </div>
        
        <!-- Copyright -->
        <p class="text-gray-600 text-sm">
          © {{ date('Y') }} CinePlex • Project UTS Web Programming
        </p>
      </div>
    </div>
  </footer>

  <!-- Mobile Menu Script -->
  <script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
        mobileMenu.classList.add('hidden');
      }
    });
  </script>

  <!-- Include your existing trailer modal and scripts here -->
   <!-- Enhanced Trailer Modal -->
    <div id="trailer-modal" class="hidden fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4">
      <div class="relative w-full max-w-6xl aspect-video">
        <!-- Background Glow -->
        <div class="absolute -inset-4 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-2xl blur-xl opacity-20 animate-pulse"></div>
        
        <!-- Main Modal -->
        <div class="relative bg-gray-900 rounded-2xl overflow-hidden border border-cyan-500/30 shadow-2xl">
          <!-- Modal Header -->
          <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-900 to-black border-b border-cyan-500/20">
            <div class="flex items-center gap-3">
              <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse"></div>
              <span class="text-white font-semibold" id="trailer-title">Now Playing</span>
            </div>
            <button onclick="closeTrailer()" 
                    class="text-gray-400 hover:text-white transition transform hover:scale-110 hover:rotate-90 duration-300">
              <i class="fas fa-times text-2xl"></i>
            </button>
          </div>

          <!-- Trailer Container -->
          <div class="relative aspect-video bg-black">
            <!-- Loading Spinner -->
            <div id="trailer-loading" class="absolute inset-0 flex items-center justify-center bg-gray-900">
              <div class="text-center">
                <div class="w-16 h-16 border-4 border-cyan-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-cyan-400 font-semibold">Loading Trailer...</p>
              </div>
            </div>

            <!-- YouTube Iframe -->
            <iframe id="trailer-iframe" 
                    class="w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy">
            </iframe>
          </div>

          <!-- Modal Footer -->
          <div class="p-4 bg-gradient-to-r from-gray-900 to-black border-t border-cyan-500/20">
            <div class="flex items-center justify-between text-sm text-gray-400">
              <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                  <i class="fas fa-play text-cyan-400"></i>
                  <span id="trailer-movie-title">Movie Trailer</span>
                </span>
                <span class="flex items-center gap-1">
                  <i class="fas fa-clock text-pink-400"></i>
                  <span>2:30</span>
                </span>
              </div>
              <div class="flex items-center gap-2">
                <button onclick="toggleMute()" class="p-2 hover:bg-white/10 rounded transition" id="mute-btn">
                  <i class="fas fa-volume-up"></i>
                </button>
                <button onclick="toggleFullscreen()" class="p-2 hover:bg-white/10 rounded transition">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    // Enhanced Trailer Functions
    let isMuted = false;
    let currentIframe = null;

    function openTrailer(url, movieTitle = 'Movie Trailer') {
      const modal = document.getElementById('trailer-modal');
      const iframe = document.getElementById('trailer-iframe');
      const loading = document.getElementById('trailer-loading');
      const titleElement = document.getElementById('trailer-movie-title');
      
      // Set movie title
      titleElement.textContent = movieTitle;
      
      // Show loading
      loading.classList.remove('hidden');
      modal.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
      
      // Extract YouTube ID
      const videoId = extractYouTubeId(url);
      if (!videoId) {
        alert('Invalid trailer URL');
        closeTrailer();
        return;
      }
      
      // Construct embed URL with parameters
      const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1&playsinline=1&enablejsapi=1`;
      
      // Set iframe source
      iframe.src = embedUrl;
      currentIframe = iframe;
      
      // Hide loading when video loads
      iframe.onload = () => {
        loading.classList.add('hidden');
        // Add entrance animation
        gsap.fromTo(iframe, 
          { opacity: 0, scale: 0.9 },
          { opacity: 1, scale: 1, duration: 0.5, ease: "back.out(1.7)" }
        );
      };
      
      // Modal entrance animation
      gsap.fromTo(modal, 
        { opacity: 0 },
        { opacity: 1, duration: 0.3 }
      );
    }

    function closeTrailer() {
      const modal = document.getElementById('trailer-modal');
      const iframe = document.getElementById('trailer-iframe');
      const loading = document.getElementById('trailer-loading');
      
      // Exit animation
      gsap.to(modal, {
        opacity: 0,
        duration: 0.3,
        onComplete: () => {
          modal.classList.add('hidden');
          iframe.src = '';
          loading.classList.remove('hidden');
          document.body.classList.remove('overflow-hidden');
          isMuted = false;
          updateMuteButton();
        }
      });
    }

    function extractYouTubeId(url) {
      const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
      const match = url.match(regExp);
      return (match && match[7].length === 11) ? match[7] : null;
    }

    function toggleMute() {
      if (currentIframe) {
        isMuted = !isMuted;
        currentIframe.contentWindow.postMessage(JSON.stringify({
          event: 'command',
          func: isMuted ? 'mute' : 'unMute',
          args: []
        }), '*');
        updateMuteButton();
      }
    }

    function updateMuteButton() {
      const muteBtn = document.getElementById('mute-btn');
      muteBtn.innerHTML = isMuted ? 
        '<i class="fas fa-volume-mute"></i>' : 
        '<i class="fas fa-volume-up"></i>';
    }

    function toggleFullscreen() {
      const iframe = document.getElementById('trailer-iframe');
      if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
      } else if (iframe.webkitRequestFullscreen) {
        iframe.webkitRequestFullscreen();
      } else if (iframe.mozRequestFullScreen) {
        iframe.mozRequestFullScreen();
      }
    }

    // Close modal on ESC key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeTrailer();
    });

    // Close modal when clicking outside
    document.getElementById('trailer-modal').addEventListener('click', (e) => {
      if (e.target.id === 'trailer-modal') closeTrailer();
    });
    </script>
</body>
</html>