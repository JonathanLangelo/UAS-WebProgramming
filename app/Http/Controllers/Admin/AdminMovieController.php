<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function dashboard()
    {
        $totalMovies = Movie::count();
        $recentMovies = Movie::latest()->take(5)->get();

        // Calculate Genre Stats
        $allGenres = Movie::pluck('genre');
        $genreCounts = [];
        
        foreach ($allGenres as $genreStr) {
            $genres = explode(',', $genreStr);
            foreach ($genres as $genre) {
                $genre = trim($genre);
                if (!empty($genre)) {
                    if (!isset($genreCounts[$genre])) {
                        $genreCounts[$genre] = 0;
                    }
                    $genreCounts[$genre]++;
                }
            }
        }
        
        arsort($genreCounts);
        $genreLabels = array_keys(array_slice($genreCounts, 0, 5));
        $genreData = array_values(array_slice($genreCounts, 0, 5));

        return view('admin.dashboard', compact('totalMovies', 'recentMovies', 'genreLabels', 'genreData'));
    }

    /**
     * Display a listing of movies.
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(15);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new movie.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created movie.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'genre' => 'required|string|max:255',
            'poster' => 'required|url',
            'thumb' => 'required|url',
            'trailer' => 'required|url',
            'description' => 'required|string',
            'main_cast' => 'required|array',
            'main_cast.*' => 'required|string',
        ]);

        Movie::create($validated);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie created successfully!');
    }

    /**
     * Show the form for editing the specified movie.
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified movie.
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'genre' => 'required|string|max:255',
            'poster' => 'required|url',
            'thumb' => 'required|url',
            'trailer' => 'required|url',
            'description' => 'required|string',
            'main_cast' => 'required|array',
            'main_cast.*' => 'required|string',
        ]);

        $movie->update($validated);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified movie.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully!');
    }
}
