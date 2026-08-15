@extends('layouts.app')

@section('title', 'Portfolio | PT JASA IBNU DEVELOPMENT')
@section('meta_description', 'Portfolio showcase JASAIBNU untuk website, aplikasi bisnis, SaaS, CRM, service management, sales platform, AI, dan integrasi sistem tanpa klaim klien fiktif.')
@section('body_class', 'portfolio-page startup2-home')

@push('head')
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
    <section class="portfolio-intro" aria-labelledby="portfolio-overview-heading">
        <div class="portfolio-shell">
            <div class="portfolio-section-title">
                <p>{{ $pageSettings->value('eyebrow') }}</p>
                <h1 id="portfolio-overview-heading">{{ $pageSettings->value('title') }}</h1>
                <span>{{ $pageSettings->value('description') }}</span>
            </div>

            <div class="portfolio-grid">
                @forelse ($items as $item)
                    <article class="portfolio-card">
                        <div class="portfolio-card-media" aria-hidden="true">
                            @if ($item->imageUrl())
                                <img src="{{ $item->imageUrl() }}" alt="" width="500" height="350" loading="lazy" decoding="async">
                            @else
                                <span><strong>{{ $item->code ?: Illuminate\Support\Str::of($item->title)->substr(0, 3)->upper() }}</strong></span>
                            @endif
                        </div>
                        <div class="portfolio-card-body">
                            <p>{{ $item->categoryName() }}</p>
                            <h2>{{ $item->title }}</h2>
                            <span>{{ $item->excerpt ?: $item->description }}</span>
                            @if ($item->technologyList())
                                <div class="portfolio-tags">
                                    @foreach ($item->technologyList() as $tag)
                                        <span>{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if ($item->project_url)
                                <a class="portfolio-project-link" href="{{ $item->project_url }}" target="_blank" rel="noopener noreferrer">Visit Project</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <article class="portfolio-card">
                        <div class="portfolio-card-body">
                            <p>PORTFOLIO</p>
                            <h2>Portfolio sedang disiapkan</h2>
                            <span>Konten portfolio akan ditampilkan setelah item dipublikasikan melalui admin CMS.</span>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <section class="portfolio-cta" aria-labelledby="portfolio-cta-heading">
        <div class="portfolio-shell">
            <div class="portfolio-cta-panel">
                <p>{{ $pageSettings->value('cta_eyebrow') }}</p>
                <h1 id="portfolio-cta-heading">{{ $pageSettings->value('cta_title') }}</h1>
                <span>{{ $pageSettings->value('cta_description') }}</span>
                <div>
                    <a href="{{ $pageSettings->ctaPrimaryUrl() }}">{{ $pageSettings->ctaPrimaryLabel() }}</a>
                    <a href="{{ $pageSettings->ctaSecondaryUrl() }}">{{ $pageSettings->ctaSecondaryLabel() }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
