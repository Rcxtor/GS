<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\GameDetails;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
    // $product = Game::where('slug', $slug)->firstOrFail();
    $product = Game::where('slug', $slug)->first();
    if($product)
        {
            return view('product', compact('product'));
        }
    else
        {
            return redirect()->route('welcome');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $games = Game::where('title', 'LIKE', "%{$query}%")
                            ->orwhere('platform', 'LIKE', "%{$query}%")
                            ->orwhere('genre', 'LIKE', "%{$query}%")
                            ->get();
        return view('search', compact('games','query'));
    }

}
