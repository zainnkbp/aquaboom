<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait AutoFixPostgresSequence
{
    public static function bootAutoFixPostgresSequence(): void
    {
        static::creating(function ($model) {
            if (!$model->id && DB::getDriverName() === 'pgsql') {
                try {
                    $table = $model->getTable();
                    $maxId = (int) DB::table($table)->max('id');
                    if ($maxId > 0) {
                        $seq = DB::select("SELECT pg_get_serial_sequence('public." . $table . "', 'id') as seq");
                        if (!empty($seq[0]->seq)) {
                            DB::statement("SELECT setval('" . $seq[0]->seq . "', " . $maxId . ")");
                        }
                    }
                } catch (\Throwable $e) {
                    Log::debug("AutoFixPostgresSequence error on " . $model->getTable() . ": " . $e->getMessage());
                }
            }
        });
    }
}
