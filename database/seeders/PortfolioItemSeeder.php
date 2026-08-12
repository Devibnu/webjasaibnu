<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PortfolioItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'code' => 'CRM',
                'category' => 'Business Application',
                'title' => 'Enterprise CRM Platform',
                'excerpt' => 'Platform CRM untuk pengelolaan customer, sales, ticketing, service management, dan proses bisnis dalam satu sistem terintegrasi.',
                'technologies' => ['Laravel', 'PostgreSQL', 'REST API'],
            ],
            [
                'code' => 'WEB',
                'category' => 'Corporate Website',
                'title' => 'Business Website Development',
                'excerpt' => 'Website perusahaan yang responsive, SEO-ready, mudah dikelola, dan dirancang untuk mendukung kebutuhan branding serta lead generation.',
                'technologies' => ['Laravel / WordPress', 'SEO', 'Responsive'],
            ],
            [
                'code' => 'EDU',
                'category' => 'Education SaaS',
                'title' => 'Online Examination Platform',
                'excerpt' => 'Platform ujian online untuk sekolah dengan pilihan ganda, esai, penilaian, hasil ujian, dan workflow pengelolaan guru.',
                'technologies' => ['SaaS', 'Laravel', 'Web Application'],
            ],
            [
                'code' => 'SMS',
                'category' => 'Business Application',
                'title' => 'Service Management System',
                'excerpt' => 'Sistem pengelolaan ticket, SLA, case resolution, customer satisfaction, dan monitoring pelayanan secara terstruktur.',
                'technologies' => ['Laravel', 'Workflow', 'Dashboard'],
            ],
            [
                'code' => 'SMP',
                'category' => 'Sales Application',
                'title' => 'Sales Management Platform',
                'excerpt' => 'Aplikasi untuk pengelolaan lead, opportunity, pipeline, quotation, forecasting, serta analisis win dan lost.',
                'technologies' => ['CRM', 'Analytics', 'PostgreSQL'],
            ],
            [
                'code' => 'API',
                'category' => 'Integration',
                'title' => 'AI & System Integration',
                'excerpt' => 'Implementasi integrasi API dan AI untuk membantu automation, intelligent workflow, pencarian informasi, serta produktivitas bisnis.',
                'technologies' => ['AI', 'REST API', 'Automation'],
            ],
        ];

        foreach ($items as $index => $item) {
            $category = PortfolioCategory::where('slug', Str::slug($item['category']))->first();

            PortfolioItem::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'portfolio_category_id' => $category?->id,
                    'title' => $item['title'],
                    'code' => $item['code'],
                    'excerpt' => $item['excerpt'],
                    'description' => $item['excerpt'],
                    'technologies' => $item['technologies'],
                    'status' => PortfolioItem::STATUS_PUBLISHED,
                    'published_at' => Carbon::now()->subDays(count($items) - $index),
                    'sort_order' => $index + 1,
                    'is_featured' => $index < 3,
                    'seo_title' => $item['title'],
                    'seo_description' => $item['excerpt'],
                ]
            );
        }
    }
}
