<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('home_consultation_eyebrow', 80)->nullable()->after('google_maps_external_url');
            $table->string('home_consultation_title', 180)->nullable()->after('home_consultation_eyebrow');
            $table->string('home_consultation_feature_one', 120)->nullable()->after('home_consultation_title');
            $table->string('home_consultation_feature_two', 120)->nullable()->after('home_consultation_feature_one');
            $table->text('home_consultation_description')->nullable()->after('home_consultation_feature_two');
            $table->string('home_consultation_contact_label', 120)->nullable()->after('home_consultation_description');
            $table->string('home_consultation_card_title', 120)->nullable()->after('home_consultation_contact_label');
            $table->text('home_consultation_card_description')->nullable()->after('home_consultation_card_title');
            $table->string('home_consultation_button_text', 120)->nullable()->after('home_consultation_card_description');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_consultation_eyebrow',
                'home_consultation_title',
                'home_consultation_feature_one',
                'home_consultation_feature_two',
                'home_consultation_description',
                'home_consultation_contact_label',
                'home_consultation_card_title',
                'home_consultation_card_description',
                'home_consultation_button_text',
            ]);
        });
    }
};
