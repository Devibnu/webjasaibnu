<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = SiteSetting::query()->first();

        if ($settings) {
            $settings->update(SiteSetting::defaults());

            return;
        }

        SiteSetting::query()->create(SiteSetting::defaults());
    }
}
