<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Account extends Model
{
    protected $fillable = [
        'game_id', 'slug', 'title', 'description', 'platform', 'server',
        'bind_status', 'login_method', 'level', 'skin_info',
        'price_sell', 'price_rent', 'discount_percent', 'discount_price',
        'discount_until', 'discount_start', 'status', 'sold_at',
    ];

    protected function casts(): array
    {
        return [
            'discount_until' => 'datetime',
            'discount_start' => 'datetime',
            'sold_at' => 'datetime',
            'price_sell' => 'decimal:2',
            'price_rent' => 'decimal:2',
            'discount_price' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn ($a) => $a->slug ??= Str::slug($a->title . '-' . Str::random(6)));
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function images()
    {
        return $this->hasMany(AccountImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(AccountImage::class)->where('is_primary', true);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
