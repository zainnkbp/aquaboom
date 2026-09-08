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
        Schema::table('users', function (Blueprint $table) {
            $table->json('permissions')->nullable()->after('role');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('status');
        });

        // Grant existing admin users full initial permissions
        \Illuminate\Support\Facades\DB::table('users')
            ->where('role', 'admin')
            ->whereNull('permissions')
            ->update([
                'permissions' => json_encode([
                    'transactions',
                    'ticket_packages',
                    'promos',
                    'wahanas',
                    'facilities_dining',
                    'faqs_cms',
                    'settings',
                    'scanner_access',
                ]),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('permissions');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};
