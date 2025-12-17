<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('home', ['movies' => $movies]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return redirect()->route('home');
        }

        $movies = Movie::where('title', 'LIKE', "%{$query}%")
                      ->orWhere('genre', 'LIKE', "%{$query}%")
                      ->get();

        return view('search', [
            'movies' => $movies,
            'query' => $query
        ]);
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $movies = Movie::all();
        
        return view('movie', [
            'movie' => $movie,
            'movies' => $movies 
        ]);
    }

    public function genres()
    {
        $movies = Movie::all();
        $genres = $movies->pluck('genre')->unique();

        return view('genres', [
            'genres' => $genres,
            'movies' => $movies
        ]);
    }

    public function trending()
    {
        $trending = Movie::latest()->take(4)->get();
        return view('trending', ['trending' => $trending]);
    }
}