<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Game;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private function sanitizeNumeric(Request $request, array $fields): void
    {
        foreach ($fields as $f) {
            if ($request->has($f) && is_string($request->$f)) {
                $request->merge([$f => str_replace('.', '', $request->$f)]);
            }
        }
    }

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
        $this->sanitizeNumeric($request, ['price_sell', 'price_rent', 'discount_amount']);

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
            $data['discount_price'] = (float)$request->price_sell - (float)$request->discount_amount;
            $data['discount_percent'] = round(((float)$request->discount_amount / (float)$request->price_sell) * 100);
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
        $this->sanitizeNumeric($request, ['price_sell', 'price_rent', 'discount_amount']);

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

        $rawDisc = $request->input('discount_amount');
        $rawPrice = $request->input('price_sell');

        if ($rawDisc !== null && $rawDisc !== '' && (float)$rawDisc > 0 && $rawPrice !== null && $rawPrice !== '' && (float)$rawPrice > 0) {
            $data['discount_price'] = (float)$rawPrice - (float)$rawDisc;
            $data['discount_percent'] = round(((float)$rawDisc / (float)$rawPrice) * 100);
        } else {
            $data['discount_percent'] = null;
            $data['discount_price'] = null;
            $data['discount_until'] = null;
            $data['discount_start'] = null;
        }

        unset($data['discount_amount']);

        $account->update($data);

        return redirect()->route('admin.accounts.index')->with('success', 'Akun berhasil diupdate & disimpan.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Account deleted.');
    }
}
