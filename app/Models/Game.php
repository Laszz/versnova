<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Game extends Model
{
    protected $fillable = ['slug', 'name', 'icon'];

    protected static function booted(): void
    {
        static::creating(fn ($game) => $game->slug ??= Str::slug($game->name));
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
