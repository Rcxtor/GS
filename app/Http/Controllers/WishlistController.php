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
}
