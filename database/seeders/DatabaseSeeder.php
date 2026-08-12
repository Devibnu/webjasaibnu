<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SiteSettingSeeder::class,
            AboutPageSeeder::class,
            ServiceSeeder::class,
            SolutionSeeder::class,
            InsightCategorySeeder::class,
            InsightSeeder::class,
            PortfolioCategorySeeder::class,
            PortfolioItemSeeder::class,
        ]);
    }
}
