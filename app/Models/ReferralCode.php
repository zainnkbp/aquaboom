<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\HasAuditLog;

class ReferralCode extends Model
{
    use HasAuditLog;
    protected $guarded = [];
}
