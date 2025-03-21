<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Movies extends Component
{

    public $movies = [];
    public $rawResponse;

    public function fetchMovies()
    {
        try {
            $response = Http::withHeaders([
                'x-rapidapi-key' => env('MOVIE_API_KEY'), // Replace with your actual API key
                'x-rapidapi-host' => 'movies-tv-shows-database.p.rapidapi.com',
                'Type' => 'get-shows-byyear'
            ])->get('https://movies-tv-shows-database.p.rapidapi.com/',
                [
                    'year' => 2023,
                    'page' => 1,
                    'limit' => 10
                ]
            );

            if ($response->successful()) {
                $result = $response->json(); 
                $this->movies = $result['tv_results']; 
                $this->errorMessage = ''; 
            } else {
                // Handle unsuccessful response (e.g., 404, 500)
                $this->errorMessage = 'Failed to fetch movies.  Status code: ' . $response->status();
                $this->movies = [];
            }

            $this->rawResponse = $response->json();
        } catch (\Exception $e) {
            // Handle network errors, timeouts, etc.
            $this->errorMessage = 'Error fetching movies: ' . $e->getMessage();
            $this->movies = [];
        }
    }

    

    public function render()
    {
        $this->fetchMovies(); // Fetch movies when the component is rendered
        return view('livewire.movies');
    }
}
