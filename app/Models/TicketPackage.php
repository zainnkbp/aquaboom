<?php

namespace App\Models;

use App\Models\Concerns\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPackage extends Model
{
    use HasAuditLog, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Whether this package is currently discounted (has a valid discount that
     * actually lowers the price).
     */
    public function getIsDiscountedAttribute(): bool
    {
        return $this->discount_price !== null
            && (float) $this->effective_price < (float) $this->price;
    }

    /**
     * The real price the customer pays for one ticket, resolving the discount
     * according to discount_type ('amount' = final price, 'percentage' = % off).
     */
    public function getEffectivePriceAttribute(): float
    {
        $price = (float) $this->price;

        if ($this->discount_price === null) {
            return $price;
        }

        if ($this->discount_type === 'percentage') {
            $discounted = $price - ($price * ((float) $this->discount_price / 100));

            return max(0, round($discounted, 2));
        }

        // 'amount' — discount_price is the final price in Rupiah.
        return (float) $this->discount_price;
    }
}
