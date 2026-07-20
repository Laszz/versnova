<?php

namespace App\Http\Controllers;

use App\Models\Account;

class FlashsaleController extends Controller
{
    public function index()
    {
        $flashsale = Account::with('game', 'primaryImage')
            ->where('status', 'available')
            ->whereNotNull('discount_until')
            ->where('discount_until', '>', now())
            ->latest()
            ->paginate(12);

        return view('flashsale.index', compact('flashsale'));
    }
}
