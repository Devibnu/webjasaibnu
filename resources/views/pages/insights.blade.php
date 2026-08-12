@extends('layouts.app')

@section('title', 'Insights | PT JASA IBNU DEVELOPMENT')
@section('meta_description', 'Artikel dan panduan JASAIBNU tentang website development, aplikasi bisnis, SaaS, SEO, integrasi sistem, dan AI untuk mendukung pertumbuhan bisnis.')
@section('body_class', 'insights-page startup2-home')

@push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/startup2/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/startup2/css/style.css') }}" rel="stylesheet">
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
        }

        @media (max-width: 576px) {
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
    <section class="insights-blog-section" aria-labelledby="insights-list-heading">
        <div class="insights-shell">
            <div class="insights-blog-layout">
                <div class="insights-blog-main">
                    <div class="insights-blog-grid">
                        @foreach ($articles as $article)
                            <article class="startup-blog-card">
                                <div class="startup-blog-image">
                                    <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}">
                                    <a href="{{ route('insights.show', $article->slug) }}">{{ $article->categoryName() }}</a>
                                </div>
                                <div class="startup-blog-body">
                                    <h2>
                                        <a href="{{ route('insights.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h2>
                                    <p>{{ $article->excerpt }}</p>
                                    <a class="startup-blog-read-more" href="{{ route('insights.show', $article->slug) }}">Read More <span aria-hidden="true">→</span></a>
                                </div>
                            </article>
                        @endforeach

                        @if ($articles->hasPages())
                            <nav class="insights-pagination" aria-label="Page navigation">
                                @if ($articles->onFirstPage())
                                    <span aria-hidden="true">←</span>
                                @else
                                    <a href="{{ $articles->previousPageUrl() }}" aria-label="Previous page">←</a>
                                @endif

                                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                                    @if ($page === $articles->currentPage())
                                        <strong>{{ $page }}</strong>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($articles->hasMorePages())
                                    <a href="{{ $articles->nextPageUrl() }}" aria-label="Next page">→</a>
                                @else
                                    <span aria-hidden="true">→</span>
                                @endif
                            </nav>
                        @endif
                    </div>
                </div>

                <aside class="insights-sidebar" aria-label="Insights sidebar">
                    <div class="insights-sidebar-block">
                        <div class="insights-search-box">
                            <input type="search" placeholder="Cari insight..." aria-label="Cari insight">
                            <button type="button" aria-label="Search">⌕</button>
                        </div>
                    </div>

                    <div class="insights-sidebar-block">
                        <div class="insights-sidebar-title">
                            <h3>Categories</h3>
                        </div>
                        <div class="insights-category-list">
                            @foreach ($categories as $category)
                                <a href="{{ route('insights.index') }}"><span aria-hidden="true">›</span>{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="insights-sidebar-block">
                        <div class="insights-sidebar-title">
                            <h3>Insight Terbaru</h3>
                        </div>
                        <div class="insights-recent-list">
                            @foreach ($recentArticles as $recent)
                                <a class="insights-recent-item" href="{{ route('insights.show', $recent->slug) }}">
                                    <img src="{{ $recent->imageUrl() }}" alt="">
                                    <span>{{ $recent->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="insights-sidebar-block">
                        <img class="insights-sidebar-image" src="{{ asset('assets/startup2/img/blog-1.jpg') }}" alt="JASAIBNU insight visual">
                    </div>

                    <div class="insights-sidebar-block">
                        <div class="insights-sidebar-title">
                            <h3>Tag Cloud</h3>
                        </div>
                        <div class="insights-tag-list">
                            @foreach (['Website', 'SEO', 'SaaS', 'AI', 'API', 'Security', 'Automation'] as $tag)
                                <a href="{{ route('insights.index') }}">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
