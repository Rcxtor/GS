<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Game;

class UpdateSlugsSeeder extends Seeder
{
    public function run()
    {
        // Fetch all games
        $games = Game::all();

        foreach ($games as $game) {
            // Generate a new slug based on the title and ID
            $newSlug = Str::slug($game->title) . '-' . $game->id;

            // Update the game's slug
            $game->update([
                'slug' => $newSlug,
            ]);
        }
    }
}
