<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Game;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $query = Account::with('game', 'primaryImage');

        if ($type === 'jual') {
            $query->whereNotNull('price_sell')->whereNull('price_rent');
        } elseif ($type === 'sewa') {
            $query->whereNotNull('price_rent')->whereNull('price_sell');
        }

        $accounts = $query->latest()->paginate(20);
        return view('admin.accounts.index', compact('accounts', 'type'));
    }

    public function create()
    {
        $games = Game::orderBy('name')->get();
        return view('admin.accounts.create', compact('games'));
    }

    public function store(Request $request)
    {
        $rules = $request->type === 'rent' ? [
            'price_rent' => 'required|numeric|min:0',
            'price_sell' => 'nullable',
        ] : [
            'price_sell' => 'required|numeric|min:0',
            'price_rent' => 'nullable',
        ];

        $data = $request->validate(array_merge($rules, [
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'nullable|string|max:100',
            'server' => 'nullable|string|max:100',
            'bind_status' => 'nullable|string|max:100',
            'login_method' => 'nullable|string|max:100',
            'level' => 'nullable|string|max:50',
            'skin_info' => 'nullable|string',
            'status' => 'required|string|in:available,reserved,sold,rented',
            'discount_amount' => 'nullable|numeric|min:0',
            'discount_until' => 'nullable|date',
            'discount_start' => 'nullable|date',
        ]));

        if ($request->filled('discount_amount') && $request->filled('price_sell')) {
            $data['discount_price'] = $request->price_sell - $request->discount_amount;
            $data['discount_percent'] = round(($request->discount_amount / $request->price_sell) * 100);
        }

        unset($data['discount_amount'], $data['type']);

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
            'discount_amount' => 'nullable|numeric|min:0',
            'discount_until' => 'nullable|date',
            'discount_start' => 'nullable|date',
            'status' => 'required|string|in:available,reserved,sold,rented',
        ]);

        if ($request->filled('discount_amount') && $request->filled('price_sell')) {
            $data['discount_price'] = $request->price_sell - $request->discount_amount;
            $data['discount_percent'] = round(($request->discount_amount / $request->price_sell) * 100);
        } else {
            $data['discount_percent'] = null;
            $data['discount_price'] = null;
            $data['discount_until'] = null;
            $data['discount_start'] = null;
        }

        unset($data['discount_amount']);

        $account->update($data);

        return redirect()->route('admin.accounts.index')->with('success', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Account deleted.');
    }
}
