<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostgresSequenceFixer
{
    /**
     * Resynchronize sequence for a specific table or all tables in PostgreSQL.
     */
    public static function fix(?string $targetTable = null): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        try {
            if ($targetTable) {
                $tables = [(object)['table_name' => $targetTable]];
            } else {
                $tables = DB::select("SELECT table_name FROM information_schema.columns WHERE table_schema = 'public' AND column_name = 'id'");
            }

            foreach ($tables as $t) {
                $table = $t->table_name;
                $seq = DB::select("SELECT pg_get_serial_sequence('\"" . $table . "\"', 'id') as seq");
                if (!empty($seq[0]->seq)) {
                    $seqName = $seq[0]->seq;
                    DB::statement("SELECT setval('" . $seqName . "', COALESCE((SELECT MAX(id) FROM \"" . $table . "\"), 1))");
                }
            }
        } catch (\Throwable $e) {
            Log::warning("PostgresSequenceFixer error: " . $e->getMessage());
        }
    }
}
