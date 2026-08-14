<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow', 120)->nullable();
            $table->string('title', 220)->nullable();
            $table->text('description')->nullable();
            $table->string('cta_eyebrow', 120)->nullable();
            $table->string('cta_title', 220)->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_primary_label', 120)->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_label', 120)->nullable();
            $table->string('cta_secondary_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_page_settings');
    }
};
