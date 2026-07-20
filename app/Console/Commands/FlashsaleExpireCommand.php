<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;

class FlashsaleExpireCommand extends Command
{
    protected $signature = 'flashsale:expire';
    protected $description = 'Clear expired flashsale discounts';

    public function handle()
    {
        $count = Account::whereNotNull('discount_until')
            ->where('discount_until', '<', now())
            ->each(function ($a) {
                $a->update(['discount_percent' => null, 'discount_price' => null, 'discount_until' => null]);
            });

        $this->info("Expired {$count} flashsales.");
    }
}
