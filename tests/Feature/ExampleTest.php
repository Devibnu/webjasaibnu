<?php

namespace Tests\Feature;

use App\Models\Insight;
use App\Models\InsightCategory;
use App\Models\ContactMessage;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\PortfolioPageSetting;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\VisitorEvent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $homepageH1Matches);
        $this->assertSame(1, count($homepageH1Matches[0]));
        $response->assertSee('<h1 class="display-1 text-white mb-md-4 animated zoomIn startup2-hero-title">Solusi Digital untuk Bisnis yang Siap Bertumbuh</h1>', false);
        $response->assertSee('PT JASA IBNU DEVELOPMENT');
        $response->assertSee('Solusi Digital untuk Bisnis yang Siap Bertumbuh');
        $response->assertSee('JASAIBNU');
        $response->assertSee('Software Development');
        $response->assertSee('<title>Jasa Pembuatan Website, Aplikasi &amp; SEO | JASAIBNU</title>', false);
        $response->assertSee('JASAIBNU menyediakan jasa pembuatan website, aplikasi bisnis, SaaS, SEO, integrasi sistem, dan AI', false);
        $response->assertSee('Jasa SEO dan optimasi website disiapkan natural untuk bisnis di Serang, Banten', false);
        $response->assertSee('aria-label="Lihat Jasa Pembuatan Website di Serang"', false);
        $response->assertSee(route('website-development-serang'), false);
        $response->assertSee('Jasa pembuatan website Banten', false);
        $response->assertSee('website UMKM Serang', false);
        $response->assertSee('meta name="description"', false);
        $response->assertSee('rel="canonical"', false);
        $response->assertSee(route('services.index'), false);
        $response->assertSee(route('solutions.index'), false);
        $response->assertSee(route('portfolio.index'), false);
        $response->assertSee(route('insights.index'), false);
        $response->assertSee(route('contact'), false);
        $response->assertDontSee('href="#services"', false);
        $response->assertDontSee('href="#solutions"', false);
        $response->assertDontSee('href="#portfolio"', false);
        $response->assertDontSee('href="#about"', false);
        $response->assertDontSee('href="#contact"', false);
    }

    public function test_homepage_prioritizes_lcp_hero_and_lazy_loads_below_fold_images()
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('href="' . asset('assets/startup2/img/optimized/carousel-1-mobile.webp') . '"', false);
        $response->assertSee('imagesrcset="' . asset('assets/startup2/img/optimized/carousel-1-mobile.webp') . ' 768w, ' . asset('assets/startup2/img/optimized/carousel-1-desktop.webp') . ' 1280w"', false);
        $response->assertSee('<source type="image/webp" media="(max-width: 767px)" srcset="' . asset('assets/startup2/img/optimized/carousel-1-mobile.webp') . '">', false);
        $this->assertMatchesRegularExpression('/src="' . preg_quote(asset('assets/startup2/img/carousel-1.jpg'), '/') . '"[^>]+width="1280"[^>]+height="720"[^>]+fetchpriority="high"[^>]+decoding="sync"/', $response->getContent());
        $this->assertMatchesRegularExpression('/src="' . preg_quote(asset('assets/startup2/img/carousel-2.jpg'), '/') . '"[^>]+width="1280"[^>]+height="720"[^>]+loading="lazy"[^>]+decoding="async"/', $response->getContent());
        $response->assertSee('src="' . asset('assets/startup2/img/feature.jpg') . '" alt="Perencanaan solusi software untuk bisnis" width="800" height="800" loading="lazy" decoding="async"', false);
    }

    public function test_public_pages_are_available()
    {
        $this->withoutVite();

        $pages = [
            route('services.index') => 'Solusi Digital untuk Mendukung Pertumbuhan Bisnis Anda',
            route('seo-serang') => 'Jasa SEO Serang untuk Meningkatkan Visibilitas Website Bisnis',
            route('website-development-serang') => 'Jasa Pembuatan Website di Serang untuk Bisnis yang Ingin Tampil Profesional',
            route('website-development-banten') => 'Jasa Pembuatan Website Banten untuk Bisnis, UMKM, dan Layanan Profesional',
            route('website-development-serang-murah') => 'Jasa Pembuatan Website Serang Murah untuk Bisnis yang Tetap Ingin Terlihat Profesional',
            route('website-development-umkm-serang') => 'Jasa Website UMKM Serang untuk Usaha Lokal yang Ingin Lebih Mudah Ditemukan',
            route('solutions.index') => 'Solusi Teknologi yang Dibangun Sesuai Kebutuhan Bisnis',
            route('portfolio.index') => 'Solusi Digital yang Kami Bangun untuk Kebutuhan Bisnis',
            route('insights.index') => 'Fondasi SEO Teknis yang Perlu Dipersiapkan Sejak Website Dibangun',
            route('about') => 'Partner Teknologi untuk Pertumbuhan Bisnis Digital',
            route('contact') => 'Mari Diskusikan Kebutuhan Digital Anda',
        ];

        foreach ($pages as $url => $heading) {
            $this->get($url)
                ->assertOk()
                ->assertSee($heading)
                ->assertSee('meta name="description"', false)
                ->assertSee('rel="canonical"', false);
        }
    }

    public function test_serang_website_development_landing_page_targets_local_keyword()
    {
        $this->withoutVite();

        $response = $this->get(route('website-development-serang'));

        $response
            ->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Serang &amp; Banten | JASAIBNU</title>', false)
            ->assertSee('JASAIBNU menyediakan jasa pembuatan website di Serang dan Banten', false)
            ->assertSee('Jasa Pembuatan Website di Serang untuk Bisnis yang Ingin Tampil Profesional')
            ->assertSee('Website membantu bisnis Serang dan Banten lebih mudah ditemukan', false)
            ->assertSee('rel="canonical" href="' . route('website-development-serang') . '"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_banten_website_development_landing_page_targets_local_keyword()
    {
        $this->withoutVite();

        $response = $this->get(route('website-development-banten'));

        $response
            ->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Banten | Website Bisnis &amp; UMKM</title>', false)
            ->assertSee('Jasa pembuatan website Banten untuk bisnis, UMKM', false)
            ->assertSee('Jasa Pembuatan Website Banten untuk Bisnis, UMKM, dan Layanan Profesional')
            ->assertSee('Website membantu bisnis di Banten tampil lebih kredibel', false)
            ->assertSee('rel="canonical" href="' . route('website-development-banten') . '"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_banten_geographic_schema_and_minimal_internal_link_preserve_locked_contracts()
    {
        $this->withoutVite();

        SiteSetting::current()->update([
            'address' => 'Jl Kelapa Dua, Kagungan, Kec. Serang, Kota Serang, Banten 42114',
            'city' => 'Serang',
            'region' => 'Banten',
            'country' => 'Indonesia',
        ]);

        $national = $this->get(route('website-development'));
        $national->assertOk()
            ->assertSee('href="' . route('website-development-banten') . '">jasa pembuatan website Banten</a>', false);
        $this->assertSame(1, $this->anchorCountForUrl($national->getContent(), route('website-development-banten')));

        $serang = $this->get(route('website-development-serang'));
        $serang->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Serang &amp; Banten | JASAIBNU</title>', false)
            ->assertSee('<h1 id="website-service-title">Jasa Pembuatan Website di Serang untuk Bisnis yang Ingin Tampil Profesional</h1>', false)
            ->assertSee('rel="canonical" href="' . route('website-development-serang') . '"', false);

        $banten = $this->get(route('website-development-banten'));
        $banten->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Banten | Website Bisnis &amp; UMKM</title>', false)
            ->assertSee('<h1 id="website-service-title">Jasa Pembuatan Website Banten untuk Bisnis, UMKM, dan Layanan Profesional</h1>', false)
            ->assertSee('rel="canonical" href="' . route('website-development-banten') . '"', false);

        preg_match_all('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $banten->getContent(), $jsonLdMatches);
        $schemas = collect($jsonLdMatches[1])->map(fn ($json) => json_decode($json, true));
        $organization = $schemas->firstWhere('@type', 'Organization');
        $professionalService = $schemas->firstWhere('@type', 'ProfessionalService');

        $this->assertSame('Serang', $organization['address']['addressLocality'] ?? null);
        $this->assertSame('Banten', $organization['address']['addressRegion'] ?? null);
        $this->assertSame('Indonesia', $organization['address']['addressCountry'] ?? null);
        $this->assertSame(rtrim(route('home'), '/') . '#professional-service', $professionalService['@id'] ?? null);
        $this->assertContains(['@type' => 'City', 'name' => 'Serang'], $professionalService['areaServed'] ?? []);
        $this->assertContains(['@type' => 'AdministrativeArea', 'name' => 'Banten'], $professionalService['areaServed'] ?? []);
        $this->assertContains(['@type' => 'Country', 'name' => 'Indonesia'], $professionalService['areaServed'] ?? []);
        $this->assertNotContains(['@type' => 'Country', 'name' => 'Banten'], $professionalService['areaServed'] ?? []);

        $this->get(route('seo-serang'))->assertOk();
    }

    public function test_banten_locked_ui_preserves_seo_contract_and_isolates_protected_pages()
    {
        $this->withoutVite();

        $response = $this->get(route('website-development-banten'));
        $html = $response->getContent();

        $response
            ->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Banten | Website Bisnis &amp; UMKM</title>', false)
            ->assertSee('<meta name="description" content="Jasa pembuatan website Banten untuk bisnis, UMKM, company profile, landing page, dan website layanan yang cepat, mobile-friendly, SEO-ready, aman, dan mudah dikembangkan.">', false)
            ->assertSee('<meta name="robots" content="index,follow">', false)
            ->assertSee('rel="canonical" href="' . route('website-development-banten') . '"', false)
            ->assertSee('<meta property="og:title" content="Jasa Pembuatan Website Banten | Website Bisnis &amp; UMKM">', false)
            ->assertSee('<meta property="og:description" content="Jasa pembuatan website Banten untuk bisnis, UMKM, company profile, landing page, dan website layanan yang cepat, mobile-friendly, SEO-ready, aman, dan mudah dikembangkan.">', false)
            ->assertSee('<meta property="og:url" content="' . route('website-development-banten') . '">', false)
            ->assertSee('<h1 id="website-service-title">Jasa Pembuatan Website Banten untuk Bisnis, UMKM, dan Layanan Profesional</h1>', false)
            ->assertSee('href="' . route('website-development-serang') . '">jasa website untuk area Serang</a>', false)
            ->assertSee('class="banten-hero-visual" aria-hidden="true"', false)
            ->assertDontSee('assets/images/hero-banten.jpeg', false)
            ->assertSee('services-page startup2-home banten-conversion-page', false)
            ->assertSee('data-national-faq-button', false)
            ->assertSee('<h3>Testing &amp; Launching</h3>', false)
            ->assertSee('<body class="services-page startup2-home banten-conversion-page">', false);

        $this->assertSame(1, preg_match_all('/<section\b[^>]*aria-labelledby="website-faq-title"/i', $html));
        $this->assertSame(8, preg_match_all('/<button\b[^>]*data-national-faq-button/i', $html));
        $this->assertSame(3, substr_count($html, 'type="application/ld+json"'));
        $this->assertSame(1, $this->anchorCountForUrl($html, route('website-development-serang')));

        $sectionMarkers = [
            'website-service-title',
            'national-trust-strip',
            'national-offer-title',
            'national-proof-title',
            'website-benefits-title',
            'website-process-title',
            'website-faq-title',
            'website-cta-title',
        ];
        $bodyPosition = strpos($html, '<body');
        $lastPosition = $bodyPosition;
        foreach ($sectionMarkers as $marker) {
            $position = strpos($html, $marker, $bodyPosition);
            $this->assertNotFalse($position, "Missing locked Banten section marker: {$marker}");
            $this->assertGreaterThan($lastPosition, $position, "Incorrect Banten section order at: {$marker}");
            $lastPosition = $position;
        }

        foreach ([
            'website-development' => 'services-page startup2-home national-conversion-page',
            'website-development-serang' => 'services-page startup2-home',
            'website-development-serang-murah' => 'services-page startup2-home serang-murah-simple-page',
            'website-development-umkm-serang' => 'services-page startup2-home',
        ] as $routeName => $expectedClass) {
            $protected = $this->get(route($routeName));
            $protected->assertOk()->assertSee('<body class="' . $expectedClass . '">', false);
        }
    }

    public function test_serang_affordable_website_development_landing_page_targets_local_keyword()
    {
        $this->withoutVite();

        $response = $this->get(route('website-development-serang-murah'));

        $response
            ->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Serang Murah &amp; Profesional | JASAIBNU</title>', false)
            ->assertSee('Jasa pembuatan website Serang murah untuk bisnis yang ingin mulai dari website sederhana', false)
            ->assertSee('Jasa Pembuatan Website Serang Murah untuk Bisnis yang Tetap Ingin Terlihat Profesional')
            ->assertSee('Website terjangkau membantu bisnis Serang mulai tampil profesional', false)
            ->assertSee('rel="canonical" href="' . route('website-development-serang-murah') . '"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_serang_affordable_locked_simple_ui_preserves_seo_and_protected_pages()
    {
        $this->withoutVite();

        $response = $this->get(route('website-development-serang-murah'));
        $html = $response->getContent();

        $response
            ->assertOk()
            ->assertSee('<body class="services-page startup2-home serang-murah-simple-page">', false)
            ->assertSee('<title>Jasa Pembuatan Website Serang Murah &amp; Profesional | JASAIBNU</title>', false)
            ->assertSee('<meta name="description" content="Jasa pembuatan website Serang murah untuk bisnis yang ingin mulai dari website sederhana, rapi, mobile-friendly, mudah dihubungi pelanggan, dan tetap profesional.">', false)
            ->assertSee('<meta name="robots" content="index,follow">', false)
            ->assertSee('rel="canonical" href="' . route('website-development-serang-murah') . '"', false)
            ->assertSee('<meta property="og:title" content="Jasa Pembuatan Website Serang Murah &amp; Profesional | JASAIBNU">', false)
            ->assertSee('<meta property="og:description" content="Jasa pembuatan website Serang murah untuk bisnis yang ingin mulai dari website sederhana, rapi, mobile-friendly, mudah dihubungi pelanggan, dan tetap profesional.">', false)
            ->assertSee('<h1 id="website-service-title">Jasa Pembuatan Website Serang Murah untuk Bisnis yang Tetap Ingin Terlihat Profesional</h1>', false)
            ->assertSee('href="' . route('website-development-serang') . '">jasa pembuatan website profesional di Serang</a>', false)
            ->assertSee('class="serang-murah-benefits"', false)
            ->assertSee('class="serang-murah-section serang-murah-services"', false)
            ->assertSee('class="serang-murah-section serang-murah-advantages"', false)
            ->assertSee('class="serang-murah-section serang-murah-process-faq"', false)
            ->assertSee('class="serang-murah-cta"', false);

        preg_match_all('/<h1(\s|>)/i', $html, $h1Matches);
        preg_match_all('/class="serang-murah-faq"/', $html, $faqMatches);
        $this->assertSame(1, count($h1Matches[0]));
        $this->assertSame(8, count($faqMatches[0]));

        $lastPosition = -1;
        foreach (['class="serang-murah-benefits"', 'class="serang-murah-section serang-murah-services"', 'class="serang-murah-section serang-murah-advantages"', 'class="serang-murah-section serang-murah-process-faq"', 'class="serang-murah-cta"'] as $marker) {
            $position = strpos($html, $marker);
            $this->assertNotFalse($position, "Missing locked Serang Murah section marker: {$marker}");
            $this->assertGreaterThan($lastPosition, $position, "Incorrect Serang Murah section order at: {$marker}");
            $lastPosition = $position;
        }

        foreach (['website-development', 'website-development-serang', 'website-development-umkm-serang', 'website-development-banten'] as $routeName) {
            $protected = $this->get(route($routeName));
            $protected->assertOk()->assertDontSee('<body class="services-page startup2-home serang-murah-simple-page">', false);
        }
    }

    public function test_serang_umkm_website_development_landing_page_targets_local_keyword()
    {
        $this->withoutVite();

        $response = $this->get(route('website-development-umkm-serang'));

        $response
            ->assertOk()
            ->assertSee('<title>Jasa Website UMKM Serang | Website Usaha Lokal</title>', false)
            ->assertSee('Jasa website UMKM Serang untuk toko, jasa lokal, kuliner', false)
            ->assertSee('Jasa Website UMKM Serang untuk Usaha Lokal yang Ingin Lebih Mudah Ditemukan')
            ->assertSee('profil usaha, katalog sederhana, layanan, alamat', false)
            ->assertSee('Website membantu UMKM Serang terlihat lebih dipercaya', false)
            ->assertSee('rel="canonical" href="' . route('website-development-umkm-serang') . '"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_supporting_local_landing_pages_link_once_to_primary_serang_page()
    {
        $this->withoutVite();

        $primaryUrl = route('website-development-serang');
        $landingPages = [
            'website-development-serang-murah' => 'jasa pembuatan website profesional di Serang',
            'website-development-umkm-serang' => 'layanan pembuatan website di Serang',
            'website-development-banten' => 'jasa website untuk area Serang',
        ];

        $primaryResponse = $this->get($primaryUrl);
        $primaryResponse->assertOk();
        $this->assertSame(0, $this->anchorCountForUrl($primaryResponse->getContent(), $primaryUrl));

        foreach ($landingPages as $routeName => $anchorText) {
            $response = $this->get(route($routeName));

            $response
                ->assertOk()
                ->assertSee('href="' . $primaryUrl . '">' . $anchorText . '</a>', false);

            $this->assertSame(1, $this->anchorCountForUrl($response->getContent(), $primaryUrl));
        }
    }

    public function test_national_website_page_adds_national_content_and_reuses_published_portfolio()
    {
        $this->withoutVite();

        PortfolioItem::create([
            'title' => 'National Published Website Proof',
            'slug' => 'national-published-website-proof',
            'code' => 'NPW',
            'excerpt' => 'Published proof reused on the national website service page.',
            'description' => 'Published proof reused on the national website service page.',
            'technologies' => ['Laravel', 'Responsive'],
            'status' => PortfolioItem::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'sort_order' => 0,
        ]);

        PortfolioItem::create([
            'title' => 'National Draft Website Proof',
            'slug' => 'national-draft-website-proof',
            'excerpt' => 'Draft proof must not appear.',
            'status' => PortfolioItem::STATUS_DRAFT,
            'sort_order' => 0,
        ]);

        $response = $this->get(route('website-development'));

        $response
            ->assertOk()
            ->assertSee('<title>Jasa Pembuatan Website Profesional | JASAIBNU</title>', false)
            ->assertSee('rel="canonical" href="' . route('website-development') . '"', false)
            ->assertSee('<h1 id="website-service-title">Jasa Pembuatan Website Profesional untuk Bisnis yang Ingin Tumbuh</h1>', false)
            ->assertSee('Pembuatan website untuk bisnis di berbagai wilayah Indonesia.')
            ->assertSee('Scope website disusun mengikuti kebutuhan dan kesiapan bisnis.')
            ->assertSee('National Published Website Proof')
            ->assertSee('Published proof reused on the national website service page.')
            ->assertSee('class="national-proof-fallback" aria-hidden="true">NPW</span>', false)
            ->assertSee('aria-label="Tahapan kolaborasi jarak jauh"', false)
            ->assertSee('class="national-trust-strip"', false)
            ->assertSee('class="national-primary-grid"', false)
            ->assertSee('class="national-why-grid"', false)
            ->assertSee('class="national-process-grid"', false)
            ->assertSee('data-national-faq-button', false)
            ->assertSee('aria-expanded="true" aria-controls="national-faq-answer-0"', false)
            ->assertSee('Berapa lama pembuatan website?')
            ->assertSee('Apakah bisa dibantu isi konten website?')
            ->assertDontSee('National Draft Website Proof');
    }

    public function test_national_page_receives_contextual_internal_links_from_approved_sources()
    {
        $this->withoutVite();

        $nationalUrl = route('website-development');
        $sources = [
            route('services.index') => 'layanan pembuatan website profesional',
            route('portfolio.index') => 'opsi pengembangan website untuk bisnis',
            route('insights.show', 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun') => 'layanan pembuatan website profesional',
            route('insights.show', 'keamanan-website-bisnis-yang-tidak-boleh-diabaikan') => 'pengembangan website untuk bisnis',
        ];

        foreach ($sources as $sourceUrl => $anchorText) {
            $response = $this->get($sourceUrl);

            $response
                ->assertOk()
                ->assertSee('href="' . $nationalUrl . '">' . $anchorText . '</a>', false);

            $this->assertSame(1, $this->anchorCountForUrl($response->getContent(), $nationalUrl));
        }
    }

    public function test_seo_serang_page_preserves_locked_contract_content_and_schema()
    {
        $this->withoutVite();

        $response = $this->get(route('seo-serang'));
        $html = $response->getContent();
        $canonical = 'https://jasaibnu.com/jasa-seo-serang';
        $description = 'Jasa SEO Serang untuk membantu website bisnis lebih mudah dipahami Google melalui audit teknis, optimasi on-page, struktur konten, dan monitoring.';

        $response
            ->assertOk()
            ->assertSee('<title>Jasa SEO Serang untuk Optimasi Website | JASAIBNU</title>', false)
            ->assertSee('<meta name="description" content="' . $description . '">', false)
            ->assertSee('<meta name="robots" content="index,follow">', false)
            ->assertSee('<link rel="canonical" href="' . $canonical . '">', false)
            ->assertSee('<meta property="og:title" content="Jasa SEO Serang untuk Optimasi Website | JASAIBNU">', false)
            ->assertSee('<meta property="og:description" content="' . $description . '">', false)
            ->assertSee('<meta property="og:url" content="' . $canonical . '">', false)
            ->assertSee('<meta property="og:type" content="website">', false)
            ->assertSee('<body class="startup2-home seo-serang-page">', false)
            ->assertSee('class="container-fluid bg-dark px-5 d-none d-lg-block"', false)
            ->assertSee('data-startup-nav-toggle', false)
            ->assertSee('class="nav-item nav-link  active ">Services</a>', false)
            ->assertSee('<h1 id="seo-serang-title">Jasa SEO Serang untuk Meningkatkan Visibilitas Website Bisnis</h1>', false)
            ->assertSee('class="seo-serang-visual" aria-hidden="true"', false)
            ->assertSee('Konsultasi SEO via WhatsApp')
            ->assertSee('Lihat Ruang Lingkup SEO')
            ->assertSee('Kesiapan Crawl &amp; Indexing', false)
            ->assertSee('Review Crawl, Indexing &amp; Performa', false)
            ->assertSee('Review &amp; Monitoring Teknis', false)
            ->assertSee('Konsultasikan SEO Website')
            ->assertSee('href="' . route('website-development-serang') . '">jasa pembuatan website di Serang</a>', false)
            ->assertSee('href="' . route('website-development') . '">layanan pembuatan website profesional</a>', false)
            ->assertSee('href="' . route('insights.show', 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun') . '">panduan fondasi SEO teknis</a>', false)
            ->assertSee('href="' . route('portfolio.index') . '">portfolio website JASAIBNU</a>', false)
            ->assertSee('href="' . route('contact') . '" style="color: #fff;">hubungi tim JASAIBNU</a>', false)
            ->assertDontSee('Ranking #1')
            ->assertDontSee('traffic guarantee')
            ->assertDontSee('backlink campaign')
            ->assertDontSee('Google Partner')
            ->assertDontSee('Google Search Console');

        $this->assertSame(1, preg_match_all('/<h1\b/i', $html));
        $this->assertSame(6, preg_match_all('/<details class="seo-serang-faq-item">/i', $html));

        preg_match_all('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $html, $jsonLdMatches);
        $schemas = collect($jsonLdMatches[1])->map(function ($json) {
            $decoded = json_decode($json, true);
            $this->assertIsArray($decoded, 'SEO Serang JSON-LD must be valid JSON.');

            return $decoded;
        });

        $service = $schemas->firstWhere('@type', 'Service');
        $breadcrumb = $schemas->firstWhere('@type', 'BreadcrumbList');
        $faqPage = $schemas->firstWhere('@type', 'FAQPage');
        $this->assertNotNull($service);
        $this->assertNotNull($breadcrumb);
        $this->assertNotNull($faqPage);
        $this->assertSame(['@id' => 'https://jasaibnu.com#professional-service'], $service['provider'] ?? null);
        $this->assertSame(['@type' => 'City', 'name' => 'Serang'], $service['areaServed'] ?? null);
        $this->assertSame(['Home', 'Services', 'Jasa SEO Serang'], collect($breadcrumb['itemListElement'])->pluck('name')->all());
        $this->assertCount(6, $faqPage['mainEntity'] ?? []);

        foreach ($faqPage['mainEntity'] as $faq) {
            $response->assertSee($faq['name']);
            $response->assertSee($faq['acceptedAnswer']['text']);
        }
    }

    public function test_approved_sources_link_to_seo_serang_without_touching_locked_landings()
    {
        $this->withoutVite();

        $seoUrl = route('seo-serang');
        $sources = [
            route('home') => 'Lihat layanan SEO di Serang',
            route('services.index') => 'Pelajari jasa SEO Serang',
            route('insights.show', 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun') => 'layanan SEO untuk bisnis di Serang',
            route('insights.show', 'cara-memilih-jasa-pembuatan-website-di-serang') => 'optimasi SEO lanjutan untuk website bisnis',
        ];

        foreach ($sources as $sourceUrl => $anchor) {
            $response = $this->get($sourceUrl);
            $response->assertOk()->assertSee('href="' . $seoUrl . '"', false)->assertSee($anchor);
            $this->assertSame(1, $this->anchorCountForUrl($response->getContent(), $seoUrl));
        }

        foreach (['website-development', 'website-development-serang', 'website-development-serang-murah', 'website-development-umkm-serang', 'website-development-banten'] as $routeName) {
            $protected = $this->get(route($routeName));
            $protected->assertOk()->assertDontSee('href="' . $seoUrl . '"', false);
        }
    }

    public function test_seo_serang_appears_once_in_sitemap()
    {
        $this->withoutVite();

        $response = $this->get(route('sitemap'));
        $response->assertOk();
        $this->assertSame(1, substr_count($response->getContent(), '<loc>' . route('seo-serang') . '</loc>'));
    }

    public function test_national_changes_do_not_modify_local_landing_page_output_contracts()
    {
        $this->withoutVite();

        $nationalUrl = route('website-development');
        $serangUrl = route('website-development-serang');
        $localPages = [
            'website-development-serang' => [
                'title' => 'Jasa Pembuatan Website Serang &amp; Banten | JASAIBNU',
                'h1' => 'Jasa Pembuatan Website di Serang untuk Bisnis yang Ingin Tampil Profesional',
                'first_h2' => 'Website membantu bisnis Serang dan Banten lebih mudah ditemukan, dipercaya, dan dihubungi calon pelanggan.',
                'serang_links' => 0,
                'h2_count' => 20,
            ],
            'website-development-serang-murah' => [
                'title' => 'Jasa Pembuatan Website Serang Murah &amp; Profesional | JASAIBNU',
                'h1' => 'Jasa Pembuatan Website Serang Murah untuk Bisnis yang Tetap Ingin Terlihat Profesional',
                'first_h2' => 'Website sederhana yang tepat untuk kebutuhan bisnis Anda.',
                'serang_links' => 1,
                'h2_count' => 5,
            ],
            'website-development-umkm-serang' => [
                'title' => 'Jasa Website UMKM Serang | Website Usaha Lokal',
                'h1' => 'Jasa Website UMKM Serang untuk Usaha Lokal yang Ingin Lebih Mudah Ditemukan',
                'first_h2' => 'Website membantu UMKM Serang terlihat lebih dipercaya saat pelanggan mencari produk atau layanan secara online.',
                'serang_links' => 1,
                'h2_count' => 20,
            ],
        ];

        foreach ($localPages as $routeName => $expected) {
            $url = route($routeName);
            $response = $this->get($url);
            $html = $response->getContent();

            $response
                ->assertOk()
                ->assertSee('<title>' . $expected['title'] . '</title>', false)
                ->assertSee('rel="canonical" href="' . $url . '"', false)
                ->assertSee('<h1 id="website-service-title">' . $expected['h1'] . '</h1>', false)
                ->assertDontSee('id="national-positioning-title"', false)
                ->assertDontSee('id="national-offer-title"', false)
                ->assertDontSee('id="national-proof-title"', false)
                ->assertDontSee('class="national-trust-strip"', false)
                ->assertDontSee('<button class="national-faq-question"', false);

            preg_match_all('/<h2\b[^>]*>(.*?)<\/h2>/si', $html, $h2Matches);
            $this->assertCount($expected['h2_count'], $h2Matches[1]);
            $this->assertSame($expected['first_h2'], trim(strip_tags($h2Matches[1][0])));
            $this->assertSame(0, $this->anchorCountForUrl($html, $nationalUrl));
            $this->assertSame($expected['serang_links'], $this->anchorCountForUrl($html, $serangUrl));
        }
    }

    private function anchorCountForUrl(string $html, string $url): int
    {
        preg_match_all('/<a\b[^>]*\bhref="' . preg_quote($url, '/') . '"[^>]*>/i', $html, $matches);

        return count($matches[0]);
    }

    public function test_insight_detail_page_is_available()
    {
        $this->withoutVite();

        $response = $this->get(route('insights.show', 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun'));

        $response
            ->assertOk()
            ->assertSee('<body class="insights-page startup2-home">', false)
            ->assertSee('<p class="insights-page-label">INSIGHT</p>', false)
            ->assertSee('Fondasi SEO Teknis yang Perlu Dipersiapkan Sejak Website Dibangun')
            ->assertSee('class="row g-5 insights-detail-layout"', false)
            ->assertSee('class="col-lg-8"', false)
            ->assertSee('class="col-lg-4"', false)
            ->assertSee('class="insights-sidebar insights-detail-sidebar"', false)
            ->assertSee('Categories')
            ->assertSee('Recent Post')
            ->assertSee('Home')
            ->assertSee('Insights')
            ->assertDontSee('Insight Detail')
            ->assertSee('Struktur Website yang Jelas')
            ->assertSee('Fondasi SEO sebaiknya dipikirkan sejak awal pembangunan website')
            ->assertSee('meta name="description"', false)
            ->assertSee('rel="canonical"', false)
            ->assertSee('"@type": "BlogPosting"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_serang_website_selection_insight_is_published()
    {
        $this->withoutVite();

        $response = $this->get(route('insights.show', 'cara-memilih-jasa-pembuatan-website-di-serang'));

        $response
            ->assertOk()
            ->assertSee('<title>Cara Memilih Jasa Pembuatan Website di Serang</title>', false)
            ->assertSee('Cara Memilih Jasa Pembuatan Website di Serang')
            ->assertSee('jasa pembuatan website di Serang')
            ->assertSee('Pastikan Website Cepat Dibuka di Mobile')
            ->assertSee('JASAIBNU membantu bisnis di Serang, Banten, dan area sekitarnya')
            ->assertSee('rel="canonical" href="' . route('insights.show', 'cara-memilih-jasa-pembuatan-website-di-serang') . '"', false)
            ->assertSee('<meta property="og:image" content="' . asset('assets/startup2/img/blog-1.jpg') . '">', false)
            ->assertSee('<meta name="twitter:image" content="' . asset('assets/startup2/img/blog-1.jpg') . '">', false)
            ->assertSee('"@type": "BlogPosting"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_services_and_portfolio_pages_render_one_h1()
    {
        $this->withoutVite();

        foreach ([route('services.index'), route('portfolio.index')] as $url) {
            $response = $this->get($url);
            $response->assertOk();

            preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
            $this->assertSame(1, count($h1Matches[0]), $url . ' should render exactly one H1.');
        }
    }

    public function test_contact_form_accepts_valid_submission()
    {
        Log::spy();

        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Ibnu Qosim',
            'email' => 'ibnu@example.com',
            'phone' => '',
            'company' => 'JASAIBNU',
            'service' => 'Website Development',
            'message' => 'Saya ingin mendiskusikan kebutuhan website bisnis.',
        ]);

        $response
            ->assertRedirect(route('contact'))
            ->assertSessionHas('contact_status');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Ibnu Qosim',
            'email' => 'ibnu@example.com',
            'company' => 'JASAIBNU',
            'service' => 'Website Development',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        Log::shouldNotHaveReceived('info');
    }

    public function test_contact_form_rejects_invalid_submission()
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'service' => '',
            'message' => '',
        ]);

        $response
            ->assertRedirect(route('contact'))
            ->assertSessionHasErrors(['name', 'email', 'service', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_admin_login_routes_use_weblogin()
    {
        $this->withoutVite();

        $this->get('/weblogin')
            ->assertOk()
            ->assertSee('JASAIBNU')
            ->assertSee(route('admin.login.store'), false);

        $this->get('/admin')
            ->assertRedirect('/weblogin');

        $this->get('/admin/login')
            ->assertRedirect('/weblogin');
    }

    public function test_authenticated_admin_opening_weblogin_redirects_to_admin()
    {
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        $user->id = 1;

        $this->actingAs($user)
            ->get('/weblogin')
            ->assertRedirect('/admin');
    }

    public function test_admin_dashboard_requires_admin_user()
    {
        $normalUser = new User([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'is_admin' => false,
        ]);
        $normalUser->id = 2;

        $this->actingAs($normalUser)
            ->get('/admin')
            ->assertRedirect('/weblogin');

        $adminUser = new User([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        $adminUser->id = 3;

        $this->actingAs($adminUser)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Quick Actions');
    }

    public function test_public_visits_are_tracked_on_admin_dashboard()
    {
        $this->withoutVite();

        VisitorEvent::query()->delete();

        $this->get(route('home'))->assertOk();
        $this->get(route('portfolio.index'))->assertOk();
        $this->get(route('robots'))->assertOk();

        $this->assertSame(2, VisitorEvent::count());
        $this->assertDatabaseHas('visitor_events', ['path' => '/']);
        $this->assertDatabaseHas('visitor_events', ['path' => '/portfolio']);
        $this->assertDatabaseMissing('visitor_events', ['path' => '/robots.txt']);

        $adminUser = User::factory()->create(['is_admin' => true]);

        $this->actingAs($adminUser)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Page Views Today')
            ->assertSee('Visitors Today')
            ->assertSee('Total Page Views')
            ->assertSee('2');

        $this->get(route('admin.dashboard'))->assertOk();
        $this->assertSame(2, VisitorEvent::count());
    }

    public function test_admin_insights_are_protected_and_drafts_are_not_public()
    {
        $category = InsightCategory::create([
            'name' => 'Testing',
            'slug' => 'testing',
            'is_active' => true,
            'sort_order' => 99,
        ]);

        $draft = Insight::create([
            'insight_category_id' => $category->id,
            'title' => 'Draft Test Insight',
            'slug' => 'draft-test-insight',
            'excerpt' => 'Draft excerpt for testing.',
            'content' => 'Draft content for testing.',
            'status' => Insight::STATUS_DRAFT,
        ]);

        $adminUser = new User([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        $adminUser->id = 3;

        $this->get(route('admin.insights.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.insights.index'))
            ->assertOk()
            ->assertSee('Insights');

        $this->get(route('insights.show', $draft->slug))
            ->assertNotFound();
    }

    public function test_public_portfolio_only_shows_published_items()
    {
        $this->withoutVite();

        $category = PortfolioCategory::create([
            'name' => 'Testing Portfolio',
            'slug' => 'testing-portfolio',
            'is_active' => true,
            'sort_order' => 99,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Published Portfolio Test',
            'slug' => 'published-portfolio-test',
            'code' => 'PUB',
            'excerpt' => 'Visible portfolio item for testing.',
            'description' => 'Visible portfolio item for testing.',
            'technologies' => ['Laravel', 'CMS'],
            'status' => PortfolioItem::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'sort_order' => 1,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Draft Portfolio Test',
            'slug' => 'draft-portfolio-test',
            'excerpt' => 'Hidden draft portfolio item.',
            'status' => PortfolioItem::STATUS_DRAFT,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Future Portfolio Test',
            'slug' => 'future-portfolio-test',
            'excerpt' => 'Hidden future portfolio item.',
            'status' => PortfolioItem::STATUS_PUBLISHED,
            'published_at' => now()->addDay(),
        ]);

        $this->get(route('portfolio.index'))
            ->assertOk()
            ->assertSee('Published Portfolio Test')
            ->assertSee('PUB')
            ->assertSee('Laravel')
            ->assertDontSee('Draft Portfolio Test')
            ->assertDontSee('Future Portfolio Test');
    }

    public function test_admin_portfolio_requires_admin_and_can_create_items()
    {
        $this->withoutVite();

        $category = PortfolioCategory::create([
            'name' => 'Admin Portfolio',
            'slug' => 'admin-portfolio',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $normalUser = User::create([
            'name' => 'Normal User',
            'email' => 'normal-portfolio@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin-portfolio@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.portfolio.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.portfolio.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.portfolio.index'))
            ->assertOk()
            ->assertSee('Portfolio');

        $this->actingAs($adminUser)
            ->post(route('admin.portfolio.store'), [
                'portfolio_category_id' => $category->id,
                'title' => 'Admin Created Portfolio',
                'slug' => 'admin-created-portfolio',
                'code' => 'ACP',
                'excerpt' => 'Created from a feature test.',
                'description' => 'Created from a feature test.',
                'technologies' => 'Laravel, MySQL, Soft UI',
                'status' => PortfolioItem::STATUS_DRAFT,
                'sort_order' => 7,
                'is_featured' => '1',
            ])
            ->assertRedirect(route('admin.portfolio.index'));

        $this->assertDatabaseHas('portfolio_items', [
            'slug' => 'admin-created-portfolio',
            'status' => PortfolioItem::STATUS_DRAFT,
            'is_featured' => true,
        ]);

        $this->actingAs($adminUser)
            ->from(route('admin.portfolio.create'))
            ->post(route('admin.portfolio.store'), [
                'title' => 'Duplicate Portfolio Slug',
                'slug' => 'admin-created-portfolio',
                'status' => PortfolioItem::STATUS_DRAFT,
            ])
            ->assertRedirect(route('admin.portfolio.create'))
            ->assertSessionHasErrors('slug');
    }

    public function test_portfolio_page_settings_control_public_intro_and_cta_copy()
    {
        $this->withoutVite();

        $category = PortfolioCategory::create([
            'name' => 'Published Category',
            'slug' => 'published-category',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Settings Visible Portfolio',
            'slug' => 'settings-visible-portfolio',
            'code' => 'SVP',
            'excerpt' => 'Portfolio item remains visible after page settings change.',
            'description' => 'Portfolio item remains visible after page settings change.',
            'technologies' => ['Laravel'],
            'status' => PortfolioItem::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'sort_order' => 1,
        ]);

        $this->get(route('portfolio.index'))
            ->assertOk()
            ->assertSee('PORTFOLIO JASAIBNU')
            ->assertSee('Solusi Digital yang Kami Bangun untuk Kebutuhan Bisnis')
            ->assertSee('Diskusikan kebutuhan website, aplikasi, SaaS, integrasi sistem, atau AI bersama JASAIBNU.')
            ->assertSee('Settings Visible Portfolio');

        $adminUser = User::create([
            'name' => 'Admin Portfolio Settings',
            'email' => 'admin-portfolio-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->get(route('admin.portfolio-page-settings.edit'))
            ->assertOk()
            ->assertSee('Portfolio Page Settings')
            ->assertSee('Portfolio Intro')
            ->assertSee(route('admin.portfolio-page-settings.update'), false);

        $this->actingAs($adminUser)
            ->put(route('admin.portfolio-page-settings.update'), [
                'eyebrow' => 'CUSTOM PORTFOLIO',
                'title' => 'Custom Portfolio Heading',
                'description' => 'Custom portfolio intro description.',
                'cta_eyebrow' => 'CUSTOM CTA',
                'cta_title' => 'Custom CTA Heading',
                'cta_description' => 'Custom CTA description.',
                'cta_primary_label' => 'Primary Custom',
                'cta_primary_url' => '/contact',
                'cta_secondary_label' => 'Secondary Custom',
                'cta_secondary_url' => 'https://example.com/services',
            ])
            ->assertRedirect(route('admin.portfolio-page-settings.edit'));

        $this->assertSame(1, PortfolioPageSetting::count());
        $this->assertDatabaseHas('portfolio_page_settings', [
            'eyebrow' => 'CUSTOM PORTFOLIO',
            'title' => 'Custom Portfolio Heading',
            'cta_primary_url' => '/contact',
        ]);

        $this->get(route('portfolio.index'))
            ->assertOk()
            ->assertSee('CUSTOM PORTFOLIO')
            ->assertSee('Custom Portfolio Heading')
            ->assertSee('Custom portfolio intro description.')
            ->assertSee('CUSTOM CTA')
            ->assertSee('Custom CTA Heading')
            ->assertSee('Custom CTA description.')
            ->assertSee('href="' . url('/contact') . '"', false)
            ->assertSee('href="https://example.com/services"', false)
            ->assertSee('Primary Custom')
            ->assertSee('Secondary Custom')
            ->assertSee('Settings Visible Portfolio');

        $this->actingAs($adminUser)
            ->get(route('admin.portfolio.create'))
            ->assertOk()
            ->assertSee('Create Portfolio');
    }

    public function test_admin_portfolio_uploads_featured_image()
    {
        Storage::fake('public');

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin-upload@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->post(route('admin.portfolio.store'), [
                'title' => 'Uploaded Portfolio Image',
                'slug' => 'uploaded-portfolio-image',
                'excerpt' => 'Portfolio with uploaded image.',
                'status' => PortfolioItem::STATUS_PUBLISHED,
                'featured_image' => UploadedFile::fake()->image('portfolio.jpg', 800, 500),
            ])
            ->assertRedirect(route('admin.portfolio.index'));

        $item = PortfolioItem::where('slug', 'uploaded-portfolio-image')->firstOrFail();

        $this->assertNotNull($item->published_at);
        $this->assertStringStartsWith('portfolio/', $item->featured_image);
        Storage::disk('public')->assertExists($item->featured_image);
    }

    public function test_admin_portfolio_categories_can_be_managed()
    {
        $adminUser = new User([
            'name' => 'Admin User',
            'email' => 'admin-category@example.com',
            'is_admin' => true,
        ]);
        $adminUser->id = 24;

        $this->actingAs($adminUser)
            ->post(route('admin.portfolio-categories.store'), [
                'name' => 'Managed Portfolio Category',
                'slug' => '',
                'is_active' => '1',
                'sort_order' => 12,
            ])
            ->assertRedirect(route('admin.portfolio-categories.index'));

        $this->assertDatabaseHas('portfolio_categories', [
            'name' => 'Managed Portfolio Category',
            'slug' => 'managed-portfolio-category',
            'is_active' => true,
        ]);
    }

    public function test_admin_contact_inbox_requires_admin_and_lists_messages()
    {
        $message = ContactMessage::create([
            'name' => 'Inbox Sender',
            'email' => 'sender@example.com',
            'company' => 'Inbox Company',
            'service' => 'AI Integration',
            'message' => 'Please help us integrate AI.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        $normalUser = User::create([
            'name' => 'Normal Contact User',
            'email' => 'normal-contact@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Contact User',
            'email' => 'admin-contact@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.contact.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.contact.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.contact.index'))
            ->assertOk()
            ->assertSee('Contact Inbox')
            ->assertSee('Inbox Sender')
            ->assertSee('UNREAD')
            ->assertSee((string) ContactMessage::unread()->count());

        $this->assertTrue($message->fresh()->isUnread());
    }

    public function test_admin_contact_detail_marks_unread_message_as_read()
    {
        $adminUser = User::create([
            'name' => 'Admin Detail User',
            'email' => 'admin-detail@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $message = ContactMessage::create([
            'name' => 'Detail Sender',
            'email' => 'detail@example.com',
            'phone' => '08123456789',
            'company' => 'Detail Company',
            'service' => 'System Integration',
            'message' => 'This message should become read.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        $this->actingAs($adminUser)
            ->get(route('admin.contact.show', $message))
            ->assertOk()
            ->assertSee('Detail Sender')
            ->assertSee('detail@example.com')
            ->assertSee('This message should become read.')
            ->assertSee('READ');

        $message->refresh();

        $this->assertSame(ContactMessage::STATUS_READ, $message->status);
        $this->assertNotNull($message->read_at);
    }

    public function test_admin_contact_messages_can_be_marked_read_unread_and_deleted()
    {
        $adminUser = User::create([
            'name' => 'Admin Actions User',
            'email' => 'admin-actions@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $message = ContactMessage::create([
            'name' => 'Action Sender',
            'email' => 'action@example.com',
            'service' => 'Website Development',
            'message' => 'Action test message.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        $this->actingAs($adminUser)
            ->patch(route('admin.contact.read', $message))
            ->assertRedirect();

        $this->assertSame(ContactMessage::STATUS_READ, $message->fresh()->status);
        $this->assertNotNull($message->fresh()->read_at);

        $this->actingAs($adminUser)
            ->patch(route('admin.contact.unread', $message))
            ->assertRedirect();

        $this->assertSame(ContactMessage::STATUS_UNREAD, $message->fresh()->status);
        $this->assertNull($message->fresh()->read_at);

        $this->actingAs($adminUser)
            ->delete(route('admin.contact.destroy', $message))
            ->assertRedirect(route('admin.contact.index'));

        $this->assertDatabaseMissing('contact_messages', [
            'id' => $message->id,
        ]);
    }

    public function test_admin_contact_search_filter_and_dashboard_count_use_database()
    {
        $adminUser = User::create([
            'name' => 'Admin Search User',
            'email' => 'admin-search@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        ContactMessage::create([
            'name' => 'Unread Match',
            'email' => 'match@example.com',
            'service' => 'SaaS Development',
            'message' => 'Need a searchable SaaS platform.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        ContactMessage::create([
            'name' => 'Read Hidden',
            'email' => 'hidden@example.com',
            'service' => 'SEO Services',
            'message' => 'Different content.',
            'status' => ContactMessage::STATUS_READ,
            'read_at' => now(),
        ]);

        $this->actingAs($adminUser)
            ->get(route('admin.contact.index', ['search' => 'searchable', 'status' => 'unread']))
            ->assertOk()
            ->assertSee('Unread Match')
            ->assertDontSee('Read Hidden');

        $this->actingAs($adminUser)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Contact Inbox')
            ->assertSee((string) ContactMessage::count());
    }

    public function test_admin_site_settings_requires_admin_and_initializes_singleton()
    {
        SiteSetting::query()->delete();

        $normalUser = User::create([
            'name' => 'Normal Settings User',
            'email' => 'normal-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Settings User',
            'email' => 'admin-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.site-settings.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.site-settings.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.site-settings.edit'))
            ->assertOk()
            ->assertSee('Site Settings')
            ->assertSee('PT JASA IBNU DEVELOPMENT');

        $this->assertSame(1, SiteSetting::count());

        $this->actingAs($adminUser)
            ->get(route('admin.site-settings.edit'))
            ->assertOk();

        $this->assertSame(1, SiteSetting::count());
    }

    public function test_admin_can_update_site_settings_without_creating_duplicates()
    {
        $adminUser = User::create([
            'name' => 'Admin Update Settings',
            'email' => 'admin-update-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        SiteSetting::current();

        $response = $this->actingAs($adminUser)
            ->from(route('admin.site-settings.edit'))
            ->put(route('admin.site-settings.update'), [
                'company_name' => 'JASAIBNU TEST',
                'company_legal_name' => 'PT JASA IBNU TEST',
                'email' => 'settings@example.com',
                'phone' => 'Konsultasi via WhatsApp',
                'whatsapp_number' => '+62 812-3456-7890',
                'whatsapp_url' => 'https://wa.me/6281234567890',
                'address' => 'Jakarta, Indonesia',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'google_maps_embed_url' => 'https://www.google.com/maps?q=Jakarta%2C%20Indonesia&output=embed',
                'google_maps_external_url' => '',
                'home_consultation_eyebrow' => 'Audit Gratis',
                'home_consultation_title' => 'Butuh sistem yang lebih rapi?',
                'home_consultation_feature_one' => 'Cek proses bisnis',
                'home_consultation_feature_two' => 'Rancang roadmap teknis',
                'home_consultation_description' => 'Kami bantu membaca kebutuhan sistem dan prioritas pengembangan.',
                'home_consultation_contact_label' => 'Mulai audit kebutuhan',
                'home_consultation_card_title' => 'Jadwalkan Konsultasi',
                'home_consultation_card_description' => 'Ceritakan kendala bisnis dan target digital Anda.',
                'home_consultation_button_text' => 'Bicara Dengan Tim',
                'x_url' => '#',
                'facebook_url' => 'https://facebook.com/jasaibnu',
                'linkedin_url' => 'https://linkedin.com/company/jasaibnu',
                'instagram_url' => 'https://instagram.com/jasaibnu',
                'footer_description' => 'Database-backed footer description.',
                'copyright_text' => 'All Rights Reserved.',
            ]);

        $response
            ->assertRedirect(route('admin.site-settings.edit'))
            ->assertSessionHas('status');

        $this->assertSame(1, SiteSetting::count());
        $this->assertDatabaseHas('site_settings', [
            'company_name' => 'JASAIBNU TEST',
            'email' => 'settings@example.com',
            'whatsapp_number' => '+6281234567890',
            'whatsapp_url' => 'https://wa.me/6281234567890',
            'facebook_url' => 'https://facebook.com/jasaibnu',
            'home_consultation_title' => 'Butuh sistem yang lebih rapi?',
            'home_consultation_button_text' => 'Bicara Dengan Tim',
        ]);

        $this->assertSame('https://wa.me/6281234567890', SiteSetting::current()->whatsappContactUrl('Halo JASAIBNU'));
    }

    public function test_site_settings_validation_rejects_invalid_email_and_urls()
    {
        $adminUser = User::create([
            'name' => 'Admin Invalid Settings',
            'email' => 'admin-invalid-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->from(route('admin.site-settings.edit'))
            ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                'email' => 'invalid-email',
                'whatsapp_number' => 'hello whatsapp',
                'whatsapp_url' => 'https://example.com/contact',
                'google_maps_embed_url' => 'not-a-url',
                'facebook_url' => 'not-a-url',
            ]))
            ->assertRedirect(route('admin.site-settings.edit'))
            ->assertSessionHasErrors(['email', 'whatsapp_number', 'whatsapp_url', 'google_maps_embed_url', 'facebook_url']);
    }

    public function test_site_settings_extracts_google_maps_embed_url_from_iframe()
    {
        $adminUser = User::create([
            'name' => 'Admin Google Maps Iframe',
            'email' => 'admin-google-maps-iframe@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $embedUrl = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.2610645412497!2d106.1493419!3d-6.0954957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e418be2cdfca929%3A0xcedfa059b9a8bfbb!2sPT%20Jasa%20Ibnu%20Development!5e0!3m2!1sen!2sid!4v1786746438926!5m2!1sen!2sid';

        $this->actingAs($adminUser)
            ->from(route('admin.site-settings.edit'))
            ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                'google_maps_embed_url' => '<iframe src="' . $embedUrl . '" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
            ]))
            ->assertRedirect(route('admin.site-settings.edit'))
            ->assertSessionHas('status');

        $this->assertSame($embedUrl, SiteSetting::current()->google_maps_embed_url);
    }

    public function test_site_settings_accepts_only_whatsapp_url_domains()
    {
        $adminUser = User::create([
            'name' => 'Admin WhatsApp URLs',
            'email' => 'admin-whatsapp-urls@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $validUrls = [
            'https://wa.link/s5wh92',
            'https://wa.me/6281234567890',
            'https://api.whatsapp.com/send?phone=6281234567890',
            'https://whatsapp.com/channel/example',
        ];

        foreach ($validUrls as $index => $url) {
            $this->actingAs($adminUser)
                ->from(route('admin.site-settings.edit'))
                ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                    'email' => 'settings-valid-whatsapp-' . $index . '@example.com',
                    'whatsapp_url' => $url,
                ]))
                ->assertRedirect(route('admin.site-settings.edit'))
                ->assertSessionDoesntHaveErrors(['whatsapp_url']);

            $this->assertSame($url, SiteSetting::current()->whatsapp_url);
            $this->assertSame($url, SiteSetting::current()->whatsappContactUrl('Halo JASAIBNU'));
        }

        foreach ([
            'https://example.com/contact',
            'https://wa.link.example.com/s5wh92',
        ] as $url) {
            $this->actingAs($adminUser)
                ->from(route('admin.site-settings.edit'))
                ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                    'email' => 'settings-invalid-whatsapp@example.com',
                    'whatsapp_url' => $url,
                ]))
                ->assertRedirect(route('admin.site-settings.edit'))
                ->assertSessionHasErrors(['whatsapp_url']);
        }
    }

    public function test_public_pages_render_database_backed_global_settings_and_map()
    {
        $settings = SiteSetting::current();
        $settings->update([
            'company_name' => 'JASAIBNU DB',
            'company_legal_name' => 'PT JASA IBNU DB',
            'email' => 'db-contact@example.com',
            'phone' => 'Konsultasi via WhatsApp',
            'whatsapp_number' => '6281234567890',
            'whatsapp_url' => null,
            'address' => 'Jakarta, Indonesia',
            'google_maps_embed_url' => 'https://www.google.com/maps?q=Jakarta%2C%20Indonesia&output=embed',
            'home_consultation_eyebrow' => 'Audit Digital',
            'home_consultation_title' => 'Bangun sistem yang lebih sesuai',
            'home_consultation_feature_one' => 'Pemetaan proses',
            'home_consultation_feature_two' => 'Prioritas teknis',
            'home_consultation_description' => 'Teks konsultasi dari database.',
            'home_consultation_contact_label' => 'Mulai dari email',
            'home_consultation_card_title' => 'Konsultasi Implementasi',
            'home_consultation_card_description' => 'Teks kartu konsultasi dari database.',
            'home_consultation_button_text' => 'Mulai Diskusi',
            'footer_description' => 'Footer from database settings.',
            'copyright_text' => 'All Rights Reserved.',
        ]);

        $pages = [
            rtrim(route('home'), '/'),
            route('services.index'),
            route('solutions.index'),
            route('portfolio.index'),
            route('insights.index'),
            route('about'),
            route('contact'),
        ];

        foreach ($pages as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('JASAIBNU DB')
                ->assertSee('PT JASA IBNU DB')
                ->assertSee('db-contact@example.com')
                ->assertSee('Footer from database settings.')
                ->assertSee('class="floating-whatsapp"', false)
                ->assertSee('aria-label="Konsultasi via WhatsApp"', false)
                ->assertSee('https://wa.me/6281234567890?text=Halo%20JASAIBNU%2C%20saya%20ingin%20konsultasi%20mengenai%20kebutuhan%20digital%20bisnis%20saya.', false);
        }

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Audit Digital')
            ->assertSee('Bangun sistem yang lebih sesuai')
            ->assertSee('Pemetaan proses')
            ->assertSee('Prioritas teknis')
            ->assertSee('Teks konsultasi dari database.')
            ->assertSee('Mulai dari email')
            ->assertSee('Konsultasi Implementasi')
            ->assertSee('Teks kartu konsultasi dari database.')
            ->assertSee('Mulai Diskusi');

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('https://www.google.com/maps?q=Jakarta%2C%20Indonesia&amp;output=embed', false);

        $this->get(route('admin.login'))
            ->assertOk()
            ->assertDontSee('class="floating-whatsapp"', false);
    }

    public function test_missing_optional_site_settings_do_not_crash_frontend_or_existing_cms()
    {
        SiteSetting::current()->update([
            'phone' => null,
            'whatsapp_number' => null,
            'whatsapp_url' => null,
            'address' => null,
            'google_maps_external_url' => null,
            'x_url' => null,
            'facebook_url' => null,
            'linkedin_url' => null,
            'instagram_url' => null,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Existing CMS',
            'email' => 'admin-existing-cms@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('home'))->assertOk();
        $this->get(route('contact'))->assertOk();

        $this->actingAs($adminUser)->get(route('admin.insights.index'))->assertOk();
        $this->actingAs($adminUser)->get(route('admin.portfolio.index'))->assertOk();
        $this->actingAs($adminUser)->get(route('admin.contact.index'))->assertOk();
        $this->actingAs($adminUser)->get(route('admin.about.edit'))->assertOk();
    }

    public function test_admin_about_cms_requires_admin_and_updates_content_and_image()
    {
        Storage::fake('public');

        \App\Models\AboutPage::query()->delete();

        $normalUser = User::create([
            'name' => 'Normal About User',
            'email' => 'normal-about@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin About User',
            'email' => 'admin-about@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.about.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.about.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.about.edit'))
            ->assertOk()
            ->assertSee('About Page CMS')
            ->assertSee('Partner Teknologi untuk Pertumbuhan Bisnis Digital');

        $this->assertSame(1, \App\Models\AboutPage::count());

        $payload = \App\Models\AboutPage::defaults();
        $payload['hero_title'] = 'Updated About Title For Testing';
        $payload['homepage_about_title'] = 'Homepage About CMS Title For Testing';
        $payload['homepage_checklist_1'] = 'Editable homepage checklist one';
        $payload['homepage_cta_main_text'] = 'Editable homepage CTA';
        $payload['homepage_button_label'] = 'Editable homepage button';
        $payload['visual_image'] = UploadedFile::fake()->image('about_updated.jpg', 900, 600);

        $this->actingAs($adminUser)
            ->from(route('admin.about.edit'))
            ->put(route('admin.about.update'), $payload)
            ->assertRedirect(route('admin.about.edit'))
            ->assertSessionHas('status');

        $about = \App\Models\AboutPage::current();
        $this->assertSame('Updated About Title For Testing', $about->hero_title);
        $this->assertSame('Homepage About CMS Title For Testing', $about->homepage_about_title);
        $this->assertSame('Editable homepage checklist one', $about->homepage_checklist_1);
        $this->assertSame('Editable homepage CTA', $about->homepage_cta_main_text);
        $this->assertSame('Editable homepage button', $about->homepage_button_label);
        $this->assertNotNull($about->visual_image);
        Storage::disk('public')->assertExists($about->visual_image);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Updated About Title For Testing');

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Homepage About CMS Title For Testing')
            ->assertSee('Editable homepage checklist one')
            ->assertSee('Editable homepage CTA')
            ->assertSee('Editable homepage button');
    }

    public function test_admin_about_validation_rejects_empty_required_fields()
    {
        $adminUser = User::create([
            'name' => 'Admin About Validation',
            'email' => 'admin-about-val@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $payload = \App\Models\AboutPage::defaults();
        $payload['hero_title'] = '';

        $this->actingAs($adminUser)
            ->from(route('admin.about.edit'))
            ->put(route('admin.about.update'), $payload)
            ->assertRedirect(route('admin.about.edit'))
            ->assertSessionHasErrors(['hero_title']);
    }

    public function test_admin_services_cms_requires_admin_crud_and_sorting()
    {
        $normalUser = User::create([
            'name' => 'Normal Services User',
            'email' => 'normal-services@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Services User',
            'email' => 'admin-services@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.services.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.services.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.services.index'))
            ->assertOk()
            ->assertSee('Services')
            ->assertSee('Website Development');

        $this->actingAs($adminUser)
            ->post(route('admin.services.store'), [
                'title' => 'Custom Cloud Service',
                'slug' => 'custom-cloud-service',
                'icon' => 'CS',
                'description' => 'Custom cloud infrastructure management for enterprise.',
                'is_active' => '1',
                'sort_order' => 9,
            ])
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'slug' => 'custom-cloud-service',
            'icon' => 'CS',
            'is_active' => true,
            'sort_order' => 9,
        ]);

        $service = \App\Models\Service::where('slug', 'custom-cloud-service')->firstOrFail();

        $this->actingAs($adminUser)
            ->put(route('admin.services.update', $service), [
                'title' => 'Updated Cloud Service',
                'slug' => 'updated-cloud-service',
                'icon' => 'CS',
                'description' => 'Updated description for cloud service.',
                'is_active' => '0',
                'sort_order' => 10,
            ])
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'slug' => 'updated-cloud-service',
            'is_active' => false,
            'sort_order' => 10,
        ]);

        // Inactive service should not be visible publicly
        $this->get(route('services.index'))
            ->assertOk()
            ->assertDontSee('Updated Cloud Service');

        $this->actingAs($adminUser)
            ->delete(route('admin.services.destroy', $service))
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_admin_service_technologies_can_upload_logos_for_services_page()
    {
        Storage::fake('public');

        $normalUser = User::create([
            'name' => 'Normal Technology User',
            'email' => 'normal-technology@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Technology User',
            'email' => 'admin-technology@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.service-technologies.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.service-technologies.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.service-technologies.index'))
            ->assertOk()
            ->assertSee('Service Technologies');

        $this->actingAs($adminUser)
            ->post(route('admin.service-technologies.store'), [
                'name' => 'Laravel Logo Test',
                'mark' => 'LV',
                'logo_path' => UploadedFile::fake()->image('laravel-logo.png', 160, 160),
                'is_active' => '1',
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.service-technologies.index'));

        $technology = \App\Models\ServiceTechnology::where('name', 'Laravel Logo Test')->firstOrFail();

        $this->assertNotNull($technology->logo_path);
        Storage::disk('public')->assertExists($technology->logo_path);

        $this->get(route('services.index'))
            ->assertOk()
            ->assertSee('Laravel Logo Test')
            ->assertSee(asset('storage/' . $technology->logo_path), false);

        $this->actingAs($adminUser)
            ->put(route('admin.service-technologies.update', $technology), [
                'name' => 'Laravel Hidden Logo Test',
                'mark' => 'LH',
                'is_active' => '0',
                'sort_order' => 2,
            ])
            ->assertRedirect(route('admin.service-technologies.index'));

        $this->get(route('services.index'))
            ->assertOk()
            ->assertDontSee('Laravel Hidden Logo Test');

        $this->actingAs($adminUser)
            ->delete(route('admin.service-technologies.destroy', $technology))
            ->assertRedirect(route('admin.service-technologies.index'));

        $this->assertDatabaseMissing('service_technologies', [
            'id' => $technology->id,
        ]);
    }

    public function test_admin_solutions_cms_requires_admin_crud_and_sorting()
    {
        $normalUser = User::create([
            'name' => 'Normal Solutions User',
            'email' => 'normal-solutions@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Solutions User',
            'email' => 'admin-solutions@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.solutions.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.solutions.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.solutions.index'))
            ->assertOk()
            ->assertSee('Solutions')
            ->assertSee('Business Process Automation');

        $this->actingAs($adminUser)
            ->post(route('admin.solutions.store'), [
                'title' => 'Custom Workflow Solution',
                'slug' => 'custom-workflow-solution',
                'icon' => 'CW',
                'description' => 'Custom workflow orchestration for business units.',
                'is_active' => '1',
                'sort_order' => 8,
            ])
            ->assertRedirect(route('admin.solutions.index'));

        $this->assertDatabaseHas('solutions', [
            'slug' => 'custom-workflow-solution',
            'icon' => 'CW',
            'is_active' => true,
            'sort_order' => 8,
        ]);

        $solution = \App\Models\Solution::where('slug', 'custom-workflow-solution')->firstOrFail();

        $this->actingAs($adminUser)
            ->put(route('admin.solutions.update', $solution), [
                'title' => 'Updated Workflow Solution',
                'slug' => 'updated-workflow-solution',
                'icon' => 'CW',
                'description' => 'Updated description for workflow solution.',
                'is_active' => '0',
                'sort_order' => 11,
            ])
            ->assertRedirect(route('admin.solutions.index'));

        $this->assertDatabaseHas('solutions', [
            'id' => $solution->id,
            'slug' => 'updated-workflow-solution',
            'is_active' => false,
            'sort_order' => 11,
        ]);

        // Inactive solution should not be visible publicly
        $this->get(route('solutions.index'))
            ->assertOk()
            ->assertDontSee('Updated Workflow Solution');

        $this->actingAs($adminUser)
            ->delete(route('admin.solutions.destroy', $solution))
            ->assertRedirect(route('admin.solutions.index'));

        $this->assertDatabaseMissing('solutions', [
            'id' => $solution->id,
        ]);
    }

    public function test_insight_focus_keyword_persistence_and_public_seo_metadata()
    {
        $this->withoutVite();

        $category = InsightCategory::create([
            'name' => 'SEO Insights',
            'slug' => 'seo-insights',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $adminUser = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->post(route('admin.insights.store'), [
                'title' => 'Panduan Jasa Pembuatan Website Perusahaan Profesional',
                'slug' => 'panduan-jasa-pembuatan-website-perusahaan',
                'focus_keyword' => 'jasa pembuatan website perusahaan',
                'insight_category_id' => $category->id,
                'excerpt' => 'Pelajari cara memilih jasa pembuatan website perusahaan terbaik untuk bisnis Anda.',
                'content' => '## Pendahuluan\n\njasa pembuatan website perusahaan sangat penting untuk kredibilitas bisnis modern di era digital.',
                'status' => 'published',
                'seo_title' => 'Jasa Pembuatan Website Perusahaan Terbaik & Profesional',
                'seo_description' => 'Temukan layanan jasa pembuatan website perusahaan bergaransi, cepat, dan SEO ready.',
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.insights.index'));

        $this->assertDatabaseHas('insights', [
            'slug' => 'panduan-jasa-pembuatan-website-perusahaan',
            'focus_keyword' => 'jasa pembuatan website perusahaan',
            'seo_title' => 'Jasa Pembuatan Website Perusahaan Terbaik & Profesional',
        ]);

        $insight = Insight::where('slug', 'panduan-jasa-pembuatan-website-perusahaan')->firstOrFail();

        $response = $this->get(route('insights.show', $insight->slug));
        $response->assertOk();
        $response->assertSee($insight->title);
    }

    public function test_technical_seo_endpoints_and_metadata()
    {
        $this->withoutVite();

        $category = InsightCategory::firstOrCreate(
            ['slug' => 'seo-technical-test'],
            ['name' => 'SEO Technical Test', 'is_active' => true, 'sort_order' => 99]
        );

        $publishedInsight = Insight::create([
            'title' => 'Published Sitemap Insight',
            'slug' => 'published-sitemap-insight',
            'insight_category_id' => $category->id,
            'excerpt' => 'Published insight should appear in sitemap.',
            'content' => 'Published content.',
            'status' => Insight::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'sort_order' => 1,
        ]);

        Insight::create([
            'title' => 'Draft Sitemap Insight',
            'slug' => 'draft-sitemap-insight',
            'insight_category_id' => $category->id,
            'excerpt' => 'Draft insight should not appear in sitemap.',
            'content' => 'Draft content.',
            'status' => Insight::STATUS_DRAFT,
            'published_at' => null,
            'sort_order' => 2,
        ]);

        Insight::create([
            'title' => 'Future Sitemap Insight',
            'slug' => 'future-sitemap-insight',
            'insight_category_id' => $category->id,
            'excerpt' => 'Future insight should not appear in sitemap.',
            'content' => 'Future content.',
            'status' => Insight::STATUS_PUBLISHED,
            'published_at' => now()->addDay(),
            'sort_order' => 3,
        ]);

        $responseRobots = $this->get('/robots.txt');
        $responseRobots->assertOk();
        $responseRobots->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $responseRobots->assertSee("User-agent: *\nDisallow: /", false);
        $responseRobots->assertDontSee('Sitemap:', false);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('href="#"', false);

        $responseSitemap = $this->get('/sitemap.xml');
        $responseSitemap->assertOk();
        $responseSitemap->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $responseSitemap->assertSee('<urlset', false);

        $sitemapXml = simplexml_load_string($responseSitemap->getContent());
        $this->assertNotFalse($sitemapXml, 'Sitemap must be valid XML.');
        $sitemapXml->registerXPathNamespace('sitemap', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $sitemapUrls = collect($sitemapXml->xpath('//sitemap:url') ?: [])
            ->map(fn ($url) => (string) $url->loc)
            ->all();

        $this->assertCount(count(array_unique($sitemapUrls)), $sitemapUrls, 'Sitemap must not contain duplicate loc entries.');
        $this->assertNotEmpty($sitemapUrls, 'Sitemap must contain public URLs.');

        $sitemapPaths = collect($sitemapUrls)
            ->map(function ($url) {
                $path = parse_url($url, PHP_URL_PATH) ?: '/';
                $path = $path === '/' ? '/' : rtrim($path, '/');

                return $path === '' ? '/' : $path;
            })
            ->all();

        $homePath = parse_url($sitemapUrls[0], PHP_URL_PATH);
        $this->assertTrue($homePath === null || $homePath === false || $homePath === '' || $homePath === '/');

        foreach ([
            '/jasa-pembuatan-website',
            '/jasa-pembuatan-website-serang',
            '/jasa-pembuatan-website-banten',
            '/jasa-pembuatan-website-serang-murah',
            '/jasa-website-umkm-serang',
            '/jasa-seo-serang',
            '/services',
            '/solutions',
            '/portfolio',
            '/insights',
            '/about',
            '/contact',
        ] as $publicPath) {
            $this->assertContains($publicPath, $sitemapPaths);
        }

        $this->assertContains('/insights/' . $publishedInsight->slug, $sitemapPaths);
        $this->assertNotContains('/insights/draft-sitemap-insight', $sitemapPaths);
        $this->assertNotContains('/insights/future-sitemap-insight', $sitemapPaths);
        $this->assertNotContains('/admin', $sitemapPaths);
        $this->assertNotContains('/weblogin', $sitemapPaths);

        foreach ($sitemapUrls as $sitemapUrl) {
            $this->assertStringNotContainsString('?', $sitemapUrl);
        }

        $adminUser = User::factory()->create(['is_admin' => true]);
        $this->actingAs($adminUser)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        auth()->logout();
        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        foreach ([
            rtrim(route('home'), '/') => rtrim(route('home'), '/'),
            route('services.index') => route('services.index'),
            route('solutions.index') => route('solutions.index'),
            route('portfolio.index') => route('portfolio.index'),
            route('insights.index') => route('insights.index'),
            route('about') => route('about'),
            route('contact') => route('contact'),
            route('insights.show', $publishedInsight->slug) => route('insights.show', $publishedInsight->slug),
        ] as $url => $canonicalUrl) {
            $page = $this->get($url . '?utm_source=test');
            $page->assertOk();
            preg_match_all('/<link rel="canonical" href="([^"]+)">/', $page->getContent(), $canonicalMatches);
            $this->assertSame([$canonicalUrl], $canonicalMatches[1]);
        }

        $this->get('/missing-seo-audit-page')->assertNotFound();

        $responseHome = $this->get('/');
        $responseHome->assertOk();
        $responseHome->assertSee('<link rel="canonical"', false);
        $responseHome->assertSee('schema.org', false);

        preg_match_all('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $responseHome->getContent(), $jsonLdMatches);
        $schemas = collect($jsonLdMatches[1])->map(function ($json) {
            $decoded = json_decode($json, true);
            $this->assertIsArray($decoded, 'Homepage JSON-LD must be valid JSON.');

            return $decoded;
        });

        $homeUrl = rtrim(route('home'), '/');
        $organizationSchema = $schemas->firstWhere('@type', 'Organization');
        $professionalServiceSchema = $schemas->firstWhere('@type', 'ProfessionalService');
        $websiteSchema = $schemas->firstWhere('@type', 'WebSite');

        $this->assertNotNull($organizationSchema);
        $this->assertNotNull($professionalServiceSchema);
        $this->assertNotNull($websiteSchema);
        $this->assertSame($homeUrl . '#organization', $organizationSchema['@id'] ?? null);
        $this->assertSame($homeUrl . '#professional-service', $professionalServiceSchema['@id'] ?? null);
        $this->assertContains('Jasa pembuatan website', $professionalServiceSchema['serviceType'] ?? []);
        $this->assertContains('SEO services', $professionalServiceSchema['serviceType'] ?? []);
        $this->assertSame($homeUrl . '#website', $websiteSchema['@id'] ?? null);
        $this->assertSame(['@id' => $homeUrl . '#organization'], $websiteSchema['publisher'] ?? null);
    }
}
