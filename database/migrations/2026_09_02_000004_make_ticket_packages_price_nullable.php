<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            if (DB::getDriverName() === 'pgsql') {
                DB::statement('ALTER TABLE ticket_packages ALTER COLUMN price DROP NOT NULL');
            } else {
                Schema::table('ticket_packages', function (Blueprint $table) {
                    $table->decimal('price', 10, 2)->nullable()->default(null)->change();
                });
            }
        } catch (\Throwable $e) {
            Log::warning('Migration make_ticket_packages_price_nullable notice: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
