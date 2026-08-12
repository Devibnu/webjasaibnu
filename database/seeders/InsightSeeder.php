<?php

namespace Database\Seeders;

use App\Models\Insight;
use App\Models\InsightCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class InsightSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'slug' => 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun',
                'category' => 'SEO',
                'title' => 'Fondasi SEO Teknis yang Perlu Dipersiapkan Sejak Website Dibangun',
                'excerpt' => 'SEO yang baik tidak hanya dimulai dari konten, tetapi juga struktur website, performa, metadata, dan pengalaman pengguna.',
                'featured_image' => 'assets/startup2/img/blog-1.jpg',
                'content' => "SEO yang efektif bukan hanya soal menulis banyak artikel atau menempatkan keyword. Fondasi teknis website sangat memengaruhi kemampuan mesin pencari dalam memahami, mengindeks, dan menampilkan halaman kepada calon pelanggan.\n\n## Struktur Website yang Jelas\n\nGunakan struktur halaman yang sederhana dan konsisten agar pengguna maupun mesin pencari dapat memahami hubungan antar halaman dengan mudah.\n\n## Performa dan Core Web Performance\n\nWebsite yang cepat memberikan pengalaman pengguna yang lebih baik dan membantu mengurangi potensi pengunjung meninggalkan halaman sebelum konten selesai dimuat.\n\n## Metadata dan Semantic HTML\n\nTitle, meta description, heading, internal link, alt image, dan struktur HTML perlu dipersiapkan sejak proses development.\n\n## Mobile Responsiveness\n\nWebsite harus nyaman digunakan pada desktop, tablet, dan smartphone karena sebagian besar pengguna mengakses informasi melalui perangkat mobile.\n\n## Keamanan dan HTTPS\n\nHTTPS, update dependency, kontrol akses, backup, dan monitoring menjadi bagian penting dari kualitas teknis website.\n\nFondasi SEO sebaiknya dipikirkan sejak awal pembangunan website, bukan ditambahkan setelah website selesai. Dengan struktur dan teknologi yang tepat, optimasi SEO selanjutnya akan lebih mudah dikembangkan.",
            ],
            [
                'slug' => 'kapan-bisnis-membutuhkan-aplikasi-web-custom',
                'category' => 'Web Application',
                'title' => 'Kapan Bisnis Membutuhkan Aplikasi Web Custom?',
                'excerpt' => 'Aplikasi custom dapat menjadi pilihan ketika proses bisnis sudah sulit ditangani menggunakan aplikasi generik atau pekerjaan manual.',
                'featured_image' => 'assets/startup2/img/blog-2.jpg',
                'content' => "Aplikasi web custom membantu bisnis menyusun workflow yang lebih sesuai dengan cara kerja internal, terutama ketika tools generik mulai membatasi proses dan data.\n\n## Proses Bisnis Mulai Spesifik\n\nKebutuhan approval, pelaporan, role akses, integrasi, dan dashboard sering kali membutuhkan sistem yang dirancang khusus.\n\n## Data Perlu Terintegrasi\n\nAplikasi custom dapat menghubungkan data operasional, customer, sales, dan layanan agar keputusan bisnis lebih mudah diambil.",
            ],
            [
                'slug' => 'hal-yang-perlu-dipersiapkan-sebelum-membangun-produk-saas',
                'category' => 'SaaS',
                'title' => 'Hal yang Perlu Dipersiapkan Sebelum Membangun Produk SaaS',
                'excerpt' => 'Mulai dari model bisnis hingga arsitektur aplikasi, beberapa keputusan awal sangat memengaruhi kemampuan SaaS untuk berkembang.',
                'featured_image' => 'assets/startup2/img/blog-3.jpg',
                'content' => "Produk SaaS membutuhkan keputusan awal yang rapi, mulai dari segmentasi pengguna, model subscription, struktur data, hingga strategi pengembangan fitur.\n\n## Arsitektur yang Siap Berkembang\n\nPilihan arsitektur, keamanan tenant, billing, dan monitoring perlu disiapkan sejak awal agar produk lebih mudah diskalakan.",
            ],
            [
                'slug' => 'penerapan-ai-yang-realistis-untuk-meningkatkan-produktivitas-bisnis',
                'category' => 'AI Integration',
                'title' => 'Penerapan AI yang Realistis untuk Meningkatkan Produktivitas Bisnis',
                'excerpt' => 'AI dapat membantu automation, pencarian informasi, customer support, dan proses internal jika diterapkan pada kebutuhan yang tepat.',
                'featured_image' => 'assets/startup2/img/blog-1.jpg',
                'content' => "AI paling efektif ketika diterapkan pada proses yang jelas, memiliki data pendukung, dan dapat diukur dampaknya terhadap produktivitas tim.\n\n## Mulai dari Use Case yang Terukur\n\nAutomation dokumen, pencarian knowledge base, customer support, dan analisis data internal dapat menjadi titik awal yang realistis.",
            ],
            [
                'slug' => 'mengapa-integrasi-sistem-penting-dalam-transformasi-digital',
                'category' => 'System Integration',
                'title' => 'Mengapa Integrasi Sistem Penting dalam Transformasi Digital?',
                'excerpt' => 'Integrasi membantu aplikasi dan data bekerja sebagai satu ekosistem sehingga proses bisnis tidak lagi berjalan secara terpisah.',
                'featured_image' => 'assets/startup2/img/blog-2.jpg',
                'content' => "Integrasi sistem mengurangi pekerjaan manual berulang, mempercepat aliran data, dan membuat proses lintas divisi lebih mudah dipantau.\n\n## Satu Ekosistem Data\n\nAPI, webhook, dan sinkronisasi data membantu aplikasi bisnis bekerja saling terhubung tanpa input manual yang berlebihan.",
            ],
            [
                'slug' => 'keamanan-website-bisnis-yang-tidak-boleh-diabaikan',
                'category' => 'Security',
                'title' => 'Keamanan Website Bisnis yang Tidak Boleh Diabaikan',
                'excerpt' => 'Update sistem, backup, kontrol akses, HTTPS, dan monitoring menjadi fondasi penting untuk menjaga website bisnis tetap aman.',
                'featured_image' => 'assets/startup2/img/blog-3.jpg',
                'content' => "Keamanan website perlu menjadi bagian dari proses development dan maintenance, bukan hanya tindakan darurat ketika masalah sudah terjadi.\n\n## Fondasi Keamanan Dasar\n\nHTTPS, update dependency, backup berkala, role akses, dan monitoring membantu mengurangi risiko gangguan pada website bisnis.",
            ],
        ];

        foreach ($articles as $index => $article) {
            $category = InsightCategory::where('slug', Str::slug($article['category']))->first();

            Insight::updateOrCreate(
                ['slug' => $article['slug']],
                [
                    'insight_category_id' => $category?->id,
                    'title' => $article['title'],
                    'excerpt' => $article['excerpt'],
                    'content' => $article['content'],
                    'featured_image' => $article['featured_image'],
                    'status' => Insight::STATUS_PUBLISHED,
                    'published_at' => Carbon::now()->subDays(count($articles) - $index),
                    'seo_title' => $article['title'],
                    'seo_description' => $article['excerpt'],
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
