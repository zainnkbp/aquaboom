<?php

namespace App\Models;

use App\Models\Concerns\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wahana extends Model
{
    use HasAuditLog, SoftDeletes;

    protected $guarded = [];
}
