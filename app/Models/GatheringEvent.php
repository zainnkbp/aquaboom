<?php

namespace App\Models;

use App\Models\Concerns\HasAuditLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatheringEvent extends Model
{
    use HasFactory, HasAuditLog;

    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Accessor untuk mendapatkan URL lengkap gambar acara gathering.
     */
    public function getImageUrlAttribute($value): string
    {
        if (empty($value)) {
            return asset('assets/img/gathering-corporate.jpg');
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        if (\Illuminate\Support\Str::startsWith($value, 'assets/')) {
            return asset($value);
        }

        return asset('uploads/' . ltrim($value, '/'));
    }
}
