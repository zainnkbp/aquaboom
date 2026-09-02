<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For PostgreSQL, drop check constraint if exists and alter column to string
        try {
            DB::statement("ALTER TABLE ticket_packages DROP CONSTRAINT IF EXISTS ticket_packages_type_check");
        } catch (\Throwable $e) {
            // ignore if not pgsql or constraint not found
        }

        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->string('type', 50)->default('regular')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->string('type', 50)->default('regular')->change();
        });
    }
};
