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
            $tableNames = $targetTable 
                ? [$targetTable] 
                : [
                    'users', 
                    'transactions', 
                    'transaction_items', 
                    'transaction_add_ons', 
                    'ticket_packages', 
                    'add_ons', 
                    'facilities', 
                    'wahanas', 
                    'promo_codes', 
                    'referral_codes', 
                    'awards', 
                    'faqs', 
                    'settings', 
                    'home_page_cards'
                ];

            foreach ($tableNames as $table) {
                $seq = DB::select("SELECT pg_get_serial_sequence('public." . $table . "', 'id') as seq");
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
