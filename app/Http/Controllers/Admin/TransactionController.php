<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $transaction->update(['status' => $request->status]);

        if ($request->status === 'confirmed') {
            $transaction->account()->update(['status' => 'reserved']);
        }

        return back()->with('success', 'Transaction updated.');
    }
}
