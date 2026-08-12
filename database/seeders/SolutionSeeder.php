<?php

namespace Database\Seeders;

use App\Models\Solution;
use Illuminate\Database\Seeder;

class SolutionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Solution::defaultItems() as $data) {
            Solution::query()->updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
