<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            if (!Schema::hasTable('gathering_events')) {
                Schema::create('gathering_events', function (Blueprint $table) {
                    $table->id();
                    $table->string('badge_text')->nullable();
                    $table->string('badge_color')->default('navy');
                    $table->string('title');
                    $table->string('title_en')->nullable();
                    $table->string('subtitle')->nullable();
                    $table->string('subtitle_en')->nullable();
                    $table->text('description')->nullable();
                    $table->text('description_en')->nullable();
                    $table->json('features')->nullable();
                    $table->json('features_en')->nullable();
                    $table->string('image_url')->nullable();
                    $table->string('button_text')->default('Minta Penawaran Acara');
                    $table->string('button_text_en')->nullable();
                    $table->string('button_action')->default('#inquiry-form');
                    $table->integer('sort_order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            }
        } catch (\Throwable $e) {
            Log::warning('Migration create_gathering_events_table notice: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::dropIfExists('gathering_events');
        } catch (\Throwable $e) {
            Log::warning('Migration rollback create_gathering_events_table notice: ' . $e->getMessage());
        }
    }
};
