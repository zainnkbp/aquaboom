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
            $table->string('inquiry_type')->default('none')->after('image_url');
            $table->string('inquiry_custom_link')->nullable()->after('inquiry_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->dropColumn(['inquiry_type', 'inquiry_custom_link']);
        });
    }
};
