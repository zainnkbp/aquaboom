<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\HasAuditLog;
use Illuminate\Support\Str;

class AddOn extends Model
{
    use HasAuditLog;

    protected $guarded = [];

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

        return asset('uploads/' . ltrim($this->image, '/'));
    }
}
