<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Game;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('game', 'primaryImage')->latest()->paginate(20);
        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        $games = Game::orderBy('name')->get();
        return view('admin.accounts.create', compact('games'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'nullable|string|max:100',
            'server' => 'nullable|string|max:100',
            'bind_status' => 'nullable|string|max:100',
            'login_method' => 'nullable|string|max:100',
            'level' => 'nullable|string|max:50',
            'skin_info' => 'nullable|string',
            'price_sell' => 'nullable|numeric|min:0',
            'price_rent' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:available,reserved,sold,rented',
        ]);

        Account::create($data);

        return redirect()->route('admin.accounts.index')->with('success', 'Account created.');
    }

    public function show(Account $account)
    {
        $account->load('game', 'images', 'transactions.user');
        return view('admin.accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        $games = Game::orderBy('name')->get();
        return view('admin.accounts.edit', compact('account', 'games'));
    }

    public function update(Request $request, Account $account)
    {
        $data = $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'nullable|string|max:100',
            'server' => 'nullable|string|max:100',
            'bind_status' => 'nullable|string|max:100',
            'login_method' => 'nullable|string|max:100',
            'level' => 'nullable|string|max:50',
            'skin_info' => 'nullable|string',
            'price_sell' => 'nullable|numeric|min:0',
            'price_rent' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:available,reserved,sold,rented',
        ]);

        $account->update($data);

        return redirect()->route('admin.accounts.index')->with('success', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Account deleted.');
    }
}
