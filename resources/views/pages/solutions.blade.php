@extends('layouts.app')

@section('title', 'Solutions | PT JASA IBNU DEVELOPMENT')
@section('meta_description', 'Solusi teknologi JASAIBNU untuk business process automation, system integration, scalable architecture, AI-powered solutions, digital platform development, dan legacy modernization.')
@section('body_class', 'solutions-page startup2-home')

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
    <section class="solutions-intro" aria-labelledby="solutions-overview-heading">
        <div class="solutions-shell">
            <div class="solutions-section-title">
                <p>SOLUSI JASAIBNU</p>
                <h1 id="solutions-overview-heading">Solusi Teknologi yang Dibangun Sesuai Kebutuhan Bisnis</h1>
                <span>Kami membantu perusahaan memilih dan membangun solusi digital yang tepat, mulai dari otomasi proses, integrasi sistem, cloud, hingga penerapan AI.</span>
            </div>

            <div class="solutions-grid">
                @foreach ([
                    ['icon' => 'BA', 'title' => 'Business Process Automation', 'body' => 'Digitalisasi dan otomasi workflow untuk mengurangi proses manual dan meningkatkan efisiensi operasional.'],
                    ['icon' => 'SI', 'title' => 'System Integration', 'body' => 'Integrasi antar aplikasi, API, database, dan layanan eksternal agar data dan proses bisnis berjalan lebih terhubung.'],
                    ['icon' => 'CL', 'title' => 'Cloud & Scalable Architecture', 'body' => 'Perancangan arsitektur aplikasi yang scalable, maintainable, dan siap berkembang mengikuti kebutuhan bisnis.'],
                    ['icon' => 'AI', 'title' => 'AI-Powered Solutions', 'body' => 'Penerapan AI untuk automation, chatbot, intelligent search, document processing, dan peningkatan produktivitas.'],
                    ['icon' => 'DP', 'title' => 'Digital Platform Development', 'body' => 'Pengembangan platform digital custom untuk mendukung operasional, customer experience, dan model bisnis baru.'],
                    ['icon' => 'LM', 'title' => 'Legacy System Modernization', 'body' => 'Modernisasi aplikasi lama secara bertahap agar lebih aman, mudah dikembangkan, dan siap terintegrasi dengan teknologi baru.'],
                ] as $solution)
                    <article class="solution-card">
                        <div class="solution-card-icon" aria-hidden="true"><span>{{ $solution['icon'] }}</span></div>
                        <h2>{{ $solution['title'] }}</h2>
                        <p>{{ $solution['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="solutions-process" aria-labelledby="solutions-process-heading">
        <div class="solutions-shell">
            <div class="solutions-section-title solutions-section-title-tight">
                <p>HOW WE WORK</p>
                <h1 id="solutions-process-heading">Pendekatan Teknologi yang Fokus pada Kebutuhan Bisnis</h1>
            </div>

            <div class="solutions-process-grid">
                @foreach ([
                    ['step' => '01', 'title' => 'Discover', 'body' => 'Memahami kebutuhan, proses, tantangan, dan target bisnis.'],
                    ['step' => '02', 'title' => 'Design & Build', 'body' => 'Merancang solusi dan mengembangkan sistem yang tepat guna.'],
                    ['step' => '03', 'title' => 'Scale & Improve', 'body' => 'Mengoptimalkan performa dan mengembangkan sistem secara bertahap.'],
                ] as $item)
                    <article class="solutions-process-card">
                        <div>
                            <span>{{ $item['step'] }}</span>
                            <h2>{{ $item['title'] }}</h2>
                        </div>
                        <p>{{ $item['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
