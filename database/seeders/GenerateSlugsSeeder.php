<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;

class GenerateSlugsSeeder extends Seeder
{
    public function run()
    {
        // Get all games
        $games = Game::all();

        // Iterate through each game and update the slug
        foreach ($games as $game) {
            $game->slug = Str::slug($game->title);
            $game->save();
        }
    }
}

