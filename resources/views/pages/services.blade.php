@extends('layouts.app')

@section('title', 'Jasa Website, Aplikasi, SEO & AI Integration | JASAIBNU')
@section('meta_description', 'Layanan JASAIBNU untuk jasa pembuatan website, SEO, aplikasi web, mobile application, SaaS development, dan AI integration untuk kebutuhan bisnis.')
@section('body_class', 'services-page startup2-home')

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
    <section class="services-intro" aria-labelledby="services-overview-heading">
        <div class="services-shell">
            <div class="services-section-title">
                <p>LAYANAN KAMI</p>
                <h2 id="services-overview-heading">Solusi Digital untuk Mendukung Pertumbuhan Bisnis Anda</h2>
            </div>

            <div class="services-grid">
                @foreach ($services as $service)
                    <article class="services-card">
                        <div class="services-card-icon" aria-hidden="true"><span>{{ $service->icon }}</span></div>
                        <h2>{{ $service->title }}</h2>
                        <p>{{ $service->description }}</p>
                        <a class="services-card-link" href="{{ route('contact') }}" aria-label="Diskusikan {{ $service->title }}">
                            <span aria-hidden="true">→</span>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="services-proof-section" aria-labelledby="services-proof-heading">
        <div class="services-shell">
            <div class="services-section-title services-section-title-tight">
                <p>PENDEKATAN KERJA</p>
                <h2 id="services-proof-heading">Dari Kebutuhan Bisnis sampai Sistem Siap Dirawat</h2>
            </div>

            <div class="services-proof-row" aria-label="Tahapan kerja JASAIBNU">
                @foreach ([
                    ['step' => '01', 'title' => 'Discovery', 'body' => 'Memetakan kebutuhan bisnis, pengguna, target, dan batasan teknis sebelum desain solusi.'],
                    ['step' => '02', 'title' => 'Development', 'body' => 'Membangun website, aplikasi, SaaS, SEO, atau AI integration dengan fondasi teknis yang rapi.'],
                    ['step' => '03', 'title' => 'Maintenance', 'body' => 'Menyiapkan testing, deployment, dan perawatan agar sistem tetap stabil setelah rilis.'],
                ] as $item)
                    <article class="services-proof-card">
                        <div class="services-proof-card-head">
                            <span class="services-proof-step">{{ $item['step'] }}</span>
                            <div>
                                <h2>{{ $item['title'] }}</h2>
                                <small>JASAIBNU Process</small>
                            </div>
                        </div>
                        <p>{{ $item['body'] }}</p>
                    </article>
                @endforeach
            </div>
            <p class="mt-4 mb-0">
                Untuk kebutuhan website bisnis secara umum, pelajari
                <a href="{{ route('website-development') }}">layanan pembuatan website profesional</a>
                yang mencakup perencanaan, development, testing, dan persiapan go-live.
            </p>
            <p class="mt-4 mb-0">
                Untuk kebutuhan lokal, JASAIBNU juga menyediakan
                <a href="{{ route('website-development-serang') }}">Jasa Pembuatan Website di Serang</a>,
                <a href="{{ route('website-development-banten') }}">layanan website Banten</a>, dan
                <a href="{{ route('website-development-umkm-serang') }}">website UMKM Serang</a>
                dengan arah kebutuhan yang berbeda.
            </p>
        </div>
    </section>

    <section class="services-vendor-section" aria-labelledby="services-technology-heading">
        <div class="services-shell">
            <div class="services-technology-heading">
                <p>TECHNOLOGY &amp; EXPERTISE</p>
                <h2 id="services-technology-heading">Teknologi yang kami gunakan untuk membangun solusi digital yang scalable dan maintainable.</h2>
            </div>
            <div class="services-vendor-strip">
                @foreach ($technologies as $item)
                    <span class="services-technology-item" aria-label="{{ $item->name }}">
                        @if ($item->logo_path)
                            <img src="{{ asset('storage/' . $item->logo_path) }}" alt="" aria-hidden="true" loading="lazy">
                        @else
                            <strong aria-hidden="true">{{ $item->mark ?: \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($item->name, 0, 2)) }}</strong>
                        @endif
                        <small>{{ $item->name }}</small>
                    </span>
                @endforeach
            </div>
        </div>
    </section>
@endsection
