<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $about = AboutPage::query()->first();

        if ($about) {
            $about->update(AboutPage::defaults());

            return;
        }

        AboutPage::query()->create(AboutPage::defaults());
    }
}
