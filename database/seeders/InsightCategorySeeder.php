<?php

namespace Database\Seeders;

use App\Models\InsightCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InsightCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Website Development',
            'SEO',
            'Web Application',
            'SaaS',
            'AI Integration',
            'System Integration',
            'Security',
        ];

        foreach ($categories as $index => $name) {
            InsightCategory::updateOrCreate(
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
