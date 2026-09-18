<?php

namespace App\Models;

use App\Models\Concerns\HasAuditLog;
use App\Models\Concerns\AutoFixPostgresSequence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasAuditLog, SoftDeletes, AutoFixPostgresSequence;

    protected $guarded = [];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'used_count' => 0,
        'is_active' => true,
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!empty($model->code)) {
                $model->code = strtoupper(trim($model->code));
            }
            if ($model->used_count === null) {
                $model->used_count = 0;
            }
            if ($model->is_active === null) {
                $model->is_active = true;
            }
        });

        static::updating(function ($model) {
            if (!empty($model->code)) {
                $model->code = strtoupper(trim($model->code));
            }
        });
    }
}
