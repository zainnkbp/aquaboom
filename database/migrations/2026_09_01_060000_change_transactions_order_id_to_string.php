<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        try {
            if (DB::getDriverName() === 'pgsql') {
                DB::statement('ALTER TABLE transactions ALTER COLUMN order_id TYPE VARCHAR(100)');
            } else {
                Schema::table('transactions', function ($table) {
                    $table->string('order_id', 100)->change();
                });
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Migration ALTER transactions.order_id notice: ' . $e->getMessage());
        }
    }

    public function down(): void
    {
    }
};
