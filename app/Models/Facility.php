<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\HasAuditLog;

class Facility extends Model
{
    use HasFactory, HasAuditLog;

    protected $fillable = [
        'name',
        'name_en',
        'type',
        'description',
        'description_en',
        'features',
        'features_en',
        'menu_items',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
        'menu_items' => 'array',
    ];

    /**
     * Accessor untuk mendapatkan URL lengkap gambar fasilitas / area makan.
     */
    public function getImageUrlAttribute($value): string
    {
        if (empty($value)) {
            return asset('assets/img/default-facility.svg');
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        return asset('uploads/' . ltrim($value, '/'));
    }
}
