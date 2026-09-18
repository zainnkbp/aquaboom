<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasAuditLog;
use App\Models\Concerns\AutoPruneMediaOnUpdate;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AddOn extends Model
{
    use HasAuditLog, \App\Models\Concerns\AutoFixPostgresSequence, AutoPruneMediaOnUpdate;

    protected $guarded = [];

    protected $attributes = [
        'sort_order' => 0,
        'is_active' => true,
        'price' => 0,
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'weekend_price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Hitung tarif efektif berdasarkan tanggal kunjungan (Weekday vs Weekend / Libur Nasional).
     */
    public function getEffectivePriceForDate(?string $dateString = null): float
    {
        if (empty($dateString)) {
            return (float) ($this->price ?? 0);
        }

        try {
            $date = Carbon::parse($dateString);
            $holiday = Holiday::getHolidayForDate($dateString);
            $isHoliday = $holiday && in_array($holiday->type, ['national_holiday', 'joint_leave', 'peak_season']);
            $isWeekend = $date->isWeekend();

            if (($isWeekend || $isHoliday) && $this->weekend_price !== null && (float) $this->weekend_price > 0) {
                return (float) $this->weekend_price;
            }
        } catch (\Throwable $e) {
            // Safe fallback if date parsing fails
        }

        return (float) ($this->price ?? 0);
    }

    /**
     * Accessor untuk mendapatkan URL lengkap gambar produk Add-On.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('assets/img/default-addon.svg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'assets/')) {
            return asset($this->image);
        }

        return asset('uploads/' . ltrim($this->image, '/'));
    }
}
