<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow', 220)->nullable();
            $table->string('title', 220);
            $table->text('description')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->string('image_alt', 255)->nullable();
            $table->string('primary_button_text', 120)->nullable();
            $table->string('primary_button_url', 255)->nullable();
            $table->string('secondary_button_text', 120)->nullable();
            $table->string('secondary_button_url', 255)->nullable();
            $table->unsignedSmallInteger('overlay_opacity')->default(70)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};