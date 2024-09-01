<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\GameDetails;
use App\Models\GameImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;



class DashboardController extends Controller
    {
        public function addProduct(Request $request)
        {
            // Validate the incoming request data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'youtube_trailer' => 'nullable|url',
                'extra_description' => 'nullable|string',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'release' => 'required|date',
                'platform' => 'required|string',
                'genre' => 'nullable|string',
                'developer' => 'nullable|string',
                'publisher' => 'nullable|string',
                'cover' => 'nullable|string',
                'image' => 'nullable|string',,
                'sale_date' => 'nullable|date',
                'sale_pre' => 'nullable|numeric',
                // 'coming' => 'nullable|boolean',
                'rating' => 'nullable|integer|min:1|max:5',
                
                // New validation rules for system requirements
                'os_min' => 'nullable|string',
                'os_rec' => 'nullable|string',
                'cpu_min' => 'nullable|string',
                'cpu_rec' => 'nullable|string',
                'ram_min' => 'nullable|string',
                'ram_rec' => 'nullable|string',
                'gpu_min' => 'nullable|string',
                'gpu_rec' => 'nullable|string',
                'storage_min' => 'nullable|string',
                'storage_rec' => 'nullable|string',
            ]);
            $product = Game::create([
                'title' => $validated['title'],
                'descrip' => $validated['description'],
                'price' => $validated['price'],
                'rating' => $validated['rating'],
                'quantity' => $validated['quantity'],
                'release' => $validated['release'],
                'platform' => $validated['platform'],
                'trailer' => $validated['youtube_trailer'],
                'dev' => $validated['developer'],
                'publisher' => $validated['publisher'],
                'extra' => $validated['extra_description'],
                'genre' => $validated['genre'],
                'featured' => $request->has('feature'),
                'on_sale' => $request->has('sale'),
                'sale_date' => $request->input('sale_date'),
                'sale_per' => $request->input('sale_pre'),
                'top_sale' => $request->has('top'),
                'coming_soon' => $request->has('coming'),
            ]);
            $product->slug = Str::slug($validated['title'] . '-' . $product->id);
            $product->save();
            
            $product->details()->create([
                'min_os' => $validated['os_min'],
                'req_os' => $validated['os_rec'],
                'min_cpu' => $validated['cpu_min'],
                'req_cpu' => $validated['cpu_rec'],
                'min_ram' => $validated['ram_min'],
                'req_ram' => $validated['ram_rec'],
                'min_gpu' => $validated['gpu_min'],
                'req_gpu' => $validated['gpu_rec'],
                'min_storage' => $validated['storage_min'],
                'req_storage' => $validated['storage_rec'],
            ]);
            return redirect()->back()->with('success', 'Product added successfully!');
        }
    }