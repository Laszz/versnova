<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalPackage extends Model
{
    protected $fillable = ['name', 'hours', 'price', 'open_time', 'close_time', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'open_time' => 'datetime:H:i',
            'close_time' => 'datetime:H:i',
            'is_active' => 'boolean',
        ];
    }
}
