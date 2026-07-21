<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== $request->user()->id, 403);
        abort_if($transaction->status !== 'completed', 403);
        abort_if($transaction->review()->exists(), 403);

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => $request->user()->id,
            'transaction_id' => $transaction->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        return back()->with('success', 'Review terkirim. Terima kasih!');
    }
}
