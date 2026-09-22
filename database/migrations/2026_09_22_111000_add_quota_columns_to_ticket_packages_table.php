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
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->unsignedInteger('daily_quota')->nullable()->after('sales_end')->comment('Maksimal kuota tiket yang dapat dibeli per tanggal kunjungan. Null = Unlimited.');
            $table->unsignedInteger('total_quota')->nullable()->after('daily_quota')->comment('Total batas kuota keseluruhan untuk tiket event / promo spesial. Null = Unlimited.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->dropColumn(['daily_quota', 'total_quota']);
        });
    }
};
