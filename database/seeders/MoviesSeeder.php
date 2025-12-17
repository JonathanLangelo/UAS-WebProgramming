<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = require base_path('app/Data/movies.php');

        foreach ($movies as $movieData) {
            Movie::create([
                'title' => $movieData['title'],
                'year' => $movieData['year'],
                'genre' => $movieData['genre'],
                'poster' => $movieData['poster'],
                'thumb' => $movieData['thumb'],
                'trailer' => $movieData['trailer'],
                'description' => $movieData['description'],
                'main_cast' => $movieData['main_cast'],
            ]);
        }

        $this->command->info('Successfully seeded ' . count($movies) . ' movies!');
    }
}
