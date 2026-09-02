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
            if (Schema::hasTable('ticket_packages') && !Schema::hasColumn('ticket_packages', 'is_featured_home')) {
                Schema::table('ticket_packages', function (Blueprint $table) {
                    $table->boolean('is_featured_home')->default(false)->after('is_active');
                });
            }
        } catch (\Throwable $e) {
            Log::warning('Migration add_is_featured_home_to_ticket_packages_table notice: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            if (Schema::hasTable('ticket_packages') && Schema::hasColumn('ticket_packages', 'is_featured_home')) {
                Schema::table('ticket_packages', function (Blueprint $table) {
                    $table->dropColumn('is_featured_home');
                });
            }
        } catch (\Throwable $e) {
            Log::warning('Migration rollback add_is_featured_home_to_ticket_packages_table notice: ' . $e->getMessage());
        }
    }
};
