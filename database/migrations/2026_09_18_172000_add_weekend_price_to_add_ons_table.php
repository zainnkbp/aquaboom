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
        if (Schema::hasTable('add_ons') && !Schema::hasColumn('add_ons', 'weekend_price')) {
            Schema::table('add_ons', function (Blueprint $table) {
                $table->decimal('weekend_price', 15, 2)->nullable()->after('price')->comment('Tarif khusus Weekend & Hari Libur. Jika NULL gunakan price');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('add_ons') && Schema::hasColumn('add_ons', 'weekend_price')) {
            Schema::table('add_ons', function (Blueprint $table) {
                $table->dropColumn('weekend_price');
            });
        }
    }
};
