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
                DB::statement("ALTER TABLE ticket_packages DROP CONSTRAINT IF EXISTS ticket_packages_type_check");
                DB::statement("ALTER TABLE ticket_packages ALTER COLUMN type TYPE VARCHAR(50)");
                DB::statement("ALTER TABLE ticket_packages ALTER COLUMN type SET DEFAULT 'regular'");
            } else {
                Schema::table('ticket_packages', function (Blueprint $table) {
                    $table->string('type', 50)->default('regular')->change();
                });
            }
        } catch (\Throwable $e) {
            Log::warning('Migration change_ticket_packages_type_to_string notice: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
