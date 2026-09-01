<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'link',
        'link_text',
        'is_active',
        'sort_order',
    ];

    /**
     * Accessor untuk mendapatkan URL lengkap gambar card beranda.
     */
    public function getImageUrlAttribute($value): string
    {
        if (empty($value)) {
            return asset('assets/img/default-package.svg');
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        return asset('uploads/' . ltrim($value, '/'));
    }
}
