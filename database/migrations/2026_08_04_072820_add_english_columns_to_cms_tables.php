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
        Schema::table('wahanas', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
            $table->json('features_en')->nullable()->after('features');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->text('question_en')->nullable()->after('question');
            $table->text('answer_en')->nullable()->after('answer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wahanas', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en', 'features_en']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_en', 'answer_en']);
        });
    }
};
