<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class OnSaleController extends Controller
{
    public function show()
    {
        $games = Game::paginate(10);
        return view('sale', compact('games'));
    }
    public function filter(Request $request)
    {
        $query = Game::where('on_sale', 1);

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
        

        return view('sale', compact('games', 'selectedFilters'));
    }
}
