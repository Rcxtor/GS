<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist($gameId)
    {
        
        $userId = Auth::id();

        $exists = Wishlist::where('user_id', $userId)->where('game_id', $gameId)->exists();

        if (!$exists) {
        Wishlist::create([
            'user_id' => $userId,
            'game_id' => $gameId,
        ]);

        return redirect()->back()->with('success', 'Game added to wishlist!');
    }

    return redirect()->back()->with('error', 'Game is already in your wishlist!');
    }
    public function removeFromWishlist($gameId)
    {
        $userId = Auth::id();
        Wishlist::where('user_id', $userId)->where('game_id', $gameId)->delete();

        return redirect()->back()->with('success', 'Game removed from wishlist!');
    }

    public function showWishlist()
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('game')->paginate(8);


        return view('wishlist', compact('wishlists'));
    }
    public function filter(Request $request)
{
    $userId = Auth::id();
    $query = Wishlist::where('user_id', $userId)->with('game');

    // Selected filters
    $selectedFilters = [
        'price' => [],
        'genre' => [],
        'platform' => []
    ];

    // Filter by Price
    if ($request->has('price')) {
        $prices = $request->input('price');
        $query->whereHas('game', function ($query) use ($prices) {
            $query->where(function ($query) use ($prices) {
                foreach ($prices as $price) {
                    list($min, $max) = explode('-', $price);
                    $query->orWhere(function ($q) use ($min, $max) {
                        $q->where(function ($q) use ($min, $max) {
                            $q->where('on_sale', true)
                                ->whereRaw('(price - (price * (sale_per / 100))) BETWEEN ? AND ?', [(float)$min, (float)$max]);
                        })->orWhere(function ($q) use ($min, $max) {
                            $q->where('on_sale', false)
                                ->whereBetween('price', [(float)$min, (float)$max]);
                        });
                    });
                }
            });
        });
        $selectedFilters['price'] = $prices;
    }

    // Filter by Genre
    if ($request->has('genre')) {
        $genres = $request->input('genre');
        $query->whereHas('game', function ($query) use ($genres) {
            $query->whereIn('genre', $genres);
        });
        $selectedFilters['genre'] = $genres;
    }

    // Filter by Platform
    if ($request->has('platform')) {
        $platforms = $request->input('platform');
        $query->whereHas('game', function ($query) use ($platforms) {
            $query->whereIn('platform', $platforms);
        });
        $selectedFilters['platform'] = $platforms;
    }

    // Paginate the results
    $wishlists = $query->paginate(8);

    return view('wishlist', compact('wishlists', 'selectedFilters'));
    }

    public function search(Request $request)
    {
        $userId = Auth::id();
        $query = $request->input('search');
        
        $wishlists = Wishlist::where('user_id', $userId)
            ->whereHas('game', function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('platform', 'LIKE', "%{$query}%")
                ->orWhere('genre', 'LIKE', "%{$query}%");
            })
            ->with('game')
            ->paginate(8);
        return view('wishlist', compact('wishlists', 'query'));
    }

}
