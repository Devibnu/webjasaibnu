<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Business Application',
            'Corporate Website',
            'Education SaaS',
            'Sales Application',
            'Integration',
        ];

        foreach ($categories as $index => $name) {
            PortfolioCategory::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
