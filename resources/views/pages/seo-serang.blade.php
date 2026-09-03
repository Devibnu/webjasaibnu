@extends('layouts.app')

@php
    $seoSiteSettings = \App\Models\SiteSetting::current();
    $seoTitle = 'Jasa SEO Serang untuk Optimasi Website | JASAIBNU';
    $seoDescription = 'Jasa SEO Serang untuk membantu website bisnis lebih mudah dipahami Google melalui audit teknis, optimasi on-page, struktur konten, dan monitoring.';
    $canonicalUrl = 'https://jasaibnu.com/jasa-seo-serang';
    $serviceDescription = 'JASAIBNU membantu bisnis di Serang mengoptimalkan website untuk pencarian organik melalui audit teknis, optimasi on-page, penataan struktur konten, serta peninjauan crawl, indexing, dan performa.';
    $whatsappUrl = $seoSiteSettings->whatsappContactUrl('Halo JASAIBNU, saya ingin berkonsultasi tentang optimasi SEO website bisnis saya.') ?: route('contact');
    $whatsappExternal = str_starts_with($whatsappUrl, 'http://') || str_starts_with($whatsappUrl, 'https://');
    $faqs = [
        [
            'question' => 'Apa saja yang termasuk dalam jasa SEO?',
            'answer' => 'Ruang lingkup dapat mencakup audit teknis, optimasi title dan meta description, struktur heading, canonical, sitemap, schema, internal link, struktur konten, serta peninjauan crawl, indexing, responsivitas, dan performa. Prioritas akhirnya disesuaikan dengan kondisi website.',
        ],
        [
            'question' => 'Apakah website yang sudah ada bisa dioptimasi?',
            'answer' => 'Bisa. Website yang sudah berjalan dapat ditinjau untuk menemukan hambatan teknis, kekurangan on-page, struktur konten yang belum jelas, dan prioritas perbaikan. Kemungkinan implementasinya tetap bergantung pada teknologi serta akses pengelolaan website.',
        ],
        [
            'question' => 'Berapa lama SEO mulai menunjukkan hasil?',
            'answer' => 'SEO membutuhkan waktu dan tidak memiliki durasi hasil yang sama untuk setiap website. Perkembangannya dipengaruhi kondisi website, tingkat persaingan, kualitas dan relevansi konten, proses crawl dan indexing, serta konsistensi optimasi yang dilakukan.',
        ],
        [
            'question' => 'Apakah JASAIBNU menjamin ranking nomor 1?',
            'answer' => 'Tidak. Tidak ada penyedia SEO yang dapat menjamin ranking nomor 1 karena hasil pencarian ditentukan oleh banyak faktor dan sistem mesin pencari terus berubah. JASAIBNU berfokus pada perbaikan yang dapat dipertanggungjawabkan secara teknis dan on-page.',
        ],
        [
            'question' => 'Apakah layanan hanya untuk bisnis di Serang?',
            'answer' => 'Tidak. Halaman ini ditujukan khusus untuk kebutuhan bisnis di Serang, tetapi konsultasi dan optimasi website juga dapat dilakukan untuk bisnis di wilayah Banten maupun area lain sesuai ruang lingkup yang disepakati.',
        ],
        [
            'question' => 'Apakah pembuatan konten termasuk layanan SEO?',
            'answer' => 'Kebutuhan konten ditentukan saat konsultasi. Ruang lingkup dapat mencakup penataan struktur, arahan topik, atau optimasi konten yang tersedia. Penulisan dan produksi konten baru perlu disepakati secara terpisah dan tidak otomatis berarti layanan konten tanpa batas.',
        ],
    ];
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $canonicalUrl . '#service',
        'name' => 'Jasa SEO Serang',
        'url' => $canonicalUrl,
        'description' => $serviceDescription,
        'serviceType' => 'Optimasi SEO website',
        'provider' => ['@id' => 'https://jasaibnu.com#professional-service'],
        'areaServed' => ['@type' => 'City', 'name' => 'Serang'],
    ];
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        '@id' => $canonicalUrl . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://jasaibnu.com'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => 'https://jasaibnu.com/services'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Jasa SEO Serang', 'item' => $canonicalUrl],
        ],
    ];
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        '@id' => $canonicalUrl . '#faq',
        'mainEntity' => collect($faqs)->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
        ])->all(),
    ];
@endphp

@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('canonical', $canonicalUrl)
@section('robots', 'index,follow')
@section('og_type', 'website')
@section('body_class', 'startup2-home seo-serang-page')

@push('head')
    <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <style>
        .seo-serang-page {
            --seo-blue: #087cf0;
            --seo-blue-dark: #0757c9;
            --seo-navy: #0b2147;
            --seo-text: #4f6075;
            --seo-line: #dce9f5;
            --seo-light: #f4faff;
            background: #fff;
            color: var(--seo-navy);
            font-family: "Rubik", ui-sans-serif, system-ui, sans-serif;
        }

        .seo-serang-page .site-header {
            border-bottom-color: #e5edf5;
            background: rgba(255, 255, 255, .96);
            box-shadow: 0 3px 18px rgba(11, 33, 71, .05);
        }

        .seo-serang-page .site-header .header-inner {
            width: calc(100% - 96px);
            max-width: none;
            min-height: 96px;
        }
        .seo-serang-page .site-header .primary-nav {
            gap: 0;
            color: #33445b;
            font-size: 17px;
            font-weight: 600;
        }
        .seo-serang-page .site-header .primary-nav > a:not(.button) {
            position: relative;
            display: inline-flex;
            min-height: 96px;
            align-items: center;
            margin-left: 18px;
        }
        .seo-serang-page .site-header .primary-nav > a:not(.button)::after {
            position: absolute;
            right: 50%;
            bottom: -1px;
            left: 50%;
            height: 2px;
            border-radius: 999px;
            background: var(--seo-blue);
            content: "";
            transition: right .18s ease, left .18s ease;
        }
        .seo-serang-page .site-header .primary-nav a[aria-current="page"],
        .seo-serang-page .site-header .primary-nav a:not(.button):hover { color: var(--seo-blue); }
        .seo-serang-page .site-header .primary-nav > a[href$="/services"] { color: var(--seo-blue); }
        .seo-serang-page .site-header .primary-nav > a[href$="/services"]::after,
        .seo-serang-page .site-header .primary-nav > a:not(.button):hover::after { right: 0; left: 0; }
        .seo-serang-page .site-header .nav-cta {
            min-height: 40px;
            margin-left: 18px;
            padding: .48rem 1.05rem;
            border-radius: 2px;
            font-size: .96rem;
        }
        @if ($seoSiteSettings->logo_dark_path)
        .seo-serang-page .site-header .brand {
            width: 199px;
            min-height: 45px;
            background: url("{{ asset('storage/' . $seoSiteSettings->logo_dark_path) }}") left center / contain no-repeat;
        }
        .seo-serang-page .site-header .brand > img { opacity: 0; }
        @endif
        .seo-serang-page .site-header .brand-text strong { color: var(--seo-navy); }
        .seo-serang-page .site-header .brand-text span { color: #68788b; }
        .seo-serang-page .site-header .menu-toggle { border-color: #cad8e6; background: #fff; }
        .seo-serang-page .site-header .menu-toggle span { background: var(--seo-navy); }

        .seo-serang-page .startup-inner-shell .navbar { background: #fff !important; }
        .seo-serang-page .startup-inner-shell .ji-header-logo-public { visibility: hidden; opacity: 0; }
        .seo-serang-page .startup-inner-shell .ji-header-logo-dark { visibility: visible; opacity: 1; }
        .seo-serang-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link { color: #17253a !important; }
        .seo-serang-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link:hover,
        .seo-serang-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link.active { color: var(--seo-blue) !important; }

        .seo-serang-shell { width: min(100% - 40px, 1180px); margin-inline: auto; }
        .seo-serang-section { padding: 76px 0; }
        .seo-serang-eyebrow {
            display: inline-flex;
            margin: 0 0 12px;
            padding: 6px 10px;
            border-radius: 5px;
            background: #eaf6ff;
            color: #076ad3;
            font-size: .75rem;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .seo-serang-heading { max-width: 720px; margin: 0 auto 40px; text-align: center; }
        .seo-serang-heading h2 { margin: 0 0 10px; color: var(--seo-navy); font-size: clamp(1.8rem, 3vw, 2.45rem); line-height: 1.2; }
        .seo-serang-heading p:last-child { margin: 0; color: var(--seo-text); line-height: 1.7; }
        .seo-serang-button {
            display: inline-flex;
            min-height: 48px;
            align-items: center;
            justify-content: center;
            padding: .78rem 1.25rem;
            border: 1px solid var(--seo-blue);
            border-radius: 6px;
            background: var(--seo-blue);
            color: #fff;
            font-weight: 750;
            transition: transform .18s ease, background .18s ease;
        }
        .seo-serang-button:hover { background: var(--seo-blue-dark); color: #fff; transform: translateY(-1px); }
        .seo-serang-button.secondary { background: #fff; color: var(--seo-blue); }
        .seo-serang-button.secondary:hover { background: #edf7ff; color: var(--seo-blue-dark); }

        .seo-serang-hero { position: relative; overflow: hidden; padding: 72px 0 92px; background: linear-gradient(135deg, #fff 0%, #fff 54%, #eef8ff 100%); }
        .seo-serang-hero::before { content: ""; position: absolute; top: -180px; right: -100px; width: 520px; height: 520px; border-radius: 50%; background: rgba(8, 124, 240, .06); }
        .seo-serang-hero-grid { position: relative; display: grid; grid-template-columns: minmax(0, 1.05fr) minmax(420px, .95fr); gap: 62px; align-items: center; }
        .seo-serang-hero-copy { max-width: 650px; }
        .seo-serang-hero h1 { margin: 0 0 20px; color: var(--seo-navy); font-size: clamp(2.55rem, 4.2vw, 4rem); font-weight: 800; line-height: 1.08; letter-spacing: -.035em; }
        .seo-serang-hero-copy > p:not(.seo-serang-eyebrow) { margin: 0 0 28px; color: var(--seo-text); font-size: 1.05rem; line-height: 1.72; }
        .seo-serang-actions { display: flex; flex-wrap: wrap; gap: 12px; }
        .seo-serang-visual { position: relative; min-height: 390px; }
        .seo-serang-orbit { position: absolute; inset: 5% 2% 2% 6%; border: 1px solid rgba(8, 124, 240, .17); border-radius: 50%; background: radial-gradient(circle at 48% 44%, #fff 0 25%, #eef8ff 26% 54%, rgba(230, 245, 255, .45) 55%); }
        .seo-serang-document { position: absolute; top: 56px; left: 50%; width: 250px; min-height: 265px; padding: 28px; transform: translateX(-50%) rotate(-2deg); border: 1px solid #d8e8f6; border-radius: 18px; background: #fff; box-shadow: 0 24px 60px rgba(11, 67, 120, .13); }
        .seo-serang-search { display: grid; width: 66px; height: 66px; margin-bottom: 25px; place-items: center; border-radius: 50%; background: #e7f5ff; color: var(--seo-blue); font-size: 2rem; font-weight: 800; }
        .seo-serang-line { display: block; height: 9px; margin-top: 13px; border-radius: 99px; background: #e7eef6; }
        .seo-serang-line:first-of-type { width: 82%; background: #9ed3ff; }
        .seo-serang-line:nth-of-type(2) { width: 100%; }
        .seo-serang-line:nth-of-type(3) { width: 70%; }
        .seo-serang-check { position: absolute; display: grid; width: 54px; height: 54px; place-items: center; border: 5px solid #fff; border-radius: 50%; background: var(--seo-blue); box-shadow: 0 12px 28px rgba(8, 124, 240, .25); color: #fff; font-size: 1.25rem; font-weight: 900; }
        .seo-serang-check.one { top: 42px; right: 38px; }
        .seo-serang-check.two { bottom: 30px; left: 22px; background: #16a8c7; }
        .seo-serang-node { position: absolute; width: 13px; height: 13px; border-radius: 50%; background: #72c9ee; box-shadow: 0 0 0 8px rgba(114, 201, 238, .15); }
        .seo-serang-node.one { top: 45px; left: 40px; }
        .seo-serang-node.two { right: 28px; bottom: 76px; }

        .seo-serang-benefits { position: relative; z-index: 2; margin-top: -35px; }
        .seo-serang-benefit-grid { display: grid; grid-template-columns: repeat(4, 1fr); border: 1px solid var(--seo-line); border-radius: 10px; background: #fff; box-shadow: 0 16px 40px rgba(11, 33, 71, .08); }
        .seo-serang-benefit { display: flex; min-height: 72px; align-items: center; justify-content: center; gap: 10px; padding: 14px; color: var(--seo-navy); font-size: .92rem; font-weight: 750; text-align: center; }
        .seo-serang-benefit + .seo-serang-benefit { border-left: 1px solid var(--seo-line); }
        .seo-serang-benefit span { color: var(--seo-blue); font-size: 1.1rem; }

        .seo-serang-service-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        .seo-serang-service { padding: 30px; border: 1px solid var(--seo-line); border-radius: 10px; background: #fff; }
        .seo-serang-service-icon { display: grid; width: 48px; height: 48px; margin-bottom: 20px; place-items: center; border-radius: 9px; background: #eaf6ff; color: var(--seo-blue); font-size: 1.2rem; font-weight: 850; }
        .seo-serang-service h3 { margin: 0 0 10px; color: var(--seo-navy); font-size: 1.17rem; }
        .seo-serang-service p { margin: 0; color: var(--seo-text); line-height: 1.65; }
        .seo-serang-resource { margin: 28px 0 0; color: var(--seo-text); text-align: center; }
        .seo-serang-page main a:not(.seo-serang-button) { color: #076fda; font-weight: 700; text-decoration: underline; text-decoration-thickness: 1px; text-underline-offset: 3px; }

        .seo-serang-why { background: var(--seo-light); }
        .seo-serang-why-grid { display: grid; grid-template-columns: minmax(0, .92fr) minmax(0, 1.08fr); gap: 64px; align-items: center; }
        .seo-serang-why-copy h2 { margin: 0 0 16px; font-size: clamp(1.8rem, 3vw, 2.45rem); line-height: 1.2; }
        .seo-serang-why-copy > p:not(.seo-serang-eyebrow) { margin: 0 0 18px; color: var(--seo-text); line-height: 1.72; }
        .seo-serang-why-points { display: grid; gap: 12px; }
        .seo-serang-why-point { padding: 20px 22px; border: 1px solid var(--seo-line); border-radius: 9px; background: #fff; }
        .seo-serang-why-point strong { display: block; margin-bottom: 6px; color: var(--seo-navy); }
        .seo-serang-why-point p { margin: 0; color: var(--seo-text); line-height: 1.6; }

        .seo-serang-process-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .seo-serang-step { padding: 28px; border-top: 3px solid var(--seo-blue); border-radius: 8px; background: #f8fbfe; }
        .seo-serang-step-number { display: inline-block; margin-bottom: 15px; color: var(--seo-blue); font-size: .8rem; font-weight: 850; letter-spacing: .08em; }
        .seo-serang-step h3 { margin: 0 0 10px; font-size: 1.12rem; }
        .seo-serang-step p { margin: 0; color: var(--seo-text); line-height: 1.65; }

        .seo-serang-faq { background: var(--seo-light); }
        .seo-serang-faq-list { max-width: 900px; margin: 0 auto; display: grid; gap: 10px; }
        .seo-serang-faq-item { border: 1px solid var(--seo-line); border-radius: 8px; background: #fff; overflow: hidden; }
        .seo-serang-faq-item summary { position: relative; padding: 18px 52px 18px 20px; color: var(--seo-navy); cursor: pointer; font-weight: 750; list-style: none; }
        .seo-serang-faq-item summary::-webkit-details-marker { display: none; }
        .seo-serang-faq-item summary::after { content: "+"; position: absolute; top: 50%; right: 20px; transform: translateY(-50%); color: var(--seo-blue); font-size: 1.35rem; }
        .seo-serang-faq-item[open] summary::after { content: "−"; }
        .seo-serang-faq-answer { padding: 0 20px 18px; color: var(--seo-text); line-height: 1.68; }
        .seo-serang-faq-answer p { margin: 0; }

        .seo-serang-final { padding: 64px 0 24px; }
        .seo-serang-final-box { display: flex; align-items: center; justify-content: space-between; gap: 32px; padding: 38px 44px; border-radius: 10px; background: linear-gradient(120deg, #063fae, #087cf0); color: #fff; }
        .seo-serang-final h2 { margin: 0 0 7px; color: #fff; font-size: clamp(1.6rem, 2.6vw, 2.2rem); }
        .seo-serang-final p { max-width: 730px; margin: 0; color: rgba(255,255,255,.86); line-height: 1.6; }
        .seo-serang-final .seo-serang-button { flex: 0 0 auto; border-color: #fff; background: #fff; color: #0765d0; }
        .seo-serang-page .jasaibnu-startup-footer { margin-top: 0 !important; }

        @media (max-width: 1024px) {
            .seo-serang-page .site-header .header-inner { width: calc(100% - 48px); }
            .seo-serang-page .site-header .primary-nav { font-size: 15px; }
            .seo-serang-page .site-header .primary-nav > a:not(.button),
            .seo-serang-page .site-header .nav-cta { margin-left: 12px; }
            .seo-serang-hero-grid { grid-template-columns: minmax(0, 1fr) minmax(350px, .8fr); gap: 32px; }
            .seo-serang-hero h1 { font-size: clamp(2.35rem, 5vw, 3.35rem); }
            .seo-serang-why-grid { gap: 38px; }
        }

        @media (max-width: 768px) {
            .seo-serang-page .site-header .header-inner { width: calc(100% - 36px); min-height: 64px; }
            .seo-serang-page .site-header .brand { width: min(210px, 58vw); min-height: 42px; }
            .seo-serang-page .site-header .primary-nav { border-top: 1px solid #dce7f0; background: #fff; color: #2f4057; }
            .seo-serang-page .site-header .primary-nav > a:not(.button) { min-height: 0; margin-left: 0; }
            .seo-serang-page .site-header .primary-nav > a:not(.button)::after { display: none; }
            .seo-serang-page .site-header .primary-nav a { border-bottom-color: #e3ebf3; font-size: .94rem; }
            .seo-serang-page .site-header .nav-cta { margin-left: 0; border-radius: 2px; }
            .seo-serang-page .site-header .menu-toggle { width: 44px; height: 44px; border-radius: 8px; background: #eef9ff; }
            .seo-serang-shell { width: min(100% - 40px, 680px); }
            .seo-serang-section { padding: 62px 0; }
            .seo-serang-hero { padding: 58px 0 76px; }
            .seo-serang-hero-grid, .seo-serang-why-grid { grid-template-columns: 1fr; }
            .seo-serang-hero-copy { max-width: 650px; }
            .seo-serang-visual { min-height: 330px; }
            .seo-serang-document { top: 38px; }
            .seo-serang-benefit-grid { grid-template-columns: repeat(2, 1fr); }
            .seo-serang-benefit:nth-child(3) { border-left: 0; }
            .seo-serang-benefit:nth-child(n+3) { border-top: 1px solid var(--seo-line); }
            .seo-serang-service-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .seo-serang-process-grid { grid-template-columns: 1fr; }
            .seo-serang-final-box { align-items: flex-start; flex-direction: column; }
        }

        @media (max-width: 575.98px) {
            .seo-serang-shell { width: min(100% - 40px, 430px); }
            .seo-serang-hero { padding: 48px 0 66px; }
            .seo-serang-hero h1 { font-size: clamp(2.15rem, 10vw, 2.55rem); }
            .seo-serang-hero-copy > p:not(.seo-serang-eyebrow) { font-size: .97rem; }
            .seo-serang-actions { flex-direction: column; }
            .seo-serang-button { width: 100%; }
            .seo-serang-visual { min-height: 285px; }
            .seo-serang-orbit { inset: 2% 0 2% 0; }
            .seo-serang-document { top: 31px; width: 210px; min-height: 220px; padding: 22px; }
            .seo-serang-search { width: 54px; height: 54px; margin-bottom: 18px; font-size: 1.6rem; }
            .seo-serang-check { width: 46px; height: 46px; }
            .seo-serang-benefit { min-height: 68px; padding: 12px 8px; font-size: .79rem; }
            .seo-serang-service-grid { grid-template-columns: 1fr; }
            .seo-serang-service { padding: 24px; }
            .seo-serang-why-grid { gap: 30px; }
            .seo-serang-final-box { padding: 30px 24px; }
        }
    </style>
@endpush

@section('content')
    <section class="seo-serang-hero" aria-labelledby="seo-serang-title">
        <div class="seo-serang-shell seo-serang-hero-grid">
            <div class="seo-serang-hero-copy">
                <p class="seo-serang-eyebrow">Optimasi SEO Website</p>
                <h1 id="seo-serang-title">Jasa SEO Serang untuk Meningkatkan Visibilitas Website Bisnis</h1>
                <p>{{ $serviceDescription }} Layanan ini berfokus pada peningkatan fondasi dan relevansi website yang sudah tersedia, bukan pembangunan website baru.</p>
                <div class="seo-serang-actions">
                    <a class="seo-serang-button" href="{{ $whatsappUrl }}" @if ($whatsappExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasi SEO via WhatsApp</a>
                    <a class="seo-serang-button secondary" href="#layanan-seo">Lihat Ruang Lingkup SEO</a>
                </div>
            </div>
            <div class="seo-serang-visual" aria-hidden="true">
                <div class="seo-serang-orbit"></div>
                <div class="seo-serang-document">
                    <div class="seo-serang-search">⌕</div>
                    <span class="seo-serang-line"></span><span class="seo-serang-line"></span><span class="seo-serang-line"></span>
                </div>
                <span class="seo-serang-check one">✓</span><span class="seo-serang-check two">↗</span>
                <span class="seo-serang-node one"></span><span class="seo-serang-node two"></span>
            </div>
        </div>
    </section>

    <div class="seo-serang-benefits" aria-label="Manfaat utama optimasi SEO">
        <div class="seo-serang-shell seo-serang-benefit-grid">
            @foreach (['Audit Teknis', 'Optimasi On-Page', 'Struktur Konten', 'Kesiapan Crawl & Indexing'] as $benefit)
                <div class="seo-serang-benefit"><span aria-hidden="true">✓</span>{{ $benefit }}</div>
            @endforeach
        </div>
    </div>

    <section class="seo-serang-section" id="layanan-seo" aria-labelledby="seo-services-title">
        <div class="seo-serang-shell">
            <div class="seo-serang-heading">
                <p class="seo-serang-eyebrow">Ruang Lingkup Layanan</p>
                <h2 id="seo-services-title">Optimasi SEO yang Terarah untuk Website Bisnis</h2>
                <p>Setiap website memiliki kondisi dan prioritas yang berbeda. Ruang lingkup optimasi disusun berdasarkan hasil peninjauan teknis, struktur halaman, dan kebutuhan pencarian bisnis.</p>
            </div>
            <div class="seo-serang-service-grid">
                <article class="seo-serang-service"><div class="seo-serang-service-icon" aria-hidden="true">&lt;/&gt;</div><h3>SEO Teknis</h3><p>Meninjau struktur website, canonical, sitemap, schema, responsivitas, performa, serta hambatan teknis yang dapat memengaruhi proses crawl dan indexing.</p></article>
                <article class="seo-serang-service"><div class="seo-serang-service-icon" aria-hidden="true">H✓</div><h3>Optimasi On-Page</h3><p>Menata title, meta description, heading, semantic HTML, dan relevansi isi halaman agar topik utama lebih jelas bagi pengguna dan mesin pencari.</p></article>
                <article class="seo-serang-service"><div class="seo-serang-service-icon" aria-hidden="true">⌘</div><h3>Struktur Konten &amp; Internal Link</h3><p>Menyusun hubungan antartopik, hierarki informasi, dan internal link agar halaman penting lebih mudah ditemukan serta dipahami dalam konteks yang tepat.</p></article>
                <article class="seo-serang-service"><div class="seo-serang-service-icon" aria-hidden="true">⌕</div><h3>Review Crawl, Indexing &amp; Performa</h3><p>Memeriksa kesiapan halaman untuk dirayapi dan diindeks, meninjau kesehatan implementasi, serta menentukan prioritas perbaikan berikutnya.</p></article>
            </div>
            <p class="seo-serang-resource">Untuk memahami dasar teknisnya lebih lanjut, baca <a href="{{ route('insights.show', 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun') }}">panduan fondasi SEO teknis</a>.</p>
        </div>
    </section>

    <section class="seo-serang-section seo-serang-why" aria-labelledby="seo-why-title">
        <div class="seo-serang-shell seo-serang-why-grid">
            <div class="seo-serang-why-copy">
                <p class="seo-serang-eyebrow">Setelah Website Tersedia</p>
                <h2 id="seo-why-title">Mengapa Website Bisnis Perlu Dioptimalkan untuk Pencarian?</h2>
                <p>Memiliki website dan mengoptimalkannya untuk pencarian merupakan dua tahap yang saling melengkapi. Setelah website tersedia, struktur teknis, relevansi halaman, dan hubungan antarkonten perlu ditinjau agar mesin pencari dapat memahami informasi bisnis dengan lebih baik.</p>
                <p>Belum memiliki website yang sesuai kebutuhan bisnis? Pelajari <a href="{{ route('website-development-serang') }}">jasa pembuatan website di Serang</a>.</p>
                <p>Untuk kebutuhan yang lebih luas, tersedia pula <a href="{{ route('website-development') }}">layanan pembuatan website profesional</a>.</p>
            </div>
            <div class="seo-serang-why-points">
                <div class="seo-serang-why-point"><strong>Topik Halaman Lebih Jelas</strong><p>Struktur heading, metadata, dan isi halaman membantu menjelaskan layanan serta kebutuhan pencarian yang dituju.</p></div>
                <div class="seo-serang-why-point"><strong>Halaman Penting Lebih Mudah Ditemukan</strong><p>Navigasi dan internal link yang tertata membantu pengguna maupun mesin pencari menjangkau halaman yang relevan.</p></div>
                <div class="seo-serang-why-point"><strong>Prioritas Optimasi Lebih Terarah</strong><p>Peninjauan teknis membantu menentukan perbaikan yang perlu didahulukan sesuai kondisi website dan tujuan bisnis.</p></div>
            </div>
        </div>
    </section>

    <section class="seo-serang-section" aria-labelledby="seo-process-title">
        <div class="seo-serang-shell">
            <div class="seo-serang-heading">
                <p class="seo-serang-eyebrow">Cara Kerja</p>
                <h2 id="seo-process-title">Proses Optimasi yang Jelas dan Bertahap</h2>
                <p>Optimasi dimulai dengan memahami kondisi website, lalu mengerjakan prioritas yang relevan dan meninjau kesehatan implementasinya.</p>
            </div>
            <div class="seo-serang-process-grid">
                <article class="seo-serang-step"><span class="seo-serang-step-number">01</span><h3>Audit &amp; Penyelarasan Tujuan</h3><p>Meninjau kondisi teknis, struktur halaman, target pencarian, dan tujuan bisnis untuk menentukan ruang lingkup optimasi yang relevan.</p></article>
                <article class="seo-serang-step"><span class="seo-serang-step-number">02</span><h3>Optimasi Berdasarkan Prioritas</h3><p>Mengerjakan perbaikan teknis dan on-page secara bertahap berdasarkan dampak, urgensi, serta kesiapan website.</p></article>
                <article class="seo-serang-step"><span class="seo-serang-step-number">03</span><h3>Review &amp; Monitoring Teknis</h3><p>Memeriksa hasil implementasi, kesehatan crawl dan indexing, performa halaman, serta prioritas optimasi lanjutan tanpa menjanjikan posisi tertentu.</p></article>
            </div>
            <p class="seo-serang-resource">Anda juga dapat melihat <a href="{{ route('portfolio.index') }}">portfolio website JASAIBNU</a> untuk mengenal pekerjaan yang telah dipublikasikan.</p>
        </div>
    </section>

    <section class="seo-serang-section seo-serang-faq" aria-labelledby="seo-faq-title">
        <div class="seo-serang-shell">
            <div class="seo-serang-heading">
                <p class="seo-serang-eyebrow">Pertanyaan Umum</p>
                <h2 id="seo-faq-title">Pertanyaan tentang Jasa SEO Serang</h2>
            </div>
            <div class="seo-serang-faq-list">
                @foreach ($faqs as $faq)
                    <details class="seo-serang-faq-item">
                        <summary>{{ $faq['question'] }}</summary>
                        <div class="seo-serang-faq-answer"><p>{{ $faq['answer'] }}</p></div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="seo-serang-final" aria-labelledby="seo-final-title">
        <div class="seo-serang-shell seo-serang-final-box">
            <div>
                <h2 id="seo-final-title">Siap Meninjau Potensi SEO Website Bisnis Anda?</h2>
                <p>Ceritakan kondisi website dan target bisnis Anda. JASAIBNU akan membantu memetakan kebutuhan teknis, on-page, struktur konten, dan prioritas optimasi yang realistis. Anda juga dapat <a href="{{ route('contact') }}" style="color: #fff;">hubungi tim JASAIBNU</a>.</p>
            </div>
            <a class="seo-serang-button" href="{{ $whatsappUrl }}" @if ($whatsappExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan SEO Website</a>
        </div>
    </section>
@endsection
