<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($gameId)
    {
        
        $userId = Auth::id();

        $exists = Cart::where('user_id', $userId)->where('game_id', $gameId)->exists();

        if (!$exists) {
        Cart::create([
            'user_id' => $userId,
            'game_id' => $gameId,
        ]);
        Wishlist::where('user_id', $userId)->where('game_id', $gameId)->delete();

        return redirect()->back()->with('success', 'Game added to Cart!');
    }

    return redirect()->back()->with('error', 'Game is already in your Cart!');
    }

    public function showCart()
    {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->with('game')->paginate(8);
        $total = Cart::where('user_id', $userId)->with('game')->get()->sum(function ($cart) {
            if ($cart->game->sale_per) 
            {
                return $cart->game->price * (1 - $cart->game->sale_per / 100);
            } 
            else 
            {
                return $cart->game->price;
            }
        });


        return view('cart', compact('carts','total'));
    }
    public function removeFromCart($gameId)
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->where('game_id', $gameId)->delete();

        return redirect()->back()->with('success', 'Game removed from Cart!');
    }
}
