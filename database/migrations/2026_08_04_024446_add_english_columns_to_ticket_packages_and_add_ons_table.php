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
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
            $table->text('terms_and_conditions_en')->nullable()->after('terms_and_conditions');
        });

        Schema::table('add_ons', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en', 'terms_and_conditions_en']);
        });

        Schema::table('add_ons', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });
    }
};
