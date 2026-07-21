<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Game;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Account::with('game', 'primaryImage')
            ->where('status', 'available')
            ->latest()
            ->take(8)
            ->get();

        $recentSold = Account::with('game')
            ->whereIn('status', ['sold', 'rented'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $reviews = Review::with('user', 'transaction.account')
            ->where('is_approved', true)
            ->latest()
            ->take(10)
            ->get();

        $games = Game::orderBy('name')->get();

        return view('home', compact('featured', 'games', 'recentSold', 'reviews'));
    }
}
