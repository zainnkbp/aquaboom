<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('ticket_packages') && !Schema::hasColumn('ticket_packages', 'is_featured_home')) {
            Schema::table('ticket_packages', function (Blueprint $table) {
                $table->boolean('is_featured_home')->default(false)->after('is_active');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ticket_packages') && Schema::hasColumn('ticket_packages', 'is_featured_home')) {
            Schema::table('ticket_packages', function (Blueprint $table) {
                $table->dropColumn('is_featured_home');
            });
        }
    }
};
