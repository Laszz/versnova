<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Account::with('game', 'primaryImage')
            ->where('status', 'available')
            ->latest()
            ->take(8)
            ->get();

        $games = Game::orderBy('name')->get();

        return view('home', compact('featured', 'games'));
    }
}
