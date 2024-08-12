<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function show()
    {
        // $games = Game::all();
        $games = Game::paginate(10); 
        return view('browse', compact('games'));
    }

    public function filter(Request $request)
    {
        $query = Game::query();

        // Selected filters
        $selectedFilters = 
        [
            'price' => [],
            'genre' => [],
            'platform' => []
        ];

        // Filter by Price
        // if ($request->has('price')) 
        // {
        //     $prices = $request->input('price');
        //     $query->where(function ($query) use ($prices) {
        //         foreach ($prices as $price) {
        //             list($min, $max) = explode('-', $price);
        //             $query->orWhereBetween('price', [(float)$min, (float)$max]);
        //         }
        //     });
        //     $selectedFilters['price'] = $prices;
        // }
        if ($request->has('price')) 
        {
            $prices = $request->input('price');
            $query->where(function ($query) use ($prices) {
                foreach ($prices as $price) {
                    list($min, $max) = explode('-', $price);
                    $query->where(function ($query) use ($min, $max) {
                        $query->where(function ($q) use ($min, $max) {
                            $q->where('on_sale', true)
                            ->whereRaw('(price - (price * (sale_per / 100))) BETWEEN ? AND ?', [(float)$min, (float)$max]);
                        })->orWhere(function ($q) use ($min, $max) {
                            $q->where('on_sale', false)
                            ->whereBetween('price', [(float)$min, (float)$max]);
                        });
                    });
                }
            });
            $selectedFilters['price'] = $prices;
        }

        // Filter by Genre
        if ($request->has('genre')) 
        {
            $genres = $request->input('genre');
            $query->whereIn('genre', $genres);
            $selectedFilters['genre'] = $genres;
        }

        // Filter by Platform
        if ($request->has('platform')) 
        {
            $platforms = $request->input('platform');
            $query->whereIn('platform', $platforms);
            $selectedFilters['platform'] = $platforms;
        }

        // $games = $query->get();
        $games = $query->paginate(10);

        return view('browse', compact('games','selectedFilters'));
    }

    public function filterByGenre($genre)
    {
        $query = Game::query();

        // Selected filters
        $selectedFilters = 
        [
            'genre' => [$genre],
        ];

        $games = Game::where('genre', $genre)->paginate(10);
        return view('browse', compact('games','selectedFilters'));
    }
}
