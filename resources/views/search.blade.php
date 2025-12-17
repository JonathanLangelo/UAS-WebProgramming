@extends('layouts.app')

@section('title', 'Search Results - CinePlex')

@section('content')
<div class="min-h-screen pt-8 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Search Header -->
    <div class="mb-12">
      <h1 class="text-3xl font-bold text-white mb-4">
        Search Results for <span class="text-cyan-400">"{{ $query }}"</span>
      </h1>
      <p class="text-gray-400">
        Found {{ count($movies) }} matches for your query.
      </p>
    </div>

    <!-- Results Grid -->
    @if(count($movies) > 0)
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($movies as $movie)
          <div class="group relative rounded-xl overflow-hidden transition-all duration-500 hover:scale-105">
            <!-- Main Card -->
            <div class="relative bg-gradient-to-br from-gray-900 to-black border border-white/10 rounded-xl overflow-hidden h-full">
              <a href="{{ route('movie.show', $movie->id) }}">
                <img src="{{ $movie->thumb }}" 
                     alt="{{ $movie->title }}" 
                     class="w-full aspect-[2/3] object-cover group-hover:scale-110 transition duration-700"
                     loading="lazy">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-0 p-3 w-full">
                    <h3 class="font-semibold text-white text-sm mb-1 line-clamp-2">{{ $movie->title }}</h3>
                    <p class="text-cyan-400 text-xs">{{ $movie->year }} • {{ Str::limit($movie->genre, 15) }}</p>
                  </div>
                </div>
              </a>

              <!-- Quick Actions -->
              <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition duration-300">
                <button onclick="openTrailer('{{ $movie->trailer }}', '{{ $movie->title }}')" 
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
    @else
      <div class="text-center py-20">
        <div class="inline-flex items-center justify-center p-6 rounded-full border border-gray-800 bg-gray-900/50 mb-6">
          <i class="fas fa-search text-4xl text-gray-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-white mb-2">No matches found</h2>
        <p class="text-gray-400 mb-8">We couldn't find any movies matching "{{ $query }}". Try different keywords.</p>
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-cyan-600 text-white hover:bg-cyan-500 transition-colors">
          Back to Home
        </a>
      </div>
    @endif
  </div>
</div>
@endsection
