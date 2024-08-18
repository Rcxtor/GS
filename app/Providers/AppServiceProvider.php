<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $wishlistCount = \App\Models\Wishlist::where('user_id', Auth::id())->count();
                $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                $view->with(compact('wishlistCount', 'cartCount'));
            }
        });
    }
}
