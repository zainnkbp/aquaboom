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
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
    ];
}
