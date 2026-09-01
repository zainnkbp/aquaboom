<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait AutoFixPostgresSequence
{
    public static function bootAutoFixPostgresSequence(): void
    {
        static::creating(function ($model) {
            $keyName = $model->getKeyName();

            // If primary key is auto-increment integer and not explicitly set
            if (empty($model->{$keyName})) {
                try {
                    $table = $model->getTable();
                    $maxId = (int) DB::table($table)->max($keyName);
                    $nextId = $maxId + 1;

                    // Explicitly set the unique incrementing ID
                    $model->{$keyName} = $nextId;

                    // Also synchronize Postgres sequence if using PostgreSQL
                    if (DB::getDriverName() === 'pgsql') {
                        $seq = DB::select("SELECT pg_get_serial_sequence('public." . $table . "', '" . $keyName . "') as seq");
                        if (!empty($seq[0]->seq)) {
                            DB::statement("SELECT setval('" . $seq[0]->seq . "', " . $nextId . ")");
                        }
                    }
                } catch (\Throwable $e) {
                    Log::debug("AutoFixPostgresSequence error on " . $model->getTable() . ": " . $e->getMessage());
                }
            }
        });
    }
}
