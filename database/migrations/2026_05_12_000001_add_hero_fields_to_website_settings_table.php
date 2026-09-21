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
        Schema::table('website_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('website_settings', 'hero_images')) {
                $table->json('hero_images')->nullable();
            }
            if (!Schema::hasColumn('website_settings', 'hero_style')) {
                $table->string('hero_style')->nullable();
            }
            if (!Schema::hasColumn('website_settings', 'hero_animation')) {
                $table->string('hero_animation')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_images', 'hero_style', 'hero_animation']);
        });
    }
};