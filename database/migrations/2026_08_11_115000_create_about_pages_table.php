<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_label', 120)->default('TENTANG JASAIBNU');
            $table->string('hero_title', 220)->default('Partner Teknologi untuk Pertumbuhan Bisnis Digital');
            $table->text('content_p1')->nullable();
            $table->text('content_p2')->nullable();
            $table->string('visual_image', 255)->nullable();

            $table->string('value_1_title', 120)->default('Scalable Development');
            $table->text('value_1_body')->nullable();
            $table->string('value_2_title', 120)->default('Security Focused');
            $table->text('value_2_body')->nullable();
            $table->string('value_3_title', 120)->default('Business Oriented');
            $table->text('value_3_body')->nullable();
            $table->string('value_4_title', 120)->default('Long-Term Development');
            $table->text('value_4_body')->nullable();

            $table->string('cta_consultation_text', 120)->default('Konsultasi Gratis');
            $table->string('cta_services_text', 120)->default('Lihat Layanan');

            $table->string('process_label', 120)->default('CARA KAMI BEKERJA');
            $table->string('process_title', 220)->default('Teknologi yang Dimulai dari Kebutuhan Bisnis');

            $table->string('step_1_title', 120)->default('Understand');
            $table->text('step_1_body')->nullable();
            $table->string('step_2_title', 120)->default('Build');
            $table->text('step_2_body')->nullable();
            $table->string('step_3_title', 120)->default('Grow');
            $table->text('step_3_body')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
