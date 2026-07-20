<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class RentalExpireCommand extends Command
{
    protected $signature = 'rental:expire';
    protected $description = 'Expire finished rentals';

    public function handle()
    {
        $count = Transaction::where('type', 'rent')
            ->where('status', 'confirmed')
            ->where('rent_end', '<', now())
            ->each(function ($t) {
                $t->update(['status' => 'completed']);
                $t->account()->update(['status' => 'available']);
            });

        $this->info("Expired {$count} rentals.");
    }
}
