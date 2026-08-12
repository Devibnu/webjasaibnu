<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Service::defaultItems() as $data) {
            Service::query()->updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
