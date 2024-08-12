<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class ReleaseController extends Controller
{
    public function show()
    {
        $games = Game::all();
        return view('release', compact('games'));
    }

    public function filter(Request $request)
    {
        $query = Game::where('featured', 1);

        // Filter by Price
        if ($request->has('price')) {
            $prices = $request->input('price');
            $query->where(function ($query) use ($prices) {
                foreach ($prices as $price) {
                    list($min, $max) = explode('-', $price);
                    $query->orWhereBetween('price', [(float)$min, (float)$max]);
                }
            });
        }

        // Filter by Genre
        if ($request->has('genre')) {
            $genres = $request->input('genre');
            $query->whereIn('genre', $genres);
        }

        // Filter by Platform
        if ($request->has('platform')) {
            $platforms = $request->input('platform');
            $query->whereIn('platform', $platforms);
        }

        $games = $query->get();

        return view('release', compact('games'));
    }
}
