<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\Transaction;
use App\Models\User;

class RentalController extends Controller
{
    public function index()
    {
        now()->subMinute();

        $admin = User::where('is_admin', true)->first();

        Transaction::where('type', 'rent')
            ->where('status', 'confirmed')
            ->whereNotNull('rent_end')
            ->where('rent_end', '<', now())
            ->each(function ($t) use ($admin) {
                $t->update(['status' => 'completed']);
                $t->account()->update(['status' => 'available']);

                if ($admin) {
                    ChatMessage::create([
                        'sender_id' => $admin->id,
                        'receiver_id' => $t->user_id,
                        'message' => "Waktu sewa {$t->account->title} ({$t->rentalPackage?->name}) sudah habis. Terima kasih!",
                    ]);
                    ChatMessage::create([
                        'sender_id' => $t->user_id,
                        'receiver_id' => $admin->id,
                        'message' => "Sewa {$t->account->title} ({$t->rentalPackage?->name}) selesai. Akun sudah dikembalikan.",
                    ]);
                }
            });

        $rentals = Transaction::with('user', 'account', 'rentalPackage')
            ->where('type', 'rent')
            ->where('status', 'confirmed')
            ->whereNotNull('rent_end')
            ->where('rent_end', '>', now())
            ->latest()
            ->paginate(20);

        foreach ($rentals as $t) {
            if (!$t->rent_start) { $t->rent_start = $t->created_at; }
            if (!$t->rent_end && $t->rentalPackage) {
                $base = $t->rent_start ?? $t->created_at;
                $t->rent_end = $base->copy()->addHours($t->rentalPackage->hours);
                $t->save();
            }
        }

        return view('admin.rentals.index', compact('rentals'));
    }
}
