<?php

namespace App\Models;

use App\Models\Concerns\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasAuditLog, SoftDeletes, \App\Models\Concerns\AutoFixPostgresSequence;

    protected $guarded = [];

    protected $casts = [
        'visit_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'is_redeemed' => 'boolean',
        'redeemed_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate format kode tiket ringkas dan ramah input manual: AQB-XXXX-XXXX-XXXX
     * Menggunakan 12 karakter alfanumerik yang jelas tanpa huruf yang membingungkan.
     */
    public static function generateOrderId(): string
    {
        $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = '';
        
        do {
            $p1 = ''; $p2 = ''; $p3 = '';
            for ($i = 0; $i < 4; $i++) {
                $p1 .= $chars[random_int(0, strlen($chars) - 1)];
                $p2 .= $chars[random_int(0, strlen($chars) - 1)];
                $p3 .= $chars[random_int(0, strlen($chars) - 1)];
            }
            $code = 'AQB-' . $p1 . '-' . $p2 . '-' . $p3;
        } while (self::where('order_id', $code)->exists());

        return $code;
    }
}
