<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OnSaleController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchedController;
use App\Http\Controllers\WishlistController;

use Illuminate\Support\Facades\Route;

// Add product
Route::middleware(['auth', 'verified', \App\Http\Middleware\CheckAdmin::class])->get('/add-product', function () {
    return view('dashboard.add');
})->name('addProduct');

// Browse
Route::get('/browse', [BrowseController::class, 'show'])->name('browse');
Route::get('/browse', [BrowseController::class, 'filter'])->name('browse');
Route::get('/genre/{genre}', [BrowseController::class, 'filterByGenre'])->name('genre.filter');


// Cart

Route::middleware(['auth'])->group(function () 
{
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add/{game}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{game}', [CartController::class, 'removeFromCart'])->name('cart.remove');

});


// Dashboard
Route::middleware(['auth', 'verified', \App\Http\Middleware\CheckAdmin::class])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Dicover
// Route::get('/', function () {return view('welcome');})->name('welcome');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/product', function () {return redirect('/');});

//New Released
Route::get('/new-release', [ReleaseController::class, 'show'])->name('release');
Route::get('/new-release', [ReleaseController::class, 'filter'])->name('release');


//On Sale
Route::get('/on-sale', [OnSaleController::class, 'show'])->name('sale.show');
Route::get('/on-sale', [OnSaleController::class, 'filter'])->name('sale');


// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

});

// Product
// Route::get('/product/{id}',[ProductController::class,'show'])->name('product.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

//Searched
Route::get('/searched', [ProductController::class, 'search'])->name('searched');

// Wishlist
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist/filter', [WishlistController::class, 'filter'])->name('wishlist.filter');
    Route::get('/wishlist/search', [WishlistController::class, 'search'])->name('wishlist.search');
    Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
    Route::post('/wishlist/add/{game}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove/{game}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
});


require __DIR__.'/auth.php';
