<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'account_id', 'user_id', 'rental_package_id', 'invoice_number',
        'type', 'total_price', 'status', 'rent_start', 'rent_end',
        'payment_proof', 'confirmed_at',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
            'rent_start' => 'datetime',
            'rent_end' => 'datetime',
            'confirmed_at' => 'datetime',
        ];
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalPackage()
    {
        return $this->belongsTo(RentalPackage::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
