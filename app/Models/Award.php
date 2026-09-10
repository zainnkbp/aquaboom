<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\AutoFixPostgresSequence;

class Award extends Model
{
    use HasFactory, AutoFixPostgresSequence;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'is_active',
        'sort_order',
    ];
}
