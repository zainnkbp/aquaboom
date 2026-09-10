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

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!empty($model->code)) {
                $model->code = strtoupper(trim($model->code));
                // Automatically force-delete any soft-deleted promo code with the same code
                // so PostgreSQL doesn't conflict with unique constraint on code and allows reuse
                static::withTrashed()
                    ->where('code', $model->code)
                    ->whereNotNull('deleted_at')
                    ->forceDelete();
            }
        });

        static::updating(function ($model) {
            if (!empty($model->code)) {
                $model->code = strtoupper(trim($model->code));
            }
        });
    }
}
