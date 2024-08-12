<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('welcome', compact('games'));
    }
}
