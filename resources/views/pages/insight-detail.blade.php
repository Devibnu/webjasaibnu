@extends('layouts.app')

@section('title', $article->seo_title ?: $article->title)
@section('meta_description', $article->seo_description ?: $article->excerpt)
@section('canonical', route('insights.show', $article->slug))
@section('og_type', 'article')
@section('twitter_card', 'summary_large_image')
@section('body_class', 'insights-page startup2-home')
@if($article->imageUrl())
    @section('og_image', $article->imageUrl())
@endif

@push('head')
    <meta property="article:published_time" content="{{ $article->published_at?->toIso8601String() }}">
    @if($article->category)
        <meta property="article:section" content="{{ $article->category->name }}">
    @endif
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "BlogPosting",
        "headline": @json($article->title),
        "description": @json($article->seo_description ?: $article->excerpt),
        "datePublished": @json($article->published_at?->toIso8601String()),
        "dateModified": @json($article->updated_at->toIso8601String()),
        "mainEntityOfPage": {
            "@@type": "WebPage",
            "@@id": @json(route('insights.show', $article->slug))
        }
    }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .startup2-home {
            font-family: "Rubik", sans-serif;
            overflow-x: hidden;
        }

        .startup2-home .navbar-dark .navbar-brand h1 {
            font-size: 1.9rem;
            line-height: 1.02;
            letter-spacing: 0;
        }

        .startup2-home .navbar-brand small {
            display: block;
            margin-top: 2px;
            color: rgba(255, 255, 255, .72);
            font-family: "Nunito", sans-serif;
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: 0;
        }

        .startup2-home .navbar-dark .navbar-nav .nav-link {
            margin-left: 18px;
            font-size: 14px;
            font-weight: 500;
        }

        .startup2-home .navbar .btn {
            font-size: .9rem;
            padding: .48rem 1.05rem !important;
        }

        .startup2-home .sticky-top.navbar-dark .navbar-brand small {
            color: var(--dark);
        }

        @media (max-width: 991.98px) {
            .startup2-home .navbar-dark .navbar-brand small {
                color: var(--dark);
            }
        }

        .startup2-home .ji-brand-icon {
            display: inline-grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border-radius: 2px;
            background: var(--primary);
            color: #fff;
            font-size: .92rem;
            vertical-align: middle;
        }

        .startup2-home .ji-bars,
        .startup2-home .ji-topbar-icon {
            font-weight: 800;
            line-height: 1;
        }

        @media (max-width: 1199.98px) {
            .startup2-home .navbar-dark .navbar-brand h1 {
                font-size: 1.72rem;
            }

            .startup2-home .navbar-dark .navbar-nav .nav-link {
                margin-left: 12px;
                font-size: 13.5px;
            }
        }

        @media (max-width: 991.98px) {
            .startup2-home .navbar-dark .navbar-brand h1 {
                font-size: 1.65rem;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero {
                min-height: 0 !important;
                height: auto !important;
                padding: 44px 0 36px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-page-hero-content {
                width: 100%;
                padding: 0 24px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-page-label {
                margin-bottom: 6px !important;
                font-size: 1rem !important;
                line-height: 1.25 !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero h1#insights-page-title {
                max-width: 92% !important;
                margin-right: auto !important;
                margin-left: auto !important;
                font-size: clamp(36px, 5.2vw, 42px) !important;
                line-height: 1.1 !important;
                letter-spacing: 0 !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb {
                gap: 7px !important;
                margin-top: 7px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb a,
            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb span {
                font-size: clamp(15px, 2.1vw, 16px) !important;
                line-height: 1.2 !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb li:last-child span {
                max-width: min(520px, 58vw) !important;
            }
        }

        @media (max-width: 575.98px) {
            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero {
                min-height: 0 !important;
                height: auto !important;
                padding: 28px 0 26px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-page-hero-content {
                padding: 0 16px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-page-label {
                margin-bottom: 5px !important;
                font-size: 15px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero h1#insights-page-title {
                max-width: 94% !important;
                margin-right: auto !important;
                margin-left: auto !important;
                font-size: clamp(30px, 8vw, 34px) !important;
                line-height: 1.08 !important;
                letter-spacing: 0 !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb {
                gap: 6px !important;
                margin-top: 6px !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb a,
            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb span {
                font-size: clamp(14px, 3.7vw, 16px) !important;
            }

            body.insights-page.startup2-home .startup-inner-shell .insights-detail-hero .insights-breadcrumb li:last-child span {
                max-width: min(360px, 40vw) !important;
            }

            .startup2-home .jasaibnu-startup-footer .container,
            .startup2-home .jasaibnu-startup-copyright .container {
                width: min(100% - 28px, 362px);
                padding-right: 0;
                padding-left: 0;
            }

            .startup2-home .jasaibnu-startup-footer .row,
            .startup2-home .jasaibnu-startup-copyright .row {
                --bs-gutter-x: 0;
                margin-right: 0;
                margin-left: 0;
            }

            .startup2-home .jasaibnu-startup-footer [class*="col-"],
            .startup2-home .jasaibnu-startup-copyright [class*="col-"] {
                min-width: 0;
                padding-right: 0;
                padding-left: 0;
            }

            .startup2-home .jasaibnu-startup-footer .footer-about > div {
                padding-right: 20px !important;
                padding-left: 20px !important;
            }

            .startup2-home .jasaibnu-startup-footer .footer-about p {
                max-width: 280px;
                margin-right: auto;
                margin-left: auto;
                overflow-wrap: anywhere;
            }

            .startup2-home .jasaibnu-startup-copyright p {
                max-width: 260px;
                margin-right: auto;
                margin-left: auto;
                font-size: .92rem;
                overflow-wrap: anywhere;
            }
        }
    </style>
@endpush

@section('content')
    <section class="insights-blog-section insights-detail-section" aria-label="Insight article">
        <div class="insights-shell">
            <div class="row g-5 insights-detail-layout">
                <div class="col-lg-8">
                    <article class="insights-detail-main">
                        <img class="insights-detail-image" src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" width="1200" height="675" fetchpriority="high" decoding="sync">
                        <div class="insights-detail-meta" aria-label="Insight metadata">
                            <span>{{ $article->categoryName() }}</span>
                            @if ($article->published_at)
                                <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->translatedFormat('d M Y') }}</time>
                            @endif
                        </div>

                        <div class="insights-detail-content">
                            @foreach ($article->contentBlocks() as $block)
                                @if ($block['type'] === 'heading')
                                    <h2>{{ $block['text'] }}</h2>
                                @else
                                    <p>{{ $block['text'] }}</p>
                                @endif
                            @endforeach
                            @if ($article->slug === 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun')
                                <p>Jika fondasi ini perlu diterapkan sejak awal project, pelajari juga <a href="{{ route('website-development') }}">layanan pembuatan website profesional</a> JASAIBNU.</p>
                                <p>Jika fondasi teknis website Anda perlu ditinjau lebih lanjut, pelajari <a href="{{ route('seo-serang') }}">layanan SEO untuk bisnis di Serang</a> dari JASAIBNU.</p>
                            @elseif ($article->slug === 'cara-memilih-jasa-pembuatan-website-di-serang')
                                <p>Setelah website tersedia, bisnis juga dapat mempertimbangkan <a href="{{ route('seo-serang') }}">optimasi SEO lanjutan untuk website bisnis</a> agar struktur teknis dan halaman penting tetap terarah.</p>
                            @elseif ($article->slug === 'keamanan-website-bisnis-yang-tidak-boleh-diabaikan')
                                <p>Keamanan dasar sebaiknya direncanakan sejak proses <a href="{{ route('website-development') }}">pengembangan website untuk bisnis</a>, bukan hanya setelah website online.</p>
                            @endif
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    <aside class="insights-sidebar insights-detail-sidebar" aria-label="Insight sidebar">
                        @if ($categories->isNotEmpty())
                            <div class="insights-sidebar-block">
                                <div class="insights-sidebar-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="insights-category-list insights-category-list-static">
                                    @foreach ($categories as $category)
                                        <span><b aria-hidden="true">›</b>{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($recentArticles->isNotEmpty())
                            <div class="insights-sidebar-block">
                                <div class="insights-sidebar-title">
                                    <h3>Recent Post</h3>
                                </div>
                                <div class="insights-recent-list">
                                    @foreach ($recentArticles as $recent)
                                        <a class="insights-recent-item" href="{{ route('insights.show', $recent->slug) }}">
                                            <img src="{{ $recent->imageUrl() }}" alt="" width="100" height="100" loading="lazy" decoding="async">
                                            <span>{{ $recent->title }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
