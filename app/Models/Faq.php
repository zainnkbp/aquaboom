<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\HasAuditLog;

class Faq extends Model
{
    use HasFactory, HasAuditLog;

    protected $fillable = [
        'question',
        'question_en',
        'answer',
        'answer_en',
        'is_active',
        'sort_order',
    ];
}
