<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            $columns = DB::select("SELECT table_name FROM information_schema.columns WHERE table_schema = 'public' AND column_name = 'id'");
            foreach ($columns as $col) {
                $tableName = $col->table_name;
                $seq = DB::select("SELECT pg_get_serial_sequence('\"" . $tableName . "\"', 'id') as seq");
                if (!empty($seq[0]->seq)) {
                    $seqName = $seq[0]->seq;
                    DB::statement("SELECT setval('" . $seqName . "', COALESCE((SELECT MAX(id) FROM \"" . $tableName . "\"), 1))");
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse operation needed for sequence alignment
    }
};
