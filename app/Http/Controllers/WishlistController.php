<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $accounts = $request->user()->wishlists()->with('account.game', 'account.primaryImage')
            ->latest()->get()->pluck('account');

        return view('wishlist.index', compact('accounts'));
    }

    public function toggle(Request $request, Account $account)
    {
        $wishlist = $request->user()->wishlists()->where('account_id', $account->id)->first();

        if ($wishlist) {
            $wishlist->delete();
        } else {
            $request->user()->wishlists()->create(['account_id' => $account->id]);
        }

        return back();
    }
}
