<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 120);
            $table->string('company_legal_name', 180)->nullable();
            $table->string('email', 160);
            $table->string('phone', 120)->nullable();
            $table->string('whatsapp_number', 80)->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('address', 220)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('country', 120)->nullable();
            $table->string('google_maps_embed_url')->nullable();
            $table->string('google_maps_external_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->text('footer_description')->nullable();
            $table->string('copyright_text', 220)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
