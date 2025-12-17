<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminMovieController;

// Public Routes
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');
Route::get('/genres', [MovieController::class, 'genres'])->name('genres');
Route::get('/trending', [MovieController::class, 'trending'])->name('trending');
Route::get('/search', [MovieController::class, 'search'])->name('search');
Route::get('/filter/{genre}', [MovieController::class, 'filterByGenre'])->name('filter.genre');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminMovieController::class, 'dashboard'])->name('dashboard');
    Route::resource('movies', AdminMovieController::class);
});