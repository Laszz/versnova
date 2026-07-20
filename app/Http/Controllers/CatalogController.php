<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Game;

class CatalogController extends Controller
{
    public function index()
    {
        $accounts = Account::with('game', 'primaryImage')
            ->where('status', 'available')
            ->latest()
            ->paginate(12);

        $games = Game::orderBy('name')->get();

        return view('katalog.index', compact('accounts', 'games'));
    }

    public function game(Game $game)
    {
        $accounts = Account::with('game', 'primaryImage')
            ->where('game_id', $game->id)
            ->where('status', 'available')
            ->latest()
            ->paginate(12);

        $games = Game::orderBy('name')->get();

        return view('katalog.index', compact('accounts', 'games', 'game'));
    }

    public function show(Account $account)
    {
        $account->load('game', 'images', 'primaryImage');

        $related = Account::with('game', 'primaryImage')
            ->where('game_id', $account->game_id)
            ->where('id', '!=', $account->id)
            ->where('status', 'available')
            ->take(4)
            ->get();

        return view('katalog.show', compact('account', 'related'));
    }
}
