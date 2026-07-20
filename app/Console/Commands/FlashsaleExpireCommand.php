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
        Account::whereNotNull('discount_until')
            ->where('discount_until', '<', now())
            ->update(['discount_percent' => null, 'discount_price' => null, 'discount_until' => null, 'discount_start' => null]);

        Account::whereNotNull('discount_start')
            ->where('discount_start', '>', now())
            ->update(['discount_percent' => null, 'discount_price' => null, 'discount_until' => null, 'discount_start' => null]);

        $this->info('Flashsales expired.');
    }
}
