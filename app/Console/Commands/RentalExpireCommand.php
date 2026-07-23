<?php

namespace App\Console\Commands;

use App\Models\ChatMessage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;

class RentalExpireCommand extends Command
{
    protected $signature = 'rental:expire';
    protected $description = 'Expire finished rentals';

    public function handle()
    {
        $admin = User::where('is_admin', true)->first();
        $count = 0;

        Transaction::where('type', 'rent')
            ->where('status', 'confirmed')
            ->where('rent_end', '<', now())
            ->each(function ($t) use ($admin, &$count) {
                $t->update(['status' => 'completed']);
                $t->account()->update(['status' => 'available']);

                if ($admin) {
                    ChatMessage::create([
                        'sender_id' => $admin->id,
                        'receiver_id' => $t->user_id,
                        'message' => "Waktu sewa akun {$t->account->title} ({$t->rentalPackage?->name}) sudah habis. Terima kasih telah menyewa di Versnova!",
                    ]);
                    ChatMessage::create([
                        'sender_id' => $t->user_id,
                        'receiver_id' => $admin->id,
                        'message' => "Sewa {$t->account->title} ({$t->rentalPackage?->name}) selesai. Akun sudah dikembalikan.",
                    ]);
                }

                $count++;
            });

        $this->info("Expired {$count} rentals.");
    }
}
