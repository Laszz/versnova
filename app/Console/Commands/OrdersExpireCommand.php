<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class OrdersExpireCommand extends Command
{
    protected $signature = 'orders:expire';
    protected $description = 'Expire unpaid orders after 5 minutes';

    public function handle()
    {
        $count = Transaction::where('status', 'waiting_payment')
            ->where('created_at', '<', now()->subMinutes(5))
            ->each(function ($t) {
                $t->update(['status' => 'expired']);
                $t->account()->update(['status' => 'available']);
            });

        $this->info("Expired {$count} orders.");
    }
}
