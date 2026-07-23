<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalPackage;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('account', 'user')->latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('account.game', 'user', 'rentalPackage');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate(['status' => 'required|string']);

        if ($request->status === 'confirmed') {
            if (!$transaction->rent_start) {
                $transaction->rent_start = now();
                if ($transaction->type === 'rent' && $transaction->rentalPackage) {
                    $transaction->rent_end = now()->addHours($transaction->rentalPackage->hours);
                }
            }
            $transaction->status = 'confirmed';
            $transaction->save();
            $transaction->account()->update(['status' => 'reserved']);
        } elseif ($request->status === 'completed' && $transaction->type === 'buy') {
            $transaction->update(['status' => 'completed', 'confirmed_at' => now()]);
            $transaction->account()->update(['status' => 'sold', 'sold_at' => now()]);
        } elseif ($request->status === 'completed' && $transaction->type === 'rent') {
            $transaction->update(['status' => 'completed']);
            $transaction->account()->update(['status' => 'available']);
        } else {
            $transaction->update(['status' => $request->status]);
        }

        return back()->with('success', 'Transaction updated.');
    }
}
