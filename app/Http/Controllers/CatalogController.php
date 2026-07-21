<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Game;
use App\Models\RentalPackage;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function produk(Request $request)
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

        return view('produk.index', compact('accounts', 'games'));
    }

    public function produkShow(Account $account)
    {
        abort_if($account->status !== 'available' || !$account->price_sell || $account->price_rent, 404);
        $account->load('game', 'images', 'primaryImage');
        return view('produk.show', compact('account'));
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
        $packages = RentalPackage::where('is_active', true)->orderBy('sort_order')->get();
        return view('sewa.show', compact('account', 'packages'));
    }

    public function show(Account $account)
    {
        if ($account->price_sell && !$account->price_rent) {
            return redirect()->route('produk.show', $account);
        }
        if ($account->price_rent && !$account->price_sell) {
            return redirect()->route('sewa.show', $account);
        }
        abort(404);
    }
}
