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
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->boolean('include_national_holidays')->default(true)->after('holiday_ids');
            $table->boolean('include_peak_season')->default(false)->after('include_national_holidays');
        });

        // Set sensible defaults for existing records:
        // Weekday tickets should NOT include national holidays by default
        DB::table('ticket_packages')
            ->where('validity_type', 'weekday')
            ->update(['include_national_holidays' => false]);
            
        // Weekend tickets should include national holidays by default (historical behavior)
        DB::table('ticket_packages')
            ->where('validity_type', 'weekend')
            ->update(['include_national_holidays' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->dropColumn(['include_national_holidays', 'include_peak_season']);
        });
    }
};
