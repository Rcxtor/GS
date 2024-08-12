<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class OnSaleController extends Controller
{
    public function show()
    {
        $games = Game::all();
        return view('sale', compact('games'));
    }
    // public function filter(Request $request)
    // {
    //     $query = Game::where('on_sale', 1);

    //     // Capture filter values
    //     $selectedPrices = $request->input('price', []);
    //     $selectedGenres = $request->input('genre', []);
    //     $selectedPlatforms = $request->input('platform', []);

    //     // Filter by Price
    //     if ($selectedPrices) {
    //         $query->where(function ($query) use ($selectedPrices) {
    //             foreach ($selectedPrices as $price) {
    //                 list($min, $max) = explode('-', $price);
    //                 $query->orWhereBetween('price', [(float)$min, (float)$max]);
    //             }
    //         });
    //     }

    //     // Filter by Genre
    //     if ($selectedGenres) {
    //         $query->whereIn('genre', $selectedGenres);
    //     }

    //     // Filter by Platform
    //     if ($selectedPlatforms) {
    //         $query->whereIn('platform', $selectedPlatforms);
    //     }

    //     $games = $query->get();

    //     return view('sale', compact('games', 'selectedPrices', 'selectedGenres', 'selectedPlatforms'));
    // }
    public function filter(Request $request)
{
    $query = Game::where('on_sale', 1);

    // Selected filters
    $selectedFilters = [
        'price' => [],
        'genre' => [],
        'platform' => []
    ];

    // Filter by Price
    if ($request->has('price')) {
        $prices = $request->input('price');
        $query->where(function ($query) use ($prices) {
            foreach ($prices as $price) {
                list($min, $max) = explode('-', $price);
                $query->orWhereBetween('price', [(float)$min, (float)$max]);
            }
        });
        $selectedFilters['price'] = $prices;
    }

    // Filter by Genre
    if ($request->has('genre')) {
        $genres = $request->input('genre');
        $query->whereIn('genre', $genres);
        $selectedFilters['genre'] = $genres;
    }

    // Filter by Platform
    if ($request->has('platform')) {
        $platforms = $request->input('platform');
        $query->whereIn('platform', $platforms);
        $selectedFilters['platform'] = $platforms;
    }

    $games = $query->get();

    return view('sale', compact('games', 'selectedFilters'));
}
}
