<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait AutoFixPostgresSequence
{
    public static function bootAutoFixPostgresSequence(): void
    {
        static::creating(function ($model) {
            if (!$model->id) {
                try {
                    $table = $model->getTable();
                    $maxId = (int) DB::table($table)->max('id');
                    $model->id = $maxId + 1;

                    if (DB::getDriverName() === 'pgsql') {
                        try {
                            $seq = DB::select("SELECT pg_get_serial_sequence('public." . $table . "', 'id') as seq");
                            if (!empty($seq[0]->seq)) {
                                DB::statement("SELECT setval('" . $seq[0]->seq . "', " . $model->id . ")");
                            }
                        } catch (\Throwable $seqEx) {
                            // Ignored because ID is already explicitly set
                        }
                    }
                } catch (\Throwable $e) {
                    Log::debug("AutoFixPostgresSequence on " . $model->getTable() . ": " . $e->getMessage());
                }
            }
        });
    }
}
