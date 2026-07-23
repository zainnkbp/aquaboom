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
        'valid_dates' => 'array',
        'valid_days' => 'array',
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

    /**
     * Check if this package is valid for the given date (Y-m-d).
     */
    public function isValidForDate(string $dateString): bool
    {
        $date = \Carbon\Carbon::parse($dateString);

        if ($this->validity_type === 'weekday') {
            return $date->isWeekday();
        }

        if ($this->validity_type === 'weekend') {
            return $date->isWeekend();
        }

        if ($this->validity_type === 'specific_dates') {
            if (!is_array($this->valid_dates)) {
                return false;
            }
            return in_array($date->format('Y-m-d'), $this->valid_dates);
        }

        if ($this->validity_type === 'specific_days') {
            if (!is_array($this->valid_days)) {
                return false;
            }
            // format('l') returns full textual representation of the day of the week (e.g. 'Monday', 'Tuesday')
            return in_array($date->format('l'), $this->valid_days);
        }

        // 'all_days' or anything else
        return true;
    }
}
