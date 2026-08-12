@extends('layouts.app')

@section('title', 'About JASAIBNU | PT JASA IBNU DEVELOPMENT')
@section('meta_description', 'Kenali JASAIBNU, partner teknologi untuk pengembangan website, aplikasi, SaaS, SEO, integrasi sistem, dan solusi AI bagi kebutuhan bisnis.')
@section('body_class', 'about-page startup2-home')

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
    <section class="about-content" aria-labelledby="about-main-heading">
        <div class="about-shell">
            <div class="about-split">
                <div class="about-copy">
                    <div class="about-section-title">
                        <p>{{ $about->hero_label }}</p>
                        <h2 id="about-main-heading">{{ $about->hero_title }}</h2>
                    </div>
                    @if ($about->content_p1)
                        <p>{{ $about->content_p1 }}</p>
                    @endif
                    @if ($about->content_p2)
                        <p>{{ $about->content_p2 }}</p>
                    @endif

                    <div class="about-values">
                        @foreach ($about->valuesList() as $value)
                            <article>
                                <h3><span aria-hidden="true">✓</span>{{ $value['title'] }}</h3>
                                <p>{{ $value['body'] }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="about-cta">
                        <a href="{{ route('contact') }}">{{ $about->cta_consultation_text }}</a>
                        <a href="{{ route('services.index') }}">{{ $about->cta_services_text }}</a>
                    </div>
                </div>

                <figure class="about-visual">
                    <img src="{{ $about->visualImageUrl() }}" alt="Visual kerja teknologi dan bisnis JASAIBNU">
                </figure>
            </div>
        </div>
    </section>

    <section class="about-process" aria-labelledby="about-process-heading">
        <div class="about-shell">
            <div class="about-process-title">
                <p>{{ $about->process_label }}</p>
                <h2 id="about-process-heading">{{ $about->process_title }}</h2>
            </div>

            <div class="about-process-grid">
                @foreach ($about->processSteps() as $item)
                    <article>
                        <span>{{ $item['step'] }}</span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
