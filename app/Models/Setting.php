<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasAuditLog;
use App\Models\Concerns\AutoFixPostgresSequence;

class Setting extends Model
{
    use HasFactory, HasAuditLog, AutoFixPostgresSequence;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];
}
