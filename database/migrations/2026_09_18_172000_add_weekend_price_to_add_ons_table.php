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
        try {
            Schema::table('add_ons', function (Blueprint $table) {
                $table->decimal('weekend_price', 15, 2)->nullable()->after('price')->comment('Tarif khusus Weekend & Hari Libur. Jika NULL gunakan price');
            });
        } catch (\Throwable $e) {
            // Abaikan jika kolom sudah ada atau fallback raw statement
            if (!str_contains($e->getMessage(), 'Duplicate column') && !str_contains($e->getMessage(), 'already exists')) {
                try {
                    \Illuminate\Support\Facades\DB::statement("ALTER TABLE `add_ons` ADD COLUMN IF NOT EXISTS `weekend_price` DECIMAL(15,2) NULL AFTER `price`");
                } catch (\Throwable $ex) {
                    // Ignored
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('add_ons', function (Blueprint $table) {
                $table->dropColumn('weekend_price');
            });
        } catch (\Throwable $e) {
            // Ignored if column doesn't exist
        }
    }
};
