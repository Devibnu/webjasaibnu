<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        if (HeroSlide::query()->exists()) {
            return;
        }

        foreach (HeroSlide::defaultItems() as $data) {
            HeroSlide::query()->create($data);
        }
    }
}