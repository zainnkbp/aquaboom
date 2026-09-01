<?php

namespace App\Models;

use App\Models\Concerns\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wahana extends Model
{
    use HasAuditLog, SoftDeletes;

    protected $guarded = [];

    /**
     * Accessor untuk mendapatkan URL lengkap gambar wahana.
     */
    public function getImageUrlAttribute($value): string
    {
        if (empty($value)) {
            return asset('assets/img/default-wahana.svg');
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        return asset('uploads/' . ltrim($value, '/'));
    }
}
