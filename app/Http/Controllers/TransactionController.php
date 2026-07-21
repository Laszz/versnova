<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\ChatMessage;
use App\Models\RentalPackage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function beli(Account $account)
    {
        $account->load('game', 'primaryImage');
        abort_if($account->status !== 'available', 404);
        return view('transactions.beli', compact('account'));
    }

    public function storeBeli(Request $request, Account $account)
    {
        abort_if($account->status !== 'available', 403);

        $total = $account->discount_price ?? $account->price_sell;

        $transaction = Transaction::create([
            'account_id' => $account->id,
            'user_id' => $request->user()->id,
            'invoice_number' => 'GV-' . now()->format('Ymd') . '-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'type' => 'buy',
            'total_price' => $total,
            'status' => 'waiting_payment',
        ]);

        $account->update(['status' => 'reserved']);

        return redirect()->route('transactions.show', $transaction);
    }

    public function sewa(Request $request, Account $account)
    {
        $account->load('game', 'primaryImage');
        abort_if($account->status !== 'available', 404);
        $packages = RentalPackage::where('is_active', true)->orderBy('sort_order')->get();

        $selectedPackage = null;
        if ($request->package) {
            $selectedPackage = RentalPackage::find($request->package);
        }

        return view('transactions.sewa', compact('account', 'packages', 'selectedPackage'));
    }

    public function storeSewa(Request $request, Account $account)
    {
        abort_if($account->status !== 'available', 403);

        $data = $request->validate(['rental_package_id' => 'required|exists:rental_packages,id']);
        $package = RentalPackage::findOrFail($data['rental_package_id']);

        $transaction = Transaction::create([
            'account_id' => $account->id,
            'user_id' => $request->user()->id,
            'rental_package_id' => $package->id,
            'invoice_number' => 'GV-' . now()->format('Ymd') . '-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'type' => 'rent',
            'total_price' => $package->price,
            'status' => 'waiting_payment',
        ]);

        $account->update(['status' => 'reserved']);

        return redirect()->route('transactions.show', $transaction);
    }

    public function uploadBukti(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== $request->user()->id, 403);

        $data = $request->validate(['payment_proof' => 'required|image|max:2048']);
        $path = $data['payment_proof']->store('payments', 'public');

        $transaction->update([
            'payment_proof' => $path,
            'status' => 'waiting_confirmation',
        ]);

        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $name = $transaction->account->title;
            $inv = $transaction->invoice_number;
            if ($transaction->type === 'rent') {
                $package = $transaction->rentalPackage?->name ?? '-';
                $msg = "Saya sudah membayar untuk sewa akun $name ($package). Invoice: $inv";
            } else {
                $msg = "Saya sudah membayar untuk pembelian akun $name. Invoice: $inv";
            }
            ChatMessage::create([
                'sender_id' => $request->user()->id,
                'receiver_id' => $admin->id,
                'message' => $msg,
            ]);
        }

        return back()->with('success', 'Bukti pembayaran terkirim. Menunggu konfirmasi admin.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('account.game', 'account.primaryImage', 'rentalPackage');
        return view('transactions.show', compact('transaction'));
    }

    public function cancel(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== $request->user()->id, 403);
        abort_if($transaction->status !== 'waiting_payment', 403);

        $transaction->update(['status' => 'cancelled']);
        $transaction->account()->update(['status' => 'available']);

        return redirect()->route('riwayat')->with('success', 'Pesanan dibatalkan.');
    }

    public function riwayat(Request $request)
    {
        $transactions = Transaction::with('account.game')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(20);

        return view('transactions.riwayat', compact('transactions'));
    }
}
