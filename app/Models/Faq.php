<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasAuditLog;
use App\Models\Concerns\AutoFixPostgresSequence;

class Faq extends Model
{
    use HasFactory, HasAuditLog, AutoFixPostgresSequence;

    protected $fillable = [
        'question',
        'question_en',
        'answer',
        'answer_en',
        'is_active',
        'sort_order',
    ];
}
