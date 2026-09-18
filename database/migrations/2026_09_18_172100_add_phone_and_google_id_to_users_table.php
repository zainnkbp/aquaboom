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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable()->after('email')->comment('Nomor WhatsApp / Telepon Pelanggan');
                }
                if (!Schema::hasColumn('users', 'google_id')) {
                    $table->string('google_id')->nullable()->after('remember_token')->index()->comment('Google OAuth ID');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'google_id')) {
                    $table->dropColumn('google_id');
                }
                if (Schema::hasColumn('users', 'phone')) {
                    $table->dropColumn('phone');
                }
            });
        }
    }
};
