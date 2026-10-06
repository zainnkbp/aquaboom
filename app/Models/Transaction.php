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

    public function addOns(): HasMany
    {
        return $this->hasMany(TransactionAddOn::class);
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
     * Label representasi metode pembayaran (BCA VA, QRIS, dll.)
     */
    public function getPaymentChannelLabelAttribute(): string
    {
        if ((float)$this->total_price <= 0) {
            return 'Gratis (Promo 100%)';
        }

        $channel = strtoupper($this->payment_channel ?? '');

        if (empty($channel)) {
            return in_array($this->status, ['paid', 'scanned']) ? 'DOKU Online Payment' : 'Menunggu Pembayaran';
        }

        return match (true) {
            str_contains($channel, 'BCA') => 'BCA Virtual Account',
            str_contains($channel, 'MANDIRI') => 'Mandiri Virtual Account',
            str_contains($channel, 'BRI') => 'BRI Virtual Account',
            str_contains($channel, 'BNI') => 'BNI Virtual Account',
            str_contains($channel, 'PERMATA') => 'Permata Virtual Account',
            str_contains($channel, 'CIMB') => 'CIMB Niaga Virtual Account',
            str_contains($channel, 'DANAMON') => 'Danamon Virtual Account',
            str_contains($channel, 'QRIS') => 'QRIS (GoPay / OVO / Dana / BCA)',
            str_contains($channel, 'CREDIT_CARD') || str_contains($channel, 'CARD') => 'Kartu Kredit / Debit Online',
            str_contains($channel, 'SHOPEEPAY') => 'ShopeePay',
            str_contains($channel, 'OVO') => 'OVO',
            str_contains($channel, 'DOKU') => 'DOKU e-Wallet',
            str_contains($channel, 'ALFAMART') => 'Alfamart',
            str_contains($channel, 'INDOMARET') => 'Indomaret',
            default => ucwords(str_replace(['_', '-'], ' ', strtolower($channel))),
        };
    }

    /**
     * Status Kehadiran / Check-In Pengunjung
     */
    public function getAttendanceStatusAttribute(): string
    {
        if ($this->is_redeemed || $this->status === 'scanned') {
            return 'Checked In';
        }

        if (in_array($this->status, ['failed', 'cancelled'])) {
            return 'Cancel';
        }

        $visit = \Carbon\Carbon::parse($this->visit_date)->startOfDay();
        $today = \Carbon\Carbon::today();

        if ($this->status === 'pending') {
            if ($visit->lt($today)) {
                return 'Cancel';
            }
            return 'Menunggu Bayar';
        }

        // Status 'paid'
        if ($visit->lt($today)) {
            return 'No Show';
        }

        if ($visit->equalTo($today)) {
            return 'Hari Ini';
        }

        return 'Belum Datang';
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
