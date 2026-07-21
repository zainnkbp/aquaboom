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
            // How discount_price should be interpreted: 'amount' (final price in Rp)
            // or 'percentage' (percent off the normal price).
            $table->string('discount_type')->default('amount')->after('discount_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->dropColumn('discount_type');
        });
    }
};
