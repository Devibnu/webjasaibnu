<?php

use App\Models\AboutPage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->string('homepage_about_label', 120)->nullable()->after('visual_image');
            $table->string('homepage_about_title', 220)->nullable()->after('homepage_about_label');
            $table->text('homepage_about_description')->nullable()->after('homepage_about_title');
            $table->string('homepage_checklist_1', 120)->nullable()->after('homepage_about_description');
            $table->string('homepage_checklist_2', 120)->nullable()->after('homepage_checklist_1');
            $table->string('homepage_checklist_3', 120)->nullable()->after('homepage_checklist_2');
            $table->string('homepage_checklist_4', 120)->nullable()->after('homepage_checklist_3');
            $table->string('homepage_cta_small_text', 160)->nullable()->after('homepage_checklist_4');
            $table->string('homepage_cta_main_text', 160)->nullable()->after('homepage_cta_small_text');
            $table->string('homepage_cta_url', 255)->nullable()->after('homepage_cta_main_text');
            $table->string('homepage_button_label', 120)->nullable()->after('homepage_cta_url');
            $table->string('homepage_button_url', 255)->nullable()->after('homepage_button_label');
            $table->string('homepage_about_image', 255)->nullable()->after('homepage_button_url');
        });

        AboutPage::query()->each(function (AboutPage $about) {
            $about->forceFill(AboutPage::homepageAboutDefaults())->save();
        });
    }

    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'homepage_about_label',
                'homepage_about_title',
                'homepage_about_description',
                'homepage_checklist_1',
                'homepage_checklist_2',
                'homepage_checklist_3',
                'homepage_checklist_4',
                'homepage_cta_small_text',
                'homepage_cta_main_text',
                'homepage_cta_url',
                'homepage_button_label',
                'homepage_button_url',
                'homepage_about_image',
            ]);
        });
    }
};
