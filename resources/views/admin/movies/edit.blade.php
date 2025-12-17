@extends('layouts.admin')

@section('title', 'Edit Movie')
@section('page-title', 'Edit Movie')
@section('page-subtitle', 'Update content details')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.movies.update', $movie) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="glass-panel p-6 rounded-2xl border border-gray-800">
            <h3 class="text-white font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-info-circle text-cyan-400"></i> Basic Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Movie Title</label>
                    <input type="text" name="title" value="{{ old('title', $movie->title) }}" required
                        class="w-full bg-black/40 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all font-bold placeholder-gray-600"
                        placeholder="e.g. Iron Man">
                    @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Release Year</label>
                    <input type="number" name="year" value="{{ old('year', $movie->year) }}" required min="1900" max="2100"
                        class="w-full bg-black/40 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all font-mono placeholder-gray-600"
                        placeholder="2008">
                    @error('year')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Genre -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Genre</label>
                    <input type="text" name="genre" value="{{ old('genre', $movie->genre) }}" required
                        class="w-full bg-black/40 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all placeholder-gray-600"
                        placeholder="Action, Sci-Fi">
                    @error('genre')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Description</label>
                    <textarea name="description" rows="4" required
                        class="w-full bg-black/40 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all placeholder-gray-600"
                        placeholder="Enter movie synopsis...">{{ old('description', $movie->description) }}</textarea>
                    @error('description')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-gray-800">
            <h3 class="text-white font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-photo-video text-purple-400"></i> Media Assets
            </h3>
            
            <div class="grid grid-cols-1 gap-6">
                <!-- Poster -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Poster URL (Vertical)</label>
                    <div class="flex gap-2">
                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-700 bg-gray-800/50 text-gray-500">
                            <i class="fas fa-image"></i>
                        </span>
                        <input type="url" name="poster" value="{{ old('poster', $movie->poster) }}" required
                            class="flex-1 bg-black/40 border border-gray-700 rounded-r-xl px-4 py-3 text-white focus:outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-400 transition-all placeholder-gray-600"
                            placeholder="https://...">
                    </div>
                </div>

                <!-- Thumb -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Thumbnail URL (Small)</label>
                    <div class="flex gap-2">
                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-700 bg-gray-800/50 text-gray-500">
                            <i class="fas fa-compress"></i>
                        </span>
                        <input type="url" name="thumb" value="{{ old('thumb', $movie->thumb) }}" required
                            class="flex-1 bg-black/40 border border-gray-700 rounded-r-xl px-4 py-3 text-white focus:outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-400 transition-all placeholder-gray-600"
                            placeholder="https://...">
                    </div>
                </div>

                <!-- Trailer -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Trailer URL (YouTube)</label>
                    <div class="flex gap-2">
                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-700 bg-gray-800/50 text-gray-500">
                            <i class="fab fa-youtube"></i>
                        </span>
                        <input type="url" name="trailer" value="{{ old('trailer', $movie->trailer) }}" required
                            class="flex-1 bg-black/40 border border-gray-700 rounded-r-xl px-4 py-3 text-white focus:outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-400 transition-all placeholder-gray-600"
                            placeholder="https://youtube.com/watch?v=...">
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-gray-800">
            <h3 class="text-white font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-users text-pink-400"></i> Main Cast
            </h3>
            
            <div id="cast-container" class="space-y-3">
                @foreach(old('main_cast', $movie->main_cast) as $cast)
                <div class="flex gap-3">
                    <input type="text" name="main_cast[]" value="{{ $cast }}" required
                        class="flex-1 bg-black/40 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-pink-400 focus:ring-1 focus:ring-pink-400 transition-all placeholder-gray-600"
                        placeholder="Actor Name">
                    @if(!$loop->first)
                    <button type="button" onclick="this.parentElement.remove()" class="p-3 text-gray-500 hover:text-red-400 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                    @endif
                </div>
                @endforeach
            </div>
            
            <button type="button" onclick="addCast()" class="mt-4 text-sm text-pink-400 hover:text-pink-300 font-medium flex items-center gap-2 transition-colors">
                <i class="fas fa-plus-circle"></i> Add Cast Member
            </button>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('admin.movies.index') }}" class="px-6 py-3 rounded-xl bg-gray-800 text-gray-400 hover:bg-gray-700 transition-colors font-medium">Cancel</a>
            <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-bold shadow-lg shadow-cyan-900/20 hover:shadow-cyan-900/40 hover:scale-105 transition-all">
                Update Movie
            </button>
        </div>
    </form>
</div>

<script>
    function addCast() {
        const container = document.getElementById('cast-container');
        const div = document.createElement('div');
        div.className = 'flex gap-3';
        div.innerHTML = `
            <input type="text" name="main_cast[]" required
                class="flex-1 bg-black/40 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-pink-400 focus:ring-1 focus:ring-pink-400 transition-all placeholder-gray-600"
                placeholder="Actor Name">
            <button type="button" onclick="this.parentElement.remove()" class="p-3 text-gray-500 hover:text-red-400 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
    }
</script>
@endsection
