<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\HasAuditLog;

class Setting extends Model
{
    use HasFactory, HasAuditLog;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];
}
