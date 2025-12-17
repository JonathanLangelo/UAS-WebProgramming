@extends('layouts.admin')

@section('title', 'Manage Movies')
@section('page-title', 'Movies Database')
@section('page-subtitle', 'Manage global movie catalog')

@section('content')
<div class="glass-panel rounded-2xl border border-gray-800 overflow-hidden">
    <div class="p-6 border-b border-gray-800 flex justify-between items-center bg-black/20">
        <div class="flex items-center gap-4">
            <h3 class="text-lg font-bold text-white">All Movies</h3>
            <span class="px-3 py-1 rounded-full bg-gray-800 text-xs text-gray-400 border border-gray-700">{{ $movies->total() }} entries</span>
        </div>
        <a href="{{ route('admin.movies.create') }}" class="btn-primary flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Add Movie</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-black/40">
                    <th class="w-20 pl-6">Poster</th>
                    <th>Title & Genre</th>
                    <th>Year</th>
                    <th class="text-right pr-6">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($movies as $movie)
                <tr class="group hover:bg-white/5 transition-colors">
                    <td class="pl-6 py-4">
                        <img src="{{ $movie->thumb }}" alt="{{ $movie->title }}" class="w-12 h-16 object-cover rounded-lg shadow-md group-hover:scale-105 transition-transform">
                    </td>
                    <td class="py-4">
                        <div class="font-bold text-white group-hover:text-cyan-400 transition-colors">{{ $movie->title }}</div>
                        <div class="text-sm text-gray-500">{{ $movie->genre }}</div>
                    </td>
                    <td class="py-4 text-gray-400 font-mono">{{ $movie->year }}</td>
                    <td class="py-4 pr-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.movies.edit', $movie) }}" class="p-2 text-gray-400 hover:text-cyan-400 hover:bg-cyan-400/10 rounded-lg transition-all" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Delete this movie?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-400/10 rounded-lg transition-all" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-20 text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-film text-4xl mb-4 opacity-50"></i>
                            <p>No movies found in database.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($movies->hasPages())
    <div class="p-4 border-t border-gray-800">
        {{ $movies->links('pagination::tailwind') }}
    </div>
    @endif
</div>
@endsection
