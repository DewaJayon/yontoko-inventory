<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cartItem(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // menghitung total pajak 11%
    public function calculateTax($total)
    {
        return $total * 0.11;
    }
}
