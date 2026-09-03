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
        // 1. ticket_packages
        try {
            if (Schema::hasTable('ticket_packages') && !Schema::hasColumn('ticket_packages', 'sort_order')) {
                Schema::table('ticket_packages', function (Blueprint $table) {
                    $table->integer('sort_order')->default(0)->after('is_featured_home');
                });
                DB::statement('UPDATE ticket_packages SET sort_order = id');
            }
        } catch (\Throwable $e) {
            Log::warning('Migration add_sort_order to ticket_packages notice: ' . $e->getMessage());
        }

        // 2. facilities
        try {
            if (Schema::hasTable('facilities') && !Schema::hasColumn('facilities', 'sort_order')) {
                Schema::table('facilities', function (Blueprint $table) {
                    $table->integer('sort_order')->default(0)->after('is_active');
                });
                DB::statement('UPDATE facilities SET sort_order = id');
            }
        } catch (\Throwable $e) {
            Log::warning('Migration add_sort_order to facilities notice: ' . $e->getMessage());
        }

        // 3. add_ons
        try {
            if (Schema::hasTable('add_ons') && !Schema::hasColumn('add_ons', 'sort_order')) {
                Schema::table('add_ons', function (Blueprint $table) {
                    $table->integer('sort_order')->default(0)->after('is_active');
                });
                DB::statement('UPDATE add_ons SET sort_order = id');
            }
        } catch (\Throwable $e) {
            Log::warning('Migration add_sort_order to add_ons notice: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
