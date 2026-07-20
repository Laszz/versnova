<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class OrdersExpireCommand extends Command
{
    protected $signature = 'orders:expire';
    protected $description = 'Expire unpaid orders after 24 hours';

    public function handle()
    {
        $count = Transaction::where('status', 'waiting_payment')
            ->where('created_at', '<', now()->subHours(24))
            ->each(function ($t) {
                $t->update(['status' => 'expired']);
                $t->account()->update(['status' => 'available']);
            });

        $this->info("Expired {$count} orders.");
    }
}
