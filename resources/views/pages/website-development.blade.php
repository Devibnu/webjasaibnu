@extends('layouts.app')

@php
    $landing = array_merge([
        'title' => 'Jasa Pembuatan Website Profesional | JASAIBNU',
        'meta_description' => 'JASAIBNU menyediakan jasa pembuatan website profesional untuk company profile, landing page, website bisnis, SEO, dan sistem web yang cepat, aman, dan mudah dikembangkan.',
        'canonical' => route('website-development'),
        'label' => 'Jasa Pembuatan Website',
        'h1' => 'Jasa Pembuatan Website Profesional untuk Bisnis yang Ingin Tumbuh',
        'hero_copy' => 'JASAIBNU membantu bisnis membuat website company profile, landing page, website layanan, dan sistem web yang cepat, aman, mobile-friendly, serta siap dioptimasi untuk Google.',
        'impact_label' => 'Fungsi punya website',
        'impact_title' => 'Website membantu bisnis terlihat profesional, dipercaya, dan lebih mudah menghasilkan peluang penjualan.',
        'impact_copy' => 'Website bukan sekadar halaman online. Website menjadi pusat informasi resmi bisnis, tempat pelanggan mengenal layanan, melihat portfolio, membaca keunggulan, lalu menghubungi Anda saat mereka siap membeli atau berdiskusi.',
        'badge' => 'Website bekerja 24 jam sebagai etalase, profil bisnis, dan pintu masuk calon pelanggan.',
    ], $landing ?? []);

    $primarySerangLinks = [
        'website-development-serang-murah' => [
            'before' => 'Jika bisnis Anda membutuhkan cakupan yang lebih lengkap, lihat juga ',
            'anchor' => 'jasa pembuatan website profesional di Serang',
            'after' => ' untuk pilihan website yang dapat disesuaikan dengan kebutuhan jangka panjang.',
        ],
        'website-development-umkm-serang' => [
            'before' => 'Untuk kebutuhan usaha yang lebih luas, pelajari juga ',
            'anchor' => 'layanan pembuatan website di Serang',
            'after' => ' yang dapat dikembangkan mengikuti pertumbuhan bisnis.',
        ],
        'website-development-banten' => [
            'before' => 'Bagi bisnis yang beroperasi di Kota Serang dan sekitarnya, tersedia juga ',
            'anchor' => 'jasa website untuk area Serang',
            'after' => ' dengan pendekatan yang disesuaikan untuk kebutuhan bisnis lokal.',
        ],
    ];
    $primarySerangLink = $primarySerangLinks[request()->route()?->getName()] ?? null;
    $isNationalLanding = request()->routeIs('website-development');
    $nationalPortfolioItems = $nationalPortfolioItems ?? collect();
@endphp

@section('title', $landing['title'])
@section('meta_description', $landing['meta_description'])
@section('canonical', $landing['canonical'])
@section('body_class', 'services-page startup2-home' . ($isNationalLanding ? ' national-conversion-page' : ''))

@push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .startup2-home {
            font-family: "Rubik", sans-serif;
            overflow-x: hidden;
        }

        .seo-service-hero {
            position: relative;
            display: flex;
            min-height: clamp(650px, calc(100svh - 74px), 780px);
            align-items: center;
            padding: clamp(58px, 7vw, 96px) 0 clamp(64px, 7vw, 104px);
            overflow: hidden;
            background: linear-gradient(90deg, rgba(9, 30, 62, .9) 0%, rgba(9, 30, 62, .76) 52%, rgba(9, 30, 62, .66) 100%), url("/assets/startup2/img/optimized/carousel-1-desktop.webp") center center / cover no-repeat;
            color: #fff;
        }

        .seo-service-hero::after {
            content: "";
            position: absolute;
            inset: auto 0 0;
            height: 38%;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, .08));
            pointer-events: none;
        }

        .seo-service-shell {
            width: min(100% - 32px, 1120px);
            margin-inline: auto;
        }

        .seo-service-hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr;
            gap: clamp(30px, 5vw, 70px);
            align-items: center;
        }

        .seo-service-copy-block {
            max-width: 820px;
            text-align: center;
            margin-inline: auto;
        }

        .seo-service-label {
            display: inline-flex;
            align-items: center;
            margin: 0 0 16px;
            padding: .42rem .68rem;
            border: 1px solid rgba(6, 163, 218, .38);
            border-radius: 6px;
            background: rgba(6, 163, 218, .12);
            color: #06a3da;
            font-size: .82rem;
            font-weight: 800;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .seo-service-hero h1 {
            max-width: 760px;
            margin: 0 auto 20px;
            color: #fff;
            font-family: "Nunito", sans-serif;
            font-size: clamp(38px, 3.7vw, 56px);
            font-weight: 800;
            line-height: 1.12;
        }

        .seo-service-hero-copy {
            max-width: 680px;
            margin: 0 auto 28px;
            color: rgba(255, 255, 255, .9);
            font-size: clamp(1rem, 1.12vw, 1.1rem);
            line-height: 1.75;
        }

        .seo-service-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .seo-service-button {
            display: inline-flex;
            min-height: 48px;
            align-items: center;
            justify-content: center;
            padding: .75rem 1.35rem;
            border: 1px solid #06a3da;
            border-radius: 6px;
            background: #06a3da;
            color: #fff;
            font-weight: 700;
            box-shadow: 0 14px 28px rgba(6, 163, 218, .24);
        }

        .seo-service-button.secondary {
            border-color: rgba(255, 255, 255, .6);
            background: transparent;
            box-shadow: none;
        }

        .seo-service-impact {
            padding: clamp(58px, 7vw, 92px) 0;
            background: #fff;
        }

        .seo-service-impact-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
            gap: clamp(32px, 5vw, 68px);
            align-items: center;
        }

        .seo-service-impact-media {
            position: relative;
            min-height: 520px;
            overflow: hidden;
            border-radius: 6px;
            background: #eef9ff;
            box-shadow: 0 22px 54px rgba(9, 30, 62, .16);
        }

        .seo-service-impact-media img {
            width: 100%;
            height: 100%;
            min-height: 520px;
            object-fit: cover;
            opacity: .96;
        }

        .seo-service-impact-media picture {
            display: block;
            height: 100%;
        }

        .seo-service-impact-badge {
            position: absolute;
            right: 22px;
            bottom: 22px;
            max-width: 280px;
            padding: 18px;
            border-radius: 6px;
            background: #06a3da;
            color: #fff;
            font-weight: 800;
            line-height: 1.35;
        }

        .seo-service-impact-copy h2 {
            max-width: 600px;
            margin: 0 0 16px;
            color: #091e3e;
            font-size: clamp(26px, 2.35vw, 34px);
            font-weight: 800;
            line-height: 1.22;
        }

        .seo-service-impact-copy > p {
            max-width: 620px;
            margin: 0 0 24px;
            color: #6b6a75;
            line-height: 1.75;
        }

        .seo-service-impact-points {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .seo-service-impact-point {
            min-height: 178px;
            padding: 24px;
            border: 1px solid #dcebf4;
            border-radius: 6px;
            background: #f8fcff;
            box-shadow: none;
        }

        .seo-service-impact-icon {
            display: inline-grid;
            width: 50px;
            height: 50px;
            place-items: center;
            margin-bottom: 16px;
            border-radius: 6px;
            background: #06a3da;
            color: #fff;
            font-size: .95rem;
            font-weight: 800;
            box-shadow: 0 12px 24px rgba(6, 163, 218, .22);
        }

        .seo-service-impact-point strong {
            display: block;
            margin-bottom: 6px;
            color: #091e3e;
            font-weight: 800;
        }

        .seo-service-impact-point span {
            color: #6b6a75;
            line-height: 1.55;
        }

        .seo-service-advantage {
            padding: clamp(58px, 7vw, 92px) 0 clamp(44px, 6vw, 78px);
            background: #eef9ff;
        }

        .seo-service-advantage-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .seo-service-advantage-card {
            min-height: 190px;
            padding: 26px;
            border: 1px solid #dcebf4;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 18px 46px rgba(9, 30, 62, .1);
        }

        .seo-service-advantage-icon {
            display: inline-grid;
            width: 54px;
            height: 54px;
            place-items: center;
            margin-bottom: 18px;
            border-radius: 6px;
            background: #06a3da;
            color: #fff;
            font-size: 1.45rem;
            font-weight: 800;
        }

        .seo-service-advantage-card h2 {
            margin: 0 0 10px;
            color: #091e3e;
            font-size: 1.2rem;
            font-weight: 800;
        }

        .seo-service-advantage-card p {
            margin: 0;
            color: #6b6a75;
            line-height: 1.65;
        }

        .seo-service-type-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .seo-service-type-card {
            min-height: 210px;
            padding: 26px;
            border: 1px solid #e2edf4;
            border-radius: 6px;
            background: #fff;
        }

        .seo-service-type-card span {
            display: inline-grid;
            width: 48px;
            height: 48px;
            place-items: center;
            margin-bottom: 18px;
            border-radius: 6px;
            background: #eef9ff;
            color: #06a3da;
            font-weight: 800;
        }

        .seo-service-type-card h2 {
            margin: 0 0 10px;
            color: #091e3e;
            font-size: 1.16rem;
            font-weight: 800;
        }

        .seo-service-type-card p {
            margin: 0;
            color: #6b6a75;
            line-height: 1.65;
        }

        .seo-service-section {
            padding: clamp(64px, 8vw, 104px) 0;
            background: #fff;
        }

        .seo-service-section.alt {
            background: #eef9ff;
        }

        .seo-service-heading {
            max-width: 760px;
            margin-bottom: 34px;
        }

        .seo-service-heading h2 {
            margin: 0;
            color: #091e3e;
            font-size: clamp(30px, 3.2vw, 44px);
            font-weight: 800;
            line-height: 1.14;
        }

        .seo-service-heading p {
            margin: 12px 0 0;
            color: #6b6a75;
            line-height: 1.75;
        }

        .seo-service-card-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .seo-service-card,
        .seo-service-faq {
            padding: 26px;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 16px 42px rgba(9, 30, 62, .08);
        }

        .seo-service-section:not(.alt) .seo-service-card {
            border: 1px solid #e2edf4;
            box-shadow: none;
        }

        .seo-service-card strong {
            display: inline-flex;
            width: 44px;
            height: 44px;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            border-radius: 6px;
            background: #06a3da;
            color: #fff;
            font-weight: 800;
        }

        .seo-service-card h3,
        .seo-service-faq h3 {
            margin: 0 0 10px;
            color: #091e3e;
            font-size: 1.18rem;
            font-weight: 800;
        }

        .seo-service-card p,
        .seo-service-faq p {
            margin: 0;
            color: #6b6a75;
            line-height: 1.68;
        }

        .seo-service-faq-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .seo-service-cta {
            padding: clamp(52px, 7vw, 82px) 0;
            background: #091e3e;
            color: #fff;
            text-align: center;
        }

        .seo-service-cta h2 {
            max-width: 780px;
            margin: 0 auto 16px;
            color: #fff;
            font-size: clamp(30px, 3.2vw, 44px);
            font-weight: 800;
            line-height: 1.16;
        }

        .seo-service-cta p {
            max-width: 680px;
            margin: 0 auto 26px;
            color: rgba(255, 255, 255, .82);
            line-height: 1.7;
        }

        .seo-service-mid-cta {
            padding: clamp(42px, 6vw, 64px) 0;
            background: #06a3da;
            color: #fff;
        }

        .seo-service-mid-cta-row {
            display: flex;
            gap: 24px;
            align-items: center;
            justify-content: space-between;
        }

        .seo-service-mid-cta h2 {
            max-width: 680px;
            margin: 0 0 10px;
            color: #fff;
            font-size: clamp(26px, 2.6vw, 38px);
            font-weight: 800;
            line-height: 1.16;
        }

        .seo-service-mid-cta p {
            max-width: 620px;
            margin: 0;
            color: rgba(255, 255, 255, .9);
            line-height: 1.68;
        }

        .seo-service-mid-cta .seo-service-button {
            flex: 0 0 auto;
            border-color: #fff;
            background: #fff;
            color: #091e3e;
            box-shadow: none;
        }

        @media (max-width: 991.98px) {
            .seo-service-hero-grid,
            .seo-service-impact-grid,
            .seo-service-advantage-grid,
            .seo-service-type-grid,
            .seo-service-card-grid,
            .seo-service-faq-grid {
                grid-template-columns: 1fr;
            }

            .seo-service-hero {
                min-height: auto;
                padding: 56px 0 72px;
                background-image: linear-gradient(180deg, rgba(9, 30, 62, .88), rgba(9, 30, 62, .72)), url("/assets/startup2/img/optimized/carousel-1-mobile.webp");
            }

            .seo-service-impact-media,
            .seo-service-impact-media img {
                min-height: 360px;
            }

            .seo-service-mid-cta-row {
                display: grid;
            }
        }

        @media (max-width: 575.98px) {
            .seo-service-shell {
                width: min(100% - 28px, 390px);
            }

            .seo-service-hero {
                padding: 42px 0 50px;
                background-position: center top;
            }

            .seo-service-hero-grid {
                gap: 24px;
            }

            .seo-service-label {
                margin-bottom: 12px;
                font-size: .76rem;
            }

            .seo-service-hero h1 {
                max-width: 360px;
                margin-inline: auto;
                margin-bottom: 16px;
                font-size: clamp(31px, 8.6vw, 38px);
                line-height: 1.1;
            }

            .seo-service-hero-copy {
                max-width: 350px;
                margin-bottom: 20px;
                font-size: 1rem;
                line-height: 1.62;
            }

            .seo-service-actions {
                display: grid;
                gap: 10px;
            }

            .seo-service-button {
                width: 100%;
                min-height: 46px;
                padding: .7rem 1rem;
            }

            .seo-service-impact {
                padding-top: 44px;
            }

            .seo-service-impact-copy h2,
            .seo-service-heading h2,
            .seo-service-cta h2,
            .seo-service-mid-cta h2 {
                font-size: clamp(25px, 7.2vw, 32px);
                line-height: 1.18;
            }

            .seo-service-impact-points {
                grid-template-columns: 1fr;
            }

            .seo-service-impact-badge {
                right: 14px;
                bottom: 14px;
                left: 14px;
                max-width: none;
            }

            .seo-service-advantage-card,
            .seo-service-type-card,
            .seo-service-card,
            .seo-service-faq {
                padding: 22px;
            }
        }
    </style>
    @if ($isNationalLanding)
        <style>
            .national-service-section {
                padding: clamp(64px, 7vw, 96px) 0;
                background: #fff;
            }

            .national-service-section.alt {
                background: #f7fbfe;
            }

            .national-positioning-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.08fr) minmax(380px, .92fr);
                gap: clamp(44px, 6vw, 84px);
                align-items: center;
            }

            .national-positioning-copy {
                max-width: 660px;
            }

            .national-positioning-copy h2 {
                margin: 0 0 20px;
                color: #091e3e;
                font-family: "Nunito", sans-serif;
                font-size: clamp(2rem, 3.2vw, 2.75rem);
                font-weight: 800;
                line-height: 1.18;
            }

            .national-positioning-copy > p:last-child {
                margin: 0;
                color: #5f6b7a;
                font-size: 1.03rem;
                line-height: 1.8;
            }

            .national-collaboration-panel {
                position: relative;
                display: grid;
                gap: 12px;
                padding: clamp(24px, 3vw, 34px);
                border: 1px solid #dceaf3;
                border-radius: 10px;
                background: #f7fbfe;
                box-shadow: 0 18px 44px rgba(9, 30, 62, .08);
            }

            .national-collaboration-step {
                display: grid;
                grid-template-columns: 46px minmax(0, 1fr);
                gap: 16px;
                align-items: center;
                padding: 16px;
                border: 1px solid #e3edf5;
                border-radius: 7px;
                background: #fff;
            }

            .national-collaboration-step > span {
                display: grid;
                width: 46px;
                height: 46px;
                place-items: center;
                border-radius: 6px;
                background: #06a3da;
                color: #fff;
                font-weight: 800;
            }

            .national-collaboration-step strong {
                display: block;
                margin-bottom: 3px;
                color: #091e3e;
                font-size: 1rem;
            }

            .national-collaboration-step small {
                display: block;
                color: #6b7280;
                font-size: .9rem;
                line-height: 1.45;
            }

            .national-service-grid,
            .national-proof-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 24px;
            }

            .national-service-card {
                padding: 28px;
                border: 1px solid #e3edf5;
                border-radius: 6px;
                background: #fff;
            }

            .national-proof-card {
                display: flex;
                min-height: 100%;
                flex-direction: column;
                overflow: hidden;
                padding: 0;
                border: 1px solid #e3edf5;
                border-radius: 10px;
                background: #fff;
                box-shadow: 0 16px 38px rgba(9, 30, 62, .07);
            }

            .national-service-card h3,
            .national-proof-card h3 {
                margin: 0 0 12px;
                color: #091e3e;
                font-family: "Nunito", sans-serif;
                font-size: 1.2rem;
                font-weight: 800;
            }

            .national-service-card p,
            .national-proof-card p {
                margin: 0;
                color: #5f6b7a;
                line-height: 1.7;
            }

            .national-proof-media {
                display: grid;
                min-height: 220px;
                place-items: center;
                overflow: hidden;
                background: linear-gradient(135deg, #eef9ff, #dff3fb);
            }

            .national-proof-media img {
                display: block;
                width: 100%;
                height: 220px;
                object-fit: cover;
            }

            .national-proof-fallback {
                display: grid;
                width: 88px;
                height: 88px;
                place-items: center;
                border: 1px solid rgba(6, 163, 218, .25);
                border-radius: 10px;
                background: #fff;
                color: #06a3da;
                font-family: "Nunito", sans-serif;
                font-size: 1.2rem;
                font-weight: 900;
                box-shadow: 0 14px 30px rgba(9, 30, 62, .08);
            }

            .national-proof-body {
                display: flex;
                min-height: 0;
                flex: 1;
                flex-direction: column;
                padding: 26px;
            }

            .national-proof-category {
                display: block;
                margin-bottom: 8px;
                color: #06a3da;
                font-size: .8rem;
                font-weight: 800;
                text-transform: uppercase;
            }

            .national-proof-card h3 {
                font-size: 1.3rem;
                line-height: 1.25;
            }

            .national-proof-excerpt {
                display: -webkit-box;
                min-height: 5.1em;
                overflow: hidden;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
            }

            .national-proof-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-top: 18px;
            }

            .national-proof-tags span {
                padding: 5px 8px;
                border: 1px solid #d9edf8;
                border-radius: 4px;
                color: #091e3e;
                font-size: .78rem;
                font-weight: 700;
            }

            .national-proof-link {
                display: inline-block;
                align-self: flex-start;
                margin-top: 18px;
                color: #06a3da;
                font-weight: 700;
            }

            .national-proof-link:focus-visible,
            .national-proof-more a:focus-visible {
                border-radius: 3px;
                outline: 3px solid rgba(6, 163, 218, .35);
                outline-offset: 4px;
            }

            .national-proof-more {
                margin: 30px 0 0;
                text-align: center;
            }

            .national-proof-more a {
                color: #06a3da;
                font-weight: 800;
            }

            @media (max-width: 991.98px) {
                .national-positioning-grid {
                    grid-template-columns: 1fr;
                }

                .national-positioning-copy {
                    max-width: 760px;
                }

                .national-service-grid,
                .national-proof-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width: 575.98px) {
                .national-service-section {
                    padding: 56px 0;
                }

                .national-positioning-grid {
                    gap: 30px;
                }

                .national-positioning-copy h2 {
                    font-size: clamp(1.8rem, 9vw, 2.2rem);
                }

                .national-collaboration-panel {
                    padding: 18px;
                }

                .national-collaboration-step {
                    grid-template-columns: 40px minmax(0, 1fr);
                    gap: 12px;
                    padding: 14px;
                }

                .national-collaboration-step > span {
                    width: 40px;
                    height: 40px;
                }

                .national-service-grid,
                .national-proof-grid {
                    grid-template-columns: 1fr;
                }

                .national-service-card,
                .national-proof-body {
                    padding: 22px;
                }

                .national-proof-media,
                .national-proof-media img {
                    min-height: 200px;
                    height: 200px;
                }
            }

            .national-conversion-page .seo-service-hero {
                min-height: 650px;
                padding: 76px 0;
                background: linear-gradient(135deg, #071a36 0%, #0b2a50 62%, #0b4770 100%);
            }

            .national-conversion-page .seo-service-hero::before {
                content: "";
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 80% 35%, rgba(6, 163, 218, .2), transparent 34%);
                pointer-events: none;
            }

            .national-conversion-page .seo-service-hero-grid {
                grid-template-columns: minmax(0, 1fr) minmax(420px, .88fr);
                gap: 70px;
            }

            .national-conversion-page .seo-service-copy-block {
                max-width: 650px;
                margin: 0;
                text-align: left;
            }

            .national-conversion-page .seo-service-hero h1,
            .national-conversion-page .seo-service-hero-copy {
                margin-left: 0;
            }

            .national-conversion-page .seo-service-actions {
                justify-content: flex-start;
            }

            .national-hero-visual {
                padding: 18px 18px 28px;
                border: 1px solid rgba(255, 255, 255, .2);
                border-radius: 18px;
                background: rgba(255, 255, 255, .1);
                box-shadow: 0 30px 70px rgba(0, 0, 0, .25);
            }

            .national-hero-browser {
                overflow: hidden;
                border-radius: 11px;
                background: #fff;
            }

            .national-hero-browser-bar {
                display: flex;
                gap: 6px;
                padding: 12px 14px;
                background: #edf6fb;
            }

            .national-hero-browser-bar span {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #9bcfe4;
            }

            .national-hero-projects {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                padding: 16px;
            }

            .national-hero-project {
                overflow: hidden;
                border: 1px solid #e0ecf3;
                border-radius: 7px;
                background: #f6fbfe;
            }

            .national-hero-project img {
                display: block;
                width: 100%;
                aspect-ratio: 4 / 3;
                object-fit: cover;
            }

            .national-hero-project span {
                display: grid;
                min-height: 100px;
                place-items: center;
                color: #06a3da;
                font-weight: 800;
            }

            .national-trust-strip {
                position: relative;
                z-index: 2;
                margin-top: -34px;
            }

            .national-trust-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                overflow: hidden;
                border: 1px solid #dceaf3;
                border-radius: 10px;
                background: #fff;
                box-shadow: 0 18px 44px rgba(9, 30, 62, .1);
            }

            .national-trust-item {
                padding: 22px 18px;
                color: #091e3e;
                font-weight: 800;
                text-align: center;
            }

            .national-trust-item + .national-trust-item {
                border-left: 1px solid #e3edf5;
            }

            .national-conversion-section {
                padding: clamp(64px, 7vw, 88px) 0;
            }

            .national-conversion-section.alt {
                background: #f7fbfe;
            }

            .national-conversion-heading {
                max-width: 760px;
                margin-bottom: 32px;
            }

            .national-conversion-heading h2 {
                margin: 0;
                color: #091e3e;
                font: 800 clamp(30px, 3.1vw, 42px)/1.16 "Nunito", sans-serif;
            }

            .national-conversion-heading p {
                margin: 12px 0 0;
                color: #626d7b;
                line-height: 1.7;
            }

            .national-primary-grid,
            .national-why-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 18px;
            }

            .national-primary-card,
            .national-why-card {
                padding: 25px;
                border: 1px solid #dfebf3;
                border-radius: 10px;
                background: #fff;
            }

            .national-primary-card > span,
            .national-why-card > span {
                display: grid;
                width: 44px;
                height: 44px;
                place-items: center;
                margin-bottom: 18px;
                border-radius: 7px;
                background: #e9f8fe;
                color: #06a3da;
                font-weight: 800;
            }

            .national-primary-card h3,
            .national-why-card h3,
            .national-process-card h3 {
                margin: 0 0 9px;
                color: #091e3e;
                font-size: 1.12rem;
            }

            .national-primary-card p,
            .national-why-card p,
            .national-process-card p {
                margin: 0;
                color: #626d7b;
                line-height: 1.62;
            }

            .national-compact-facts {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
                margin-top: 18px;
            }

            .national-compact-facts details {
                padding: 18px 20px;
                border: 1px solid #dfebf3;
                border-radius: 8px;
                background: #fff;
            }

            .national-compact-facts summary {
                color: #091e3e;
                font-weight: 800;
                cursor: pointer;
            }

            .national-compact-facts p {
                margin: 12px 0 0;
                color: #626d7b;
                line-height: 1.62;
            }

            .national-process-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
            }

            .national-process-card {
                padding: 28px;
                border-top: 3px solid #06a3da;
                border-radius: 8px;
                background: #fff;
                box-shadow: 0 14px 34px rgba(9, 30, 62, .07);
            }

            .national-process-card > span {
                display: block;
                margin-bottom: 14px;
                color: #06a3da;
                font-weight: 800;
            }

            .national-faq-list {
                display: grid;
                max-width: 900px;
                gap: 12px;
                margin-inline: auto;
            }

            .national-faq-item {
                overflow: hidden;
                border: 1px solid #dfeaf2;
                border-radius: 9px;
                background: #fff;
            }

            .national-faq-question {
                display: flex;
                width: 100%;
                min-height: 64px;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                padding: 18px 22px;
                border: 0;
                background: transparent;
                color: #091e3e;
                font: inherit;
                font-weight: 800;
                text-align: left;
                cursor: pointer;
            }

            .national-faq-question::after { content: "+"; color: #06a3da; font-size: 1.5rem; }
            .national-faq-question[aria-expanded="true"]::after { content: "−"; }

            .national-faq-answer {
                padding: 0 22px 20px;
                color: #626d7b;
                line-height: 1.7;
            }

            .national-faq-answer[hidden] { display: none; }

            .national-faq-question:focus-visible,
            .national-conversion-page .seo-service-button:focus-visible {
                outline: 3px solid rgba(6, 163, 218, .42);
                outline-offset: -3px;
            }

            .national-final-cta {
                padding: clamp(62px, 7vw, 84px) 0;
                background: #091e3e;
                color: #fff;
                text-align: center;
            }

            .national-final-cta h2 {
                max-width: 760px;
                margin: 0 auto 14px;
                color: #fff;
                font-size: clamp(30px, 3.2vw, 44px);
            }

            .national-final-cta p {
                max-width: 660px;
                margin: 0 auto 26px;
                color: rgba(255,255,255,.82);
                line-height: 1.7;
            }

            .national-conversion-page .jasaibnu-startup-footer {
                margin-top: 0 !important;
            }

            .national-conversion-page .jasaibnu-startup-footer .footer-about > div {
                padding-block: 28px !important;
            }

            .national-conversion-page .jasaibnu-startup-footer .pt-5 {
                padding-top: 2rem !important;
            }

            .national-conversion-page .jasaibnu-startup-footer .mb-5 {
                margin-bottom: 2rem !important;
            }

            .national-conversion-page .jasaibnu-startup-copyright > .container > .row > div > div {
                height: 58px !important;
            }

            @media (max-width: 991.98px) {
                .national-conversion-page .seo-service-hero-grid { grid-template-columns: 1fr; gap: 42px; }
                .national-conversion-page .seo-service-copy-block { margin-inline: auto; text-align: center; }
                .national-conversion-page .seo-service-hero h1,
                .national-conversion-page .seo-service-hero-copy { margin-inline: auto; }
                .national-conversion-page .seo-service-actions { justify-content: center; }
                .national-hero-visual { max-width: 620px; margin-inline: auto; }
                .national-trust-grid,
                .national-primary-grid,
                .national-why-grid { grid-template-columns: repeat(2, 1fr); }
                .national-trust-item:nth-child(3) { border-left: 0; }
                .national-trust-item:nth-child(n+3) { border-top: 1px solid #e3edf5; }
            }

            @media (max-width: 575.98px) {
                .national-conversion-page .seo-service-hero { padding: 46px 0 70px; }
                .national-hero-visual { padding: 10px 10px 18px; }
                .national-hero-projects { gap: 6px; padding: 10px; }
                .national-trust-strip { margin-top: -28px; }
                .national-trust-grid,
                .national-primary-grid,
                .national-why-grid,
                .national-process-grid,
                .national-compact-facts { grid-template-columns: 1fr; }
                .national-trust-item + .national-trust-item { border-top: 1px solid #e3edf5; border-left: 0; }
                .national-conversion-section { padding: 56px 0; }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const floatingWhatsapp = document.querySelector('.floating-whatsapp');
                const nationalWhatsappCta = document.querySelector('[data-national-whatsapp-cta]');

                if (floatingWhatsapp && nationalWhatsappCta) {
                    nationalWhatsappCta.href = floatingWhatsapp.href;
                    nationalWhatsappCta.target = '_blank';
                    nationalWhatsappCta.rel = 'noopener noreferrer';
                }

                document.querySelectorAll('[data-national-faq-button]').forEach((button) => {
                    button.addEventListener('click', () => {
                        const panel = document.getElementById(button.getAttribute('aria-controls'));
                        const expanded = button.getAttribute('aria-expanded') === 'true';
                        button.setAttribute('aria-expanded', String(!expanded));
                        panel.hidden = expanded;
                    });
                });
            });
        </script>
    @endif
@endpush

@section('content')
    <section class="seo-service-hero" aria-labelledby="website-service-title">
        <div class="seo-service-shell">
            <div class="seo-service-hero-grid">
                <div class="seo-service-copy-block">
                    <p class="seo-service-label">{{ $landing['label'] }}</p>
                    <h1 id="website-service-title">{{ $landing['h1'] }}</h1>
                    <p class="seo-service-hero-copy">{{ $landing['hero_copy'] }}</p>
                    <div class="seo-service-actions">
                        <a class="seo-service-button" href="{{ route('contact') }}">Konsultasi Website</a>
                        <a class="seo-service-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio</a>
                    </div>
                </div>
                @if ($isNationalLanding)
                    <div class="national-hero-visual" aria-label="Preview portfolio website JASAIBNU">
                        <div class="national-hero-browser">
                            <div class="national-hero-browser-bar" aria-hidden="true"><span></span><span></span><span></span></div>
                            <div class="national-hero-projects">
                                @foreach ($nationalPortfolioItems as $item)
                                    <div class="national-hero-project">
                                        @if ($item->imageUrl())
                                            <img src="{{ $item->imageUrl() }}" alt="{{ $item->title }}" width="240" height="180" decoding="async">
                                        @else
                                            <span aria-hidden="true">{{ $item->code ?: Illuminate\Support\Str::of($item->title)->substr(0, 3)->upper() }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if ($isNationalLanding)
        <div class="national-trust-strip" aria-label="Nilai utama layanan website">
            <div class="seo-service-shell national-trust-grid">
                <div class="national-trust-item">Kolaborasi seluruh Indonesia</div>
                <div class="national-trust-item">Tampilan responsive</div>
                <div class="national-trust-item">Fondasi SEO teknis</div>
                <div class="national-trust-item">Dukungan setelah go-live</div>
            </div>
        </div>
    @endif

    @if ($isNationalLanding)
        <section class="national-service-section" aria-labelledby="national-positioning-title">
            <div class="seo-service-shell">
                <div class="national-positioning-grid">
                    <div class="national-positioning-copy">
                        <p class="seo-service-label">Kolaborasi lintas wilayah</p>
                        <h2 id="national-positioning-title">Pembuatan website untuk bisnis di berbagai wilayah Indonesia.</h2>
                        <p>JASAIBNU dapat mendampingi bisnis dari berbagai wilayah melalui proses kolaborasi jarak jauh. Diskusi kebutuhan, penyiapan materi, peninjauan desain, pengembangan, dan koordinasi sebelum website online dapat dilakukan secara terstruktur tanpa harus berada di kota yang sama.</p>
                    </div>
                    <div class="national-collaboration-panel" aria-label="Tahapan kolaborasi jarak jauh">
                        <div class="national-collaboration-step">
                            <span aria-hidden="true">01</span>
                            <div><strong>Diskusi kebutuhan</strong><small>Tujuan, halaman, dan fitur dipetakan secara terstruktur.</small></div>
                        </div>
                        <div class="national-collaboration-step">
                            <span aria-hidden="true">02</span>
                            <div><strong>Penyiapan dan peninjauan</strong><small>Materi dan desain ditinjau selama proses pengembangan.</small></div>
                        </div>
                        <div class="national-collaboration-step">
                            <span aria-hidden="true">03</span>
                            <div><strong>Koordinasi sebelum online</strong><small>Testing dan persiapan go-live dikoordinasikan jarak jauh.</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="national-service-section alt" aria-labelledby="national-offer-title">
            <div class="seo-service-shell">
                <div class="seo-service-heading">
                    <p class="seo-service-label">Cakupan layanan</p>
                    <h2 id="national-offer-title">Scope website disusun mengikuti kebutuhan dan kesiapan bisnis.</h2>
                    <p>Setiap project dimulai dengan pemetaan tujuan, halaman, materi, fitur, dan kebutuhan pengelolaan agar solusi yang dibangun tetap relevan dan dapat dikembangkan.</p>
                </div>
                <div class="national-primary-grid">
                    <article class="national-primary-card">
                        <span aria-hidden="true">CP</span>
                        <h3>Company profile &amp; landing page</h3>
                        <p>Website profil perusahaan untuk menampilkan layanan, legalitas, portfolio, kontak, dan kredibilitas bisnis.</p>
                        <p>Halaman khusus untuk campaign, iklan, launching produk, pendaftaran, atau penawaran jasa tertentu.</p>
                    </article>
                    <article class="national-primary-card">
                        <span aria-hidden="true">CAT</span>
                        <h3>Website bisnis &amp; katalog</h3>
                        <p>Website untuk bisnis lokal agar calon pelanggan lebih mudah melihat layanan, harga awal, lokasi, dan kontak.</p>
                        <p>Website katalog untuk menampilkan produk, kategori, detail, dan jalur pemesanan melalui WhatsApp atau form.</p>
                    </article>
                    <article class="national-primary-card">
                        <span aria-hidden="true">CMS</span>
                        <h3>Website dengan admin panel</h3>
                        <p>Konten website dapat dikelola sendiri, seperti artikel, portfolio, layanan, halaman, dan pengaturan umum.</p>
                    </article>
                    <article class="national-primary-card">
                        <span aria-hidden="true">APP</span>
                        <h3>Custom web &amp; aplikasi</h3>
                        <p>Fondasi website bisa dikembangkan menjadi sistem booking, dashboard, member area, atau aplikasi bisnis.</p>
                    </article>
                </div>
                <div class="national-compact-facts">
                    <details>
                        <summary>Jenis website</summary>
                        <p>Company profile, landing page, website layanan, katalog, website dengan admin panel, dan fondasi aplikasi web dapat disusun sesuai tujuan bisnis.</p>
                    </details>
                    <details>
                        <summary>Deliverables utama</summary>
                        <p>Struktur halaman, tampilan responsive, jalur kontak, keamanan dasar, dan fondasi SEO teknis disiapkan sesuai scope yang disepakati.</p>
                    </details>
                    <details>
                        <summary>Alur pengembangan</summary>
                        <p>Proses mencakup analisis kebutuhan, penyusunan struktur, desain dan development, testing, serta persiapan go-live.</p>
                    </details>
                    <details>
                        <summary>Faktor timeline</summary>
                        <p>Durasi dipengaruhi jumlah halaman, kesiapan materi, kompleksitas fitur, kebutuhan integrasi, dan kecepatan proses peninjauan.</p>
                    </details>
                    <details>
                        <summary>Pengelolaan dan handover</summary>
                        <p>Akses pengelolaan dapat disiapkan saat project menggunakan admin panel. Kebutuhan pengembangan dan dukungan setelah go-live dibahas mengikuti scope project.</p>
                    </details>
                </div>
            </div>
        </section>

        @if ($nationalPortfolioItems->isNotEmpty())
            <section class="national-service-section" aria-labelledby="national-proof-title">
                <div class="seo-service-shell">
                    <div class="seo-service-heading">
                        <p class="seo-service-label">Portfolio terpublikasi</p>
                        <h2 id="national-proof-title">Contoh solusi digital yang telah dipublikasikan JASAIBNU.</h2>
                        <p>Contoh berikut diambil langsung dari portfolio terpublikasi dan menunjukkan cakupan website serta sistem digital yang tersedia.</p>
                    </div>
                    <div class="national-proof-grid">
                        @foreach ($nationalPortfolioItems as $item)
                            <article class="national-proof-card">
                                <div class="national-proof-media">
                                    @if ($item->imageUrl())
                                        <img src="{{ $item->imageUrl() }}" alt="{{ $item->title }}" width="500" height="350" loading="lazy" decoding="async">
                                    @else
                                        <span class="national-proof-fallback" aria-hidden="true">{{ $item->code ?: Illuminate\Support\Str::of($item->title)->substr(0, 3)->upper() }}</span>
                                    @endif
                                </div>
                                <div class="national-proof-body">
                                    <span class="national-proof-category">{{ $item->categoryName() }}</span>
                                    <h3>{{ $item->title }}</h3>
                                    <p class="national-proof-excerpt">{{ $item->excerpt ?: $item->description }}</p>
                                    @if ($item->technologyList())
                                        <div class="national-proof-tags" aria-label="Teknologi {{ $item->title }}">
                                            @foreach ($item->technologyList() as $technology)
                                                <span>{{ $technology }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($item->project_url)
                                        <a class="national-proof-link" href="{{ $item->project_url }}" target="_blank" rel="noopener noreferrer">Lihat project</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <p class="national-proof-more"><a href="{{ route('portfolio.index') }}">Lihat portfolio JASAIBNU selengkapnya</a></p>
                </div>
            </section>
        @endif
    @endif

    @if ($isNationalLanding)
        <section class="national-conversion-section alt" aria-labelledby="website-benefits-title">
            <div class="seo-service-shell">
                <div class="national-conversion-heading">
                    <p class="seo-service-label">Kenapa JASAIBNU</p>
                    <h2 id="website-benefits-title">Website bukan hanya tampil online, tapi harus membantu bisnis dipercaya dan ditemukan.</h2>
                    <p>Kami membangun website dengan pendekatan teknis yang rapi: desain responsive, performa cepat, struktur konten jelas, keamanan dasar, dan fondasi SEO agar lebih siap masuk pencarian Google.</p>
                    <h3>{{ $landing['impact_title'] }}</h3>
                    <p>{{ $landing['impact_copy'] }}</p>
                </div>
                <div class="national-why-grid">
                    <article class="national-why-card">
                        <span aria-hidden="true">01</span>
                        <h3>Responsive dan cepat</h3>
                        <p>Website disiapkan agar nyaman dibuka di mobile maupun desktop, dengan optimasi gambar dan struktur halaman yang ringan.</p>
                    </article>
                    <article class="national-why-card">
                        <span aria-hidden="true">SEO</span>
                        <h3>Siap SEO teknis</h3>
                        <p>Title, meta description, canonical, sitemap, robots, dan struktur heading dibuat agar Google lebih mudah memahami halaman.</p>
                    </article>
                    <article class="national-why-card">
                        <span aria-hidden="true">SSL</span>
                        <h3>Keamanan dasar</h3>
                        <p>Form, route, validasi input, dan konfigurasi HTTPS disiapkan agar website lebih aman digunakan.</p>
                    </article>
                    <article class="national-why-card">
                        <span aria-hidden="true">CMS</span>
                        <h3>Mudah dikelola dan dikembangkan</h3>
                        <p>Website bisa dilengkapi admin panel untuk mengubah konten, portfolio, artikel, layanan, dan pengaturan bisnis.</p>
                    </article>
                </div>
                <div class="national-compact-facts">
                    <details>
                        <summary>Manfaat website untuk bisnis</summary>
                        <p><strong>Meningkatkan penjualan.</strong> Calon pelanggan bisa menemukan layanan, memahami penawaran, dan langsung menghubungi bisnis.</p>
                        <p><strong>Membangun branding.</strong> Tampilan, pesan, portfolio, dan identitas bisnis tersusun konsisten dalam satu tempat.</p>
                        <p><strong>Menambah kepercayaan.</strong> Bisnis terlihat lebih serius dengan profil, alamat, kontak, testimoni, dan bukti pekerjaan.</p>
                        <p><strong>Siap dipromosikan.</strong> Website bisa jadi tujuan iklan, Google Search, media sosial, WhatsApp, dan campaign digital.</p>
                    </details>
                    <details>
                        <summary>Fondasi website yang baik</summary>
                        <p>Gambar, struktur asset, dan layout dibuat ringan agar website cepat dibuka di mobile maupun desktop.</p>
                        <p>Tampilan diprioritaskan nyaman dibaca, diklik, dan dipahami dari layar HP yang paling sering dipakai pelanggan.</p>
                        <p>Fondasi website dapat dilanjutkan menjadi katalog, booking, dashboard internal, SaaS, atau integrasi AI.</p>
                    </details>
                </div>
            </div>
        </section>

        <section class="national-conversion-section" aria-labelledby="website-process-title">
            <div class="seo-service-shell">
                <div class="national-conversion-heading">
                    <p class="seo-service-label">Proses kerja</p>
                    <h2 id="website-process-title">Alur pembuatan website yang jelas dari awal sampai online.</h2>
                </div>
                <div class="national-process-grid">
                    <article class="national-process-card">
                        <span>01 — Konsultasi &amp; analisis</span>
                        <h3>Analisis kebutuhan</h3>
                        <p>Kami petakan tujuan website, target pengguna, halaman penting, fitur, dan arah konten yang dibutuhkan.</p>
                    </article>
                    <article class="national-process-card">
                        <span>02 — Desain &amp; development</span>
                        <h3>Desain dan development</h3>
                        <p>Website dibangun dengan tampilan profesional, struktur teknis rapi, dan pengalaman pengguna yang mudah dipahami.</p>
                    </article>
                    <article class="national-process-card">
                        <span>03 — Testing &amp; launch</span>
                        <h3>Testing dan go-live</h3>
                        <p>Sebelum online, halaman dicek dari sisi performa, mobile view, form kontak, SEO dasar, dan kesiapan indexing.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="national-conversion-section alt" aria-labelledby="website-faq-title">
            <div class="seo-service-shell">
                <div class="national-conversion-heading">
                    <p class="seo-service-label">FAQ</p>
                    <h2 id="website-faq-title">Pertanyaan umum tentang jasa pembuatan website.</h2>
                </div>
                @php
                    $nationalFaqs = [
                        ['Berapa lama pembuatan website?', 'Durasi bergantung pada jumlah halaman dan fitur. Website company profile sederhana biasanya bisa dimulai dari kebutuhan konten dan desain yang sudah jelas.'],
                        ['Apakah website sudah SEO?', 'Kami menyiapkan fondasi SEO teknis seperti title, meta description, struktur heading, sitemap, canonical, dan performa halaman. Ranking Google tetap membutuhkan waktu, konten, dan authority.'],
                        ['Bisa dibuat dengan admin panel?', 'Bisa. Website dapat dibuat dengan CMS/admin panel agar konten seperti portfolio, artikel, layanan, atau pengaturan website bisa dikelola sendiri.'],
                        ['Bisa lanjut ke aplikasi web?', 'Bisa. Jika kebutuhan berkembang, website dapat dilanjutkan menjadi sistem bisnis, dashboard internal, SaaS, atau integrasi AI.'],
                        ['Apakah harga website sudah termasuk domain dan hosting?', 'Bisa disesuaikan. Kami dapat membantu menyiapkan domain, hosting, SSL, email bisnis, dan konfigurasi dasar sesuai kebutuhan project.'],
                        ['Apakah website bisa dipakai untuk iklan dan promosi?', 'Bisa. Website dapat disiapkan sebagai tujuan iklan Google, media sosial, WhatsApp campaign, atau landing page penawaran agar promosi lebih terukur.'],
                        ['Apakah ada revisi desain?', 'Ada. Revisi mengikuti scope yang disepakati di awal, agar desain, konten, dan fitur tetap terarah sampai website siap online.'],
                        ['Apakah bisa dibantu isi konten website?', 'Bisa. Kami dapat membantu menyusun struktur halaman dan copy awal seperti profil bisnis, layanan, keunggulan, CTA, dan FAQ.'],
                    ];
                @endphp
                <div class="national-faq-list">
                    @foreach ($nationalFaqs as $index => [$question, $answer])
                        <article class="national-faq-item">
                            <h3>
                                <button class="national-faq-question" type="button" data-national-faq-button aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="national-faq-answer-{{ $index }}">
                                    {{ $question }}
                                </button>
                            </h3>
                            <div class="national-faq-answer" id="national-faq-answer-{{ $index }}" @if ($index !== 0) hidden @endif>
                                <p>{{ $answer }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="national-final-cta" aria-labelledby="website-cta-title">
            <div class="seo-service-shell">
                <h2 id="website-cta-title">Butuh jasa pembuatan website untuk bisnis Anda?</h2>
                <p>Ceritakan kebutuhan website, target bisnis, dan fitur yang ingin dibangun. JASAIBNU akan membantu memetakan solusi yang realistis sebelum masuk tahap produksi.</p>
                <a class="seo-service-button" href="{{ route('contact') }}" data-national-whatsapp-cta>Konsultasi via WhatsApp</a>
            </div>
        </section>
    @else
    <section class="seo-service-impact" aria-labelledby="website-impact-title">
        <div class="seo-service-shell">
            <div class="seo-service-impact-grid">
                <div class="seo-service-impact-media">
                    <picture>
                        <source media="(max-width: 575.98px)" srcset="{{ asset('assets/startup2/img/optimized/feature-mobile.webp') }}" type="image/webp">
                        <source srcset="{{ asset('assets/startup2/img/optimized/feature-desktop.webp') }}" type="image/webp">
                        <img src="{{ asset('assets/startup2/img/feature.jpg') }}" alt="Website membantu bisnis membangun penjualan dan branding digital" width="720" height="720" loading="lazy" decoding="async">
                    </picture>
                    <div class="seo-service-impact-badge">{{ $landing['badge'] }}</div>
                </div>
                <div class="seo-service-impact-copy">
                    <p class="seo-service-label">{{ $landing['impact_label'] }}</p>
                    <h2 id="website-impact-title">{{ $landing['impact_title'] }}</h2>
                    <p>{{ $landing['impact_copy'] }}</p>
                    @if ($primarySerangLink)
                        <p>{{ $primarySerangLink['before'] }}<a href="{{ route('website-development-serang') }}">{{ $primarySerangLink['anchor'] }}</a>{{ $primarySerangLink['after'] }}</p>
                    @endif
                    <div class="seo-service-impact-points">
                        <div class="seo-service-impact-point">
                            <span class="seo-service-impact-icon" aria-hidden="true">01</span>
                            <strong>Meningkatkan penjualan</strong>
                            <span>Calon pelanggan bisa menemukan layanan, memahami penawaran, dan langsung menghubungi bisnis.</span>
                        </div>
                        <div class="seo-service-impact-point">
                            <span class="seo-service-impact-icon" aria-hidden="true">BR</span>
                            <strong>Membangun branding</strong>
                            <span>Tampilan, pesan, portfolio, dan identitas bisnis tersusun konsisten dalam satu tempat.</span>
                        </div>
                        <div class="seo-service-impact-point">
                            <span class="seo-service-impact-icon" aria-hidden="true">TR</span>
                            <strong>Menambah kepercayaan</strong>
                            <span>Bisnis terlihat lebih serius dengan profil, alamat, kontak, testimoni, dan bukti pekerjaan.</span>
                        </div>
                        <div class="seo-service-impact-point">
                            <span class="seo-service-impact-icon" aria-hidden="true">ADS</span>
                            <strong>Siap dipromosikan</strong>
                            <span>Website bisa jadi tujuan iklan, Google Search, media sosial, WhatsApp, dan campaign digital.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="seo-service-advantage" aria-labelledby="website-advantage-title">
        <div class="seo-service-shell">
            <div class="seo-service-heading">
                <p class="seo-service-label">Fondasi website yang baik</p>
                <h2 id="website-advantage-title">Keunggulan penting yang kami siapkan sejak awal.</h2>
            </div>
            <div class="seo-service-advantage-grid">
                <article class="seo-service-advantage-card">
                    <span class="seo-service-advantage-icon" aria-hidden="true">01</span>
                    <h2>Kecepatan halaman</h2>
                    <p>Gambar, struktur asset, dan layout dibuat ringan agar website cepat dibuka di mobile maupun desktop.</p>
                </article>
                <article class="seo-service-advantage-card">
                    <span class="seo-service-advantage-icon" aria-hidden="true">SEO</span>
                    <h2>Siap ditemukan Google</h2>
                    <p>Title, meta description, heading, canonical, sitemap, dan schema dasar disusun rapi untuk indexing.</p>
                </article>
                <article class="seo-service-advantage-card">
                    <span class="seo-service-advantage-icon" aria-hidden="true">M</span>
                    <h2>Mobile-friendly</h2>
                    <p>Tampilan diprioritaskan nyaman dibaca, diklik, dan dipahami dari layar HP yang paling sering dipakai pelanggan.</p>
                </article>
                <article class="seo-service-advantage-card">
                    <span class="seo-service-advantage-icon" aria-hidden="true">SSL</span>
                    <h2>Keamanan dasar</h2>
                    <p>Form, route, validasi input, dan konfigurasi HTTPS disiapkan agar website lebih aman digunakan.</p>
                </article>
                <article class="seo-service-advantage-card">
                    <span class="seo-service-advantage-icon" aria-hidden="true">CMS</span>
                    <h2>Mudah dikelola</h2>
                    <p>Website bisa dilengkapi admin panel untuk mengubah konten, portfolio, artikel, layanan, dan pengaturan bisnis.</p>
                </article>
                <article class="seo-service-advantage-card">
                    <span class="seo-service-advantage-icon" aria-hidden="true">06</span>
                    <h2>Siap dikembangkan</h2>
                    <p>Fondasi website dapat dilanjutkan menjadi katalog, booking, dashboard internal, SaaS, atau integrasi AI.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="seo-service-section" aria-labelledby="website-benefits-title">
        <div class="seo-service-shell">
            <div class="seo-service-heading">
                <p class="seo-service-label">Kenapa JASAIBNU</p>
                <h2 id="website-benefits-title">Website bukan hanya tampil online, tapi harus membantu bisnis dipercaya dan ditemukan.</h2>
                <p>Kami membangun website dengan pendekatan teknis yang rapi: desain responsive, performa cepat, struktur konten jelas, keamanan dasar, dan fondasi SEO agar lebih siap masuk pencarian Google.</p>
            </div>
            <div class="seo-service-card-grid">
                <article class="seo-service-card">
                    <strong>01</strong>
                    <h3>Responsive dan cepat</h3>
                    <p>Website disiapkan agar nyaman dibuka di mobile maupun desktop, dengan optimasi gambar dan struktur halaman yang ringan.</p>
                </article>
                <article class="seo-service-card">
                    <strong>02</strong>
                    <h3>Siap SEO teknis</h3>
                    <p>Title, meta description, canonical, sitemap, robots, dan struktur heading dibuat agar Google lebih mudah memahami halaman.</p>
                </article>
                <article class="seo-service-card">
                    <strong>03</strong>
                    <h3>Mudah dikembangkan</h3>
                    <p>Website dapat dikembangkan menjadi katalog, blog, sistem booking, dashboard admin, atau aplikasi web sesuai kebutuhan bisnis.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="seo-service-section alt" aria-labelledby="website-types-title">
        <div class="seo-service-shell">
            <div class="seo-service-heading">
                <p class="seo-service-label">Jenis website</p>
                <h2 id="website-types-title">Website yang bisa dibuat sesuai kebutuhan bisnis Anda.</h2>
                <p>Dari halaman profil sederhana sampai website dengan pengelolaan konten, JASAIBNU membantu memilih bentuk website yang paling realistis untuk target bisnis dan budget.</p>
            </div>
            <div class="seo-service-type-grid">
                <article class="seo-service-type-card">
                    <span aria-hidden="true">CP</span>
                    <h2>Company profile</h2>
                    <p>Website profil perusahaan untuk menampilkan layanan, legalitas, portfolio, kontak, dan kredibilitas bisnis.</p>
                </article>
                <article class="seo-service-type-card">
                    <span aria-hidden="true">LP</span>
                    <h2>Landing page promosi</h2>
                    <p>Halaman khusus untuk campaign, iklan, launching produk, pendaftaran, atau penawaran jasa tertentu.</p>
                </article>
                <article class="seo-service-type-card">
                    <span aria-hidden="true">UMK</span>
                    <h2>Website UMKM dan jasa</h2>
                    <p>Website untuk bisnis lokal agar calon pelanggan lebih mudah melihat layanan, harga awal, lokasi, dan kontak.</p>
                </article>
                <article class="seo-service-type-card">
                    <span aria-hidden="true">CAT</span>
                    <h2>Katalog produk</h2>
                    <p>Website katalog untuk menampilkan produk, kategori, detail, dan jalur pemesanan melalui WhatsApp atau form.</p>
                </article>
                <article class="seo-service-type-card">
                    <span aria-hidden="true">CMS</span>
                    <h2>Website dengan admin panel</h2>
                    <p>Konten website dapat dikelola sendiri, seperti artikel, portfolio, layanan, halaman, dan pengaturan umum.</p>
                </article>
                <article class="seo-service-type-card">
                    <span aria-hidden="true">APP</span>
                    <h2>Website menuju aplikasi web</h2>
                    <p>Fondasi website bisa dikembangkan menjadi sistem booking, dashboard, member area, atau aplikasi bisnis.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="seo-service-mid-cta" aria-labelledby="website-mid-cta-title">
        <div class="seo-service-shell">
            <div class="seo-service-mid-cta-row">
                <div>
                    <h2 id="website-mid-cta-title">Ingin website bisnis yang siap dipakai untuk branding dan penjualan?</h2>
                    <p>Kirim kebutuhan singkat Anda. Kami bantu petakan halaman, fitur, dan prioritas yang paling penting dulu.</p>
                </div>
                <a class="seo-service-button" href="{{ route('contact') }}">Diskusi Sekarang</a>
            </div>
        </div>
    </section>

    <section class="seo-service-section" aria-labelledby="website-process-title">
        <div class="seo-service-shell">
            <div class="seo-service-heading">
                <p class="seo-service-label">Proses kerja</p>
                <h2 id="website-process-title">Alur pembuatan website yang jelas dari awal sampai online.</h2>
            </div>
            <div class="seo-service-card-grid">
                <article class="seo-service-card">
                    <strong>01</strong>
                    <h3>Analisis kebutuhan</h3>
                    <p>Kami petakan tujuan website, target pengguna, halaman penting, fitur, dan arah konten yang dibutuhkan.</p>
                </article>
                <article class="seo-service-card">
                    <strong>02</strong>
                    <h3>Desain dan development</h3>
                    <p>Website dibangun dengan tampilan profesional, struktur teknis rapi, dan pengalaman pengguna yang mudah dipahami.</p>
                </article>
                <article class="seo-service-card">
                    <strong>03</strong>
                    <h3>Testing dan go-live</h3>
                    <p>Sebelum online, halaman dicek dari sisi performa, mobile view, form kontak, SEO dasar, dan kesiapan indexing.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="seo-service-section" aria-labelledby="website-faq-title">
        <div class="seo-service-shell">
            <div class="seo-service-heading">
                <p class="seo-service-label">FAQ</p>
                <h2 id="website-faq-title">Pertanyaan umum tentang jasa pembuatan website.</h2>
            </div>
            <div class="seo-service-faq-grid">
                <article class="seo-service-faq">
                    <h3>Berapa lama pembuatan website?</h3>
                    <p>Durasi bergantung pada jumlah halaman dan fitur. Website company profile sederhana biasanya bisa dimulai dari kebutuhan konten dan desain yang sudah jelas.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Apakah website sudah SEO?</h3>
                    <p>Kami menyiapkan fondasi SEO teknis seperti title, meta description, struktur heading, sitemap, canonical, dan performa halaman. Ranking Google tetap membutuhkan waktu, konten, dan authority.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Bisa dibuat dengan admin panel?</h3>
                    <p>Bisa. Website dapat dibuat dengan CMS/admin panel agar konten seperti portfolio, artikel, layanan, atau pengaturan website bisa dikelola sendiri.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Bisa lanjut ke aplikasi web?</h3>
                    <p>Bisa. Jika kebutuhan berkembang, website dapat dilanjutkan menjadi sistem bisnis, dashboard internal, SaaS, atau integrasi AI.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Apakah harga website sudah termasuk domain dan hosting?</h3>
                    <p>Bisa disesuaikan. Kami dapat membantu menyiapkan domain, hosting, SSL, email bisnis, dan konfigurasi dasar sesuai kebutuhan project.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Apakah website bisa dipakai untuk iklan dan promosi?</h3>
                    <p>Bisa. Website dapat disiapkan sebagai tujuan iklan Google, media sosial, WhatsApp campaign, atau landing page penawaran agar promosi lebih terukur.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Apakah ada revisi desain?</h3>
                    <p>Ada. Revisi mengikuti scope yang disepakati di awal, agar desain, konten, dan fitur tetap terarah sampai website siap online.</p>
                </article>
                <article class="seo-service-faq">
                    <h3>Apakah bisa dibantu isi konten website?</h3>
                    <p>Bisa. Kami dapat membantu menyusun struktur halaman dan copy awal seperti profil bisnis, layanan, keunggulan, CTA, dan FAQ.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="seo-service-cta" aria-labelledby="website-cta-title">
        <div class="seo-service-shell">
            <h2 id="website-cta-title">Butuh jasa pembuatan website untuk bisnis Anda?</h2>
            <p>Ceritakan kebutuhan website, target bisnis, dan fitur yang ingin dibangun. JASAIBNU akan membantu memetakan solusi yang realistis sebelum masuk tahap produksi.</p>
            <a class="seo-service-button" href="{{ route('contact') }}">Mulai Konsultasi</a>
        </div>
    </section>
    @endif
@endsection
