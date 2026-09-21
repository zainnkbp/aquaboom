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
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone')->nullable()->after('email')->comment('Nomor WhatsApp / Telepon Pelanggan');
            });
        } catch (\Throwable $e) {
            if (!str_contains($e->getMessage(), 'Duplicate column') && !str_contains($e->getMessage(), 'already exists')) {
                try {
                    \Illuminate\Support\Facades\DB::statement("ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `phone` VARCHAR(50) NULL AFTER `email`");
                } catch (\Throwable $ex) {
                    // Ignored
                }
            }
        }

        try {
            Schema::table('users', function (Blueprint $table) {
                $table->string('google_id')->nullable()->after('remember_token')->index()->comment('Google OAuth ID');
            });
        } catch (\Throwable $e) {
            if (!str_contains($e->getMessage(), 'Duplicate column') && !str_contains($e->getMessage(), 'already exists')) {
                try {
                    \Illuminate\Support\Facades\DB::statement("ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `google_id` VARCHAR(255) NULL AFTER `remember_token`");
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
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['google_id', 'phone']);
            });
        } catch (\Throwable $e) {
            // Ignored if column doesn't exist
        }
    }
};
