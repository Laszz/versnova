<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountImage extends Model
{
    protected $fillable = ['account_id', 'image_path', 'sort_order', 'is_primary'];

    protected function casts(): array
    {
        return ['is_primary' => 'boolean'];
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
