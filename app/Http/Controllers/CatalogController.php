<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Game;
use Illuminate\Http\Request;

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

    public function beli(Request $request)
    {
        $query = Account::with('game', 'primaryImage')
            ->where('status', 'available')
            ->whereNotNull('price_sell')
            ->whereNull('price_rent');

        if ($request->game && $game = Game::where('slug', $request->game)->first()) {
            $query->where('game_id', $game->id);
        }

        $accounts = $query->latest()->paginate(12);
        $games = Game::whereHas('accounts', fn($q) => $q->where('status', 'available')->whereNotNull('price_sell')->whereNull('price_rent'))->orderBy('name')->get();

        return view('beli.index', compact('accounts', 'games'));
    }

    public function beliShow(Account $account)
    {
        abort_if($account->status !== 'available' || !$account->price_sell || $account->price_rent, 404);
        $account->load('game', 'images', 'primaryImage');
        return view('beli.show', compact('account'));
    }

    public function sewa(Request $request)
    {
        $query = Account::with('game', 'primaryImage')
            ->where('status', 'available')
            ->whereNotNull('price_rent')
            ->whereNull('price_sell');

        if ($request->game && $game = Game::where('slug', $request->game)->first()) {
            $query->where('game_id', $game->id);
        }

        $accounts = $query->latest()->paginate(12);
        $games = Game::whereHas('accounts', fn($q) => $q->where('status', 'available')->whereNotNull('price_rent')->whereNull('price_sell'))->orderBy('name')->get();

        return view('sewa.index', compact('accounts', 'games'));
    }

    public function sewaShow(Account $account)
    {
        abort_if($account->status !== 'available' || !$account->price_rent || $account->price_sell, 404);
        $account->load('game', 'images', 'primaryImage');
        $packages = \App\Models\RentalPackage::where('is_active', true)->orderBy('sort_order')->get();
        return view('sewa.show', compact('account', 'packages'));
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
