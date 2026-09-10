<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasAuditLog;
use App\Models\Concerns\AutoFixPostgresSequence;

class ReferralCode extends Model
{
    use HasAuditLog, AutoFixPostgresSequence;
    protected $guarded = [];
}
