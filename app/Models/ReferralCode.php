<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasAuditLog;
use App\Models\Concerns\AutoFixPostgresSequence;

class ReferralCode extends Model
{
    use HasAuditLog, AutoFixPostgresSequence;
    protected $guarded = [];

    protected $attributes = [
        'points_earned' => 0,
        'is_active' => true,
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!empty($model->code)) {
                $model->code = strtoupper(trim($model->code));
            }
            if ($model->points_earned === null) {
                $model->points_earned = 0;
            }
            if ($model->is_active === null) {
                $model->is_active = true;
            }
        });
    }
}
