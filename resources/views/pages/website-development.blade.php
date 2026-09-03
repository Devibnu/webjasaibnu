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
    $isBantenLanding = request()->routeIs('website-development-banten');
    $isSerangMurahLanding = request()->routeIs('website-development-serang-murah');
    $isConversionLanding = $isNationalLanding || $isBantenLanding;
    $nationalPortfolioItems = $nationalPortfolioItems ?? collect();
    $conversionPortfolioItems = $isBantenLanding
        ? \App\Models\PortfolioItem::with('category')->published()->ordered()->limit(3)->get()
        : $nationalPortfolioItems;
@endphp

@section('title', $landing['title'])
@section('meta_description', $landing['meta_description'])
@section('canonical', $landing['canonical'])
@section('body_class', 'services-page startup2-home' . ($isNationalLanding ? ' national-conversion-page' : '') . ($isBantenLanding ? ' banten-conversion-page' : '') . ($isSerangMurahLanding ? ' serang-murah-simple-page' : ''))

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
    @if ($isConversionLanding || $isSerangMurahLanding)
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

            /* UIUX-NASIONAL-002A: locked, compact national composition. */
            .national-conversion-page .seo-service-hero {
                min-height: 590px;
                padding: 62px 0 82px;
            }

            .national-conversion-page .sticky-top { position: static !important; }

            .national-conversion-page .seo-service-hero-grid {
                grid-template-columns: minmax(0, .94fr) minmax(500px, 1.06fr);
                gap: 54px;
            }

            .national-conversion-page .seo-service-hero h1 {
                font-size: clamp(40px, 3.45vw, 54px);
            }

            .national-hero-visual {
                position: relative;
                min-height: 390px;
                padding: 0;
                border: 0;
                background: transparent;
                box-shadow: none;
            }

            .national-hero-browser {
                position: absolute;
                top: 10px;
                left: 0;
                width: 88%;
                overflow: visible;
                border: 7px solid #dbe6ed;
                border-bottom-width: 18px;
                border-radius: 12px;
                box-shadow: 0 30px 60px rgba(0, 0, 0, .32);
            }

            .national-hero-browser::after {
                content: "";
                position: absolute;
                left: 42%;
                bottom: -54px;
                width: 16%;
                height: 38px;
                border-bottom: 8px solid #aebec9;
                background: #cbd8e0;
            }

            .national-hero-projects { display: block; padding: 0; }
            .national-hero-project { display: none; border: 0; border-radius: 0; }
            .national-hero-project:first-child { display: block; }
            .national-hero-project:first-child img { width: 100%; height: 300px; aspect-ratio: auto; object-fit: cover; object-position: top; }
            .national-hero-project:first-child span { min-height: 300px; font-size: 3rem; }
            .national-hero-project:nth-child(2) {
                position: absolute;
                right: -13%;
                bottom: -42px;
                z-index: 2;
                display: block;
                width: 38%;
                overflow: hidden;
                border: 7px solid #dbe6ed;
                border-radius: 13px;
                box-shadow: 0 24px 46px rgba(0, 0, 0, .32);
            }
            .national-hero-project:nth-child(2) img { height: 218px; aspect-ratio: auto; object-position: top; }
            .national-hero-project:nth-child(2) span { min-height: 218px; }

            .national-service-section,
            .national-conversion-section { padding: 68px 0; }
            .national-service-section.alt { background: #fff; }
            .seo-service-heading,
            .national-conversion-heading { max-width: 720px; margin: 0 auto 30px; text-align: center; }
            .seo-service-heading h2,
            .national-conversion-heading h2 { font-size: clamp(28px, 2.55vw, 38px); }
            .national-primary-grid { gap: 18px; }
            .national-primary-card { min-height: 260px; padding: 28px 22px; text-align: center; }
            .national-primary-card > span,
            .national-why-card > span {
                width: 62px;
                height: 62px;
                margin: 0 auto 18px;
                border: 2px solid #06a3da;
                border-radius: 50%;
                background: transparent;
                font-size: .76rem;
            }
            .national-primary-card p + p { margin-top: 8px; }
            .national-compact-facts { grid-template-columns: repeat(3, minmax(0, 1fr)); margin-top: 22px; }
            .national-proof-grid { gap: 22px; }
            .national-proof-media,
            .national-proof-media img { height: 245px; min-height: 245px; }
            .national-proof-media img { object-position: top; }
            .national-proof-body { padding: 24px; }
            .national-proof-excerpt { display: -webkit-box; overflow: hidden; -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
            .national-conversion-section.alt { background: #f7fbfe; }
            .national-why-card { min-height: 0; padding: 8px 18px 0; border: 0; background: transparent; box-shadow: none; text-align: center; }
            .national-process-grid { position: relative; gap: 42px; }
            .national-process-grid::before { content: ""; position: absolute; top: 34px; left: 16%; right: 16%; border-top: 2px dashed #9bd5ec; }
            .national-process-card { position: relative; padding: 0 20px; border: 0; background: transparent; text-align: center; }
            .national-process-card { box-shadow: none; }
            .national-process-card > span { display: grid; width: 68px; height: 68px; margin: 0 auto 20px; place-items: center; overflow: hidden; border-radius: 50%; background: #06a3da; color: #fff; font-size: 0; }
            .national-process-card > span::first-letter { font-size: 0; }
            .national-process-card:nth-child(1) > span::after { content: "01"; font-size: 1rem; }
            .national-process-card:nth-child(2) > span::after { content: "02"; font-size: 1rem; }
            .national-process-card:nth-child(3) > span::after { content: "03"; font-size: 1rem; }
            .national-faq-list { grid-template-columns: repeat(2, minmax(0, 1fr)); max-width: none; align-items: start; }
            .national-final-cta { padding: 52px 0; text-align: left; }
            .national-final-cta .seo-service-shell { display: flex; align-items: center; justify-content: space-between; gap: 48px; }
            .national-final-cta-copy { max-width: 720px; }
            .national-final-cta h2,
            .national-final-cta p { margin-left: 0; margin-right: 0; }
            .national-final-cta p { margin-bottom: 0; }
            .national-final-cta .seo-service-button { flex: 0 0 auto; min-height: 58px; padding-inline: 28px; background: #fff; border-color: #fff; color: #091e3e; box-shadow: none; }

            @media (max-width: 991.98px) {
                .national-conversion-page .seo-service-hero-grid { grid-template-columns: 1fr; }
                .national-hero-visual { width: min(100%, 590px); min-height: 385px; }
                .national-faq-list { grid-template-columns: 1fr; max-width: 760px; }
                .national-compact-facts { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .national-final-cta .seo-service-shell { align-items: flex-start; flex-direction: column; gap: 24px; }
            }

            @media (max-width: 575.98px) {
                .national-conversion-page .seo-service-hero { padding: 44px 0 62px; }
                .national-conversion-page .seo-service-hero h1 { font-size: clamp(34px, 10.4vw, 43px); }
                .national-hero-visual { min-height: 270px; }
                .national-hero-browser { width: 91%; border-width: 5px; border-bottom-width: 13px; }
                .national-hero-browser::after { bottom: -38px; height: 26px; border-bottom-width: 6px; }
                .national-hero-project:first-child img,
                .national-hero-project:first-child span { height: 205px; min-height: 205px; }
                .national-hero-project:nth-child(2) { right: -6%; bottom: -30px; width: 36%; border-width: 5px; }
                .national-hero-project:nth-child(2) img,
                .national-hero-project:nth-child(2) span { height: 145px; min-height: 145px; }
                .national-service-section,
                .national-conversion-section { padding: 52px 0; }
                .national-primary-card { min-height: 0; }
                .national-compact-facts { grid-template-columns: 1fr; }
                .national-proof-media,
                .national-proof-media img { height: 210px; min-height: 210px; }
                .national-process-grid { gap: 34px; }
                .national-process-grid::before { display: none; }
                .national-trust-item { padding: 15px 12px; }
            }

            /* UIUX-NASIONAL-002B: pixel-direction locked reference. */
            .national-conversion-page {
                background: #fff;
                color: #0b2147;
            }

            .national-conversion-page .startup-inner-shell .navbar { background: #fff !important; }
            .national-conversion-page .startup-inner-shell .ji-header-logo-public { visibility: hidden; opacity: 0; }
            .national-conversion-page .startup-inner-shell .ji-header-logo-dark { visibility: visible; opacity: 1; }
            .national-conversion-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link { color: #17253a !important; }
            .national-conversion-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link:hover,
            .national-conversion-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link.active { color: #087cf0 !important; }

            .national-conversion-page .seo-service-shell {
                width: min(100% - 40px, 1180px);
            }

            .national-conversion-page .seo-service-hero {
                min-height: 560px;
                padding: 66px 0 76px;
                overflow: visible;
                background: #fff;
                color: #0b2147;
            }

            .national-conversion-page .seo-service-hero::before {
                inset: 22px 0 auto auto;
                width: 58%;
                height: 510px;
                border-radius: 54% 0 0 54%;
                background: radial-gradient(circle at 55% 46%, #dff3ff 0, #eef9ff 58%, rgba(255,255,255,0) 72%);
            }

            .national-conversion-page .seo-service-hero::after { display: none; }

            .national-conversion-page .seo-service-hero-grid {
                grid-template-columns: minmax(0, .88fr) minmax(540px, 1.12fr);
                gap: 54px;
            }

            .national-conversion-page .seo-service-copy-block { max-width: 520px; }
            .national-conversion-page .seo-service-label { margin-bottom: 12px; background: #edf8ff; color: #0879ee; }
            .national-conversion-page .seo-service-hero h1 {
                max-width: 520px;
                margin-bottom: 18px;
                color: #0b2147;
                font-size: clamp(38px, 3.25vw, 50px);
                line-height: 1.08;
            }
            .national-conversion-page .seo-service-hero-copy { max-width: 510px; margin-bottom: 24px; color: #526175; line-height: 1.65; }
            .national-conversion-page .seo-service-button { border-color: #087cf0; border-radius: 5px; background: #087cf0; box-shadow: 0 10px 24px rgba(8,124,240,.18); }
            .national-conversion-page .seo-service-button.secondary { border-color: #087cf0; background: #fff; color: #087cf0; box-shadow: none; }

            .national-hero-visual { min-height: 385px; }
            .national-hero-browser {
                top: 18px;
                left: 2%;
                width: 88%;
                border: 0;
                border-bottom: 14px solid #b8c0c8;
                border-radius: 10px;
                background: #fff;
                box-shadow: 0 24px 50px rgba(17,42,77,.2);
                transform: perspective(900px) rotateY(-4deg);
            }
            .national-hero-browser::after { bottom: -44px; height: 30px; border-color: #9ba7b2; background: #c6cdd3; }
            .national-hero-browser-bar { padding: 9px 12px; background: #f3f7fa; }
            .national-hero-project:first-child img { height: 310px; object-fit: cover; object-position: center; }
            .national-hero-project:nth-child(2) {
                right: -10%;
                bottom: -48px;
                width: 34%;
                border: 7px solid #26313c;
                border-radius: 13px;
                background: #fff;
            }
            .national-hero-project:nth-child(2) img { height: 210px; object-fit: cover; object-position: 62% center; }

            .national-trust-strip { margin-top: -42px; }
            .national-trust-grid { border: 0; border-radius: 5px; box-shadow: 0 8px 28px rgba(23,54,87,.11); }
            .national-trust-item { padding: 17px 12px; color: #40516a; font-size: .82rem; font-weight: 600; }
            .national-trust-item::before { content: "◇"; margin-right: 8px; color: #087cf0; font-size: 1rem; }

            .national-service-section,
            .national-conversion-section { padding: 48px 0; }
            .national-service-section.alt { background: #fff; }
            .seo-service-heading,
            .national-conversion-heading { max-width: 690px; margin-bottom: 24px; }
            .seo-service-heading h2,
            .national-conversion-heading h2 { font-size: clamp(26px, 2.15vw, 34px); line-height: 1.2; }
            .seo-service-heading > p:last-child,
            .national-conversion-heading > p:last-child { margin-top: 7px; line-height: 1.5; }

            .national-primary-grid { gap: 14px; }
            .national-primary-card {
                min-height: 245px;
                padding: 30px 22px 24px;
                border-color: #e8edf3;
                border-radius: 5px;
                box-shadow: 0 8px 24px rgba(31,57,83,.06);
            }
            .national-primary-card > span,
            .national-why-card > span {
                width: auto;
                height: 52px;
                margin: 0 auto 15px;
                border: 0;
                border-radius: 0;
                color: #087cf0;
                font-size: 2.65rem;
                line-height: 1;
            }
            .national-primary-card h3 { margin-bottom: 8px; font-size: 1rem; }
            .national-primary-card p { font-size: .9rem; line-height: 1.55; }
            .national-service-disclosure,
            .national-why-disclosure { display: block; max-width: 760px; margin: 18px auto 0; }
            .national-service-disclosure details,
            .national-why-disclosure details { padding: 12px 16px; }
            .national-service-disclosure summary,
            .national-why-disclosure summary { font-size: .88rem; }

            .national-service-section[aria-labelledby="national-proof-title"] { background: #f2faff; }
            .national-proof-grid { gap: 18px; }
            .national-proof-card { border-radius: 4px; box-shadow: 0 10px 28px rgba(22,53,84,.09); }
            .national-proof-media,
            .national-proof-media img { height: 190px; min-height: 190px; }
            .national-proof-fallback {
                position: relative;
                min-height: 190px;
                overflow: hidden;
                background: linear-gradient(145deg, #0b2147 0 34%, #087cf0 34% 52%, #d9effd 52%);
                color: transparent;
                font-size: 0;
            }
            .national-proof-fallback::before {
                content: "";
                width: 72%;
                height: 62%;
                border: 6px solid rgba(255,255,255,.9);
                border-radius: 5px;
                background: linear-gradient(#fff 0 12%, #e5f5ff 12% 42%, #fff 42% 100%);
                box-shadow: 16px 15px 0 rgba(9,33,71,.18);
                transform: rotate(-3deg);
            }
            .national-proof-body { padding: 18px 20px 16px; }
            .national-proof-category { margin-bottom: 5px; font-size: .7rem; }
            .national-proof-card h3 { margin-bottom: 6px; font-size: 1.05rem; }
            .national-proof-excerpt { font-size: .86rem; line-height: 1.5; -webkit-line-clamp: 2; }
            .national-proof-tags { margin-top: 11px; gap: 5px; }
            .national-proof-tags span { padding: 4px 7px; font-size: .67rem; }
            .national-proof-more { margin-top: 18px; }

            .national-conversion-section.alt { background: #fff; }
            .national-why-grid { gap: 34px; }
            .national-why-card { padding: 0; text-align: left; }
            .national-why-card > span { margin: 0 0 12px; font-size: 2.25rem; }
            .national-why-card h3 { margin-bottom: 6px; font-size: .96rem; }
            .national-why-card p { font-size: .82rem; line-height: 1.52; }

            .national-process-grid { gap: 50px; }
            .national-process-grid::before { top: 50%; left: 28%; right: 28%; border: 0; }
            .national-process-card {
                padding: 26px 22px 22px;
                border: 1px solid #e8edf3;
                border-radius: 5px;
                box-shadow: 0 8px 24px rgba(31,57,83,.05);
            }
            .national-process-card:not(:last-child)::after { content: "→"; position: absolute; top: 48%; right: -36px; color: #7890a8; font-size: 1.8rem; }
            .national-process-card > span { position: absolute; top: -15px; left: 50%; width: 30px; height: 30px; margin: 0; transform: translateX(-50%); font-size: 0; }
            .national-process-card > span::after { font-size: .76rem !important; }
            .national-process-card h3 { margin-top: 13px; font-size: .96rem; }
            .national-process-card p { font-size: .82rem; line-height: 1.5; }

            .national-conversion-section[aria-labelledby="website-faq-title"] { padding-top: 42px; background: #f8fcff; }
            .national-faq-list { gap: 8px 12px; }
            .national-faq-item { border-radius: 4px; }
            .national-faq-question { min-height: 50px; padding: 12px 16px; font-size: .86rem; }
            .national-faq-answer { padding: 0 16px 14px; font-size: .84rem; line-height: 1.55; }

            .national-final-cta { padding: 0 0 20px; background: #fff; }
            .national-final-cta .seo-service-shell { padding: 28px 46px; border-radius: 6px; background: linear-gradient(110deg, #0743bf, #087cf0); }
            .national-final-cta h2 { margin-bottom: 3px; font-size: clamp(24px, 2.1vw, 32px); }
            .national-final-cta p { font-size: .9rem; line-height: 1.5; }
            .national-final-cta .seo-service-button { min-height: 50px; border-radius: 5px; }

            .national-conversion-page .jasaibnu-startup-footer .pt-5 { padding-top: 1.45rem !important; }
            .national-conversion-page .jasaibnu-startup-footer .mb-5 { margin-bottom: 1.35rem !important; }
            .national-conversion-page .jasaibnu-startup-footer .footer-about > div { padding-block: 20px !important; }

            @media (max-width: 991.98px) {
                .national-conversion-page .seo-service-hero { padding-top: 48px; }
                .national-conversion-page .seo-service-hero::before { top: 46%; width: 100%; height: 48%; }
                .national-conversion-page .seo-service-hero-grid { grid-template-columns: 1fr; gap: 32px; }
                .national-conversion-page .seo-service-copy-block { text-align: center; }
                .national-hero-visual { min-height: 370px; }
                .national-process-grid { gap: 28px; }
                .national-process-card:not(:last-child)::after { display: none; }
                .national-final-cta .seo-service-shell { padding: 28px; }
            }

            @media (max-width: 575.98px) {
                .national-conversion-page .seo-service-shell { width: min(100% - 28px, 1180px); }
                .national-conversion-page .seo-service-hero { padding: 36px 0 54px; }
                .national-conversion-page .seo-service-hero h1 { font-size: clamp(32px, 9.8vw, 40px); }
                .national-conversion-page .seo-service-hero-copy { font-size: .92rem; }
                .national-hero-visual { min-height: 260px; }
                .national-hero-browser { top: 8px; }
                .national-hero-project:first-child img { height: 205px; }
                .national-hero-project:nth-child(2) { bottom: -30px; }
                .national-hero-project:nth-child(2) img { height: 138px; }
                .national-trust-strip { margin-top: -24px; }
                .national-service-section,
                .national-conversion-section { padding: 40px 0; }
                .national-primary-card { min-height: 0; padding: 25px 20px; }
                .national-proof-media,
                .national-proof-media img,
                .national-proof-fallback { height: 190px; min-height: 190px; }
                .national-why-grid { gap: 28px; }
                .national-why-card { text-align: center; }
                .national-why-card > span { margin-inline: auto; }
                .national-process-grid { gap: 30px; }
                .national-final-cta .seo-service-shell { padding: 26px 22px; }
            }

            /* UIUX-BANTEN-001: isolated Banten conversion presentation. */
            .banten-conversion-page { background: #fff; color: #0b2147; }
            .banten-conversion-page > .container-fluid.bg-dark.px-5.d-none.d-lg-block { display: none !important; }
            .banten-conversion-page .sticky-top { position: static !important; }
            .banten-conversion-page .startup-inner-shell .navbar { background: #fff !important; }
            .banten-conversion-page .startup-inner-shell .ji-header-logo-public { visibility: hidden; opacity: 0; }
            .banten-conversion-page .startup-inner-shell .ji-header-logo-dark { visibility: visible; opacity: 1; }
            .banten-conversion-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link { color: #17253a !important; }
            .banten-conversion-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link:hover,
            .banten-conversion-page .startup-inner-shell .navbar-dark .navbar-nav .nav-link.active { color: #087cf0 !important; }
            .banten-conversion-page .seo-service-shell { width: min(100% - 40px, 1180px); }
            .banten-conversion-page .seo-service-hero {
                min-height: 560px;
                padding: 66px 0 76px;
                overflow: visible;
                background: #fff;
                color: #0b2147;
            }
            .banten-conversion-page .seo-service-hero::before {
                inset: 22px 0 auto auto;
                width: 58%;
                height: 510px;
                border-radius: 54% 0 0 54%;
                background: radial-gradient(circle at 55% 46%, #dff3ff 0, #eef9ff 58%, rgba(255,255,255,0) 72%);
            }
            .banten-conversion-page .seo-service-hero::after { display: none; }
            .banten-conversion-page .seo-service-hero-grid {
                grid-template-columns: minmax(0, .94fr) minmax(520px, 1.06fr);
                gap: 48px;
            }
            .banten-conversion-page .seo-service-copy-block { max-width: 570px; margin: 0; text-align: left; }
            .banten-conversion-page .seo-service-label { margin-bottom: 12px; background: #edf8ff; color: #0879ee; }
            .banten-conversion-page .seo-service-hero h1 {
                max-width: 570px;
                margin: 0 0 18px;
                color: #0b2147;
                font-size: clamp(36px, 3vw, 48px);
                line-height: 1.08;
            }
            .banten-conversion-page .seo-service-hero-copy { max-width: 540px; margin: 0 0 24px; color: #526175; line-height: 1.65; }
            .banten-conversion-page .seo-service-actions { justify-content: flex-start; }
            .banten-conversion-page .seo-service-button { border-color: #087cf0; border-radius: 5px; background: #087cf0; box-shadow: 0 10px 24px rgba(8,124,240,.18); }
            .banten-conversion-page .seo-service-button.secondary { border-color: #087cf0; background: #fff; color: #087cf0; box-shadow: none; }
            .banten-hero-visual {
                position: relative;
                min-height: 390px;
                overflow: hidden;
                border-radius: 48% 0 0 48%;
                background: linear-gradient(155deg, #f8fdff 4%, #e8f7ff 55%, #caeaff 100%);
            }
            .banten-hero-visual::after {
                content: "";
                position: absolute;
                inset: 0 auto 0 0;
                z-index: 3;
                width: 30%;
                background: linear-gradient(90deg, #fff 4%, rgba(255,255,255,.78) 45%, rgba(255,255,255,0));
            }
            .banten-hero-horizon {
                position: absolute;
                z-index: 1;
                right: -8%;
                bottom: -42px;
                width: 105%;
                height: 195px;
                border-radius: 58% 0 0 0;
                background: linear-gradient(165deg, rgba(115,195,239,.62), rgba(8,124,240,.18));
            }
            .banten-hero-horizon::before,
            .banten-hero-horizon::after {
                content: "";
                position: absolute;
                left: 9%;
                width: 96%;
                height: 72px;
                border: 2px solid rgba(255,255,255,.82);
                border-color: rgba(255,255,255,.82) transparent transparent;
                border-radius: 50%;
            }
            .banten-hero-horizon::before { top: 42px; }
            .banten-hero-horizon::after { top: 78px; left: 20%; opacity: .72; }
            .banten-hero-coast {
                position: absolute;
                z-index: 2;
                right: -35px;
                bottom: -18px;
                width: 75%;
                height: 105px;
                transform: rotate(-3deg);
                border-radius: 72% 0 0 0;
                background: linear-gradient(155deg, rgba(255,255,255,.88), rgba(220,241,252,.94));
            }
            .banten-hero-tower {
                position: absolute;
                z-index: 2;
                right: 29%;
                bottom: 68px;
                width: 54px;
                height: 170px;
                clip-path: polygon(31% 0, 69% 0, 88% 100%, 12% 100%);
                background: linear-gradient(90deg, #fff 0 52%, #d7edfa 52% 100%);
                filter: drop-shadow(0 12px 12px rgba(31,99,146,.12));
            }
            .banten-hero-cap {
                position: absolute;
                z-index: 3;
                right: calc(29% - 5px);
                bottom: 230px;
                width: 64px;
                height: 27px;
                border: 5px solid #087cf0;
                border-radius: 4px 4px 10px 10px;
                background: rgba(255,255,255,.96);
            }
            .banten-hero-cap::before {
                content: "";
                position: absolute;
                left: 50%;
                bottom: 22px;
                width: 42px;
                height: 17px;
                transform: translateX(-50%);
                clip-path: polygon(50% 0, 100% 100%, 0 100%);
                background: #087cf0;
            }
            .banten-hero-beam {
                position: absolute;
                z-index: 1;
                right: calc(29% + 47px);
                bottom: 235px;
                width: 170px;
                height: 52px;
                clip-path: polygon(100% 42%, 0 0, 0 100%);
                background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,.72));
            }
            .banten-conversion-page .national-trust-strip { margin-top: -42px; }
            .banten-conversion-page .national-final-cta { padding: 0 0 20px; background: #fff; }
            .banten-conversion-page .national-final-cta .seo-service-shell { padding: 28px 46px; border-radius: 6px; background: linear-gradient(110deg, #0743bf, #087cf0); }
            .banten-conversion-page .national-final-cta h2 { margin-bottom: 3px; font-size: clamp(24px, 2.1vw, 32px); }
            .banten-conversion-page .national-final-cta p { font-size: .9rem; line-height: 1.5; }
            .banten-conversion-page .national-final-cta .seo-service-button {
                border-color: #fff;
                background: #fff;
                color: #087cf0;
                box-shadow: 0 8px 22px rgba(6,31,80,.16);
            }
            .banten-conversion-page .jasaibnu-startup-footer { margin-top: 0 !important; }
            .banten-conversion-page .jasaibnu-startup-footer > .container { width: min(100% - 40px, 1180px); }
            .banten-conversion-page .jasaibnu-startup-footer > .container > .row { align-items: start; }
            .banten-conversion-page .jasaibnu-startup-footer .footer-about > div {
                align-items: flex-start !important;
                padding: 30px 20px 24px 0 !important;
                background: transparent !important;
                text-align: left !important;
            }
            .banten-conversion-page .jasaibnu-startup-footer .footer-about img { filter: none; }
            .banten-conversion-page .jasaibnu-startup-footer .footer-about .btn { display: none; }
            .banten-conversion-page .jasaibnu-startup-footer .pt-5 { padding-top: 30px !important; }
            .banten-conversion-page .jasaibnu-startup-footer .mb-5 { margin-bottom: 24px !important; }
            .banten-conversion-page .jasaibnu-startup-copyright .row { justify-content: center !important; }
            .banten-conversion-page .jasaibnu-startup-copyright .col-lg-8 { width: 100%; }
            .banten-conversion-page .jasaibnu-startup-copyright .d-flex { height: 54px !important; }

            @media (max-width: 991.98px) {
                .banten-conversion-page .seo-service-hero { padding-top: 48px; }
                .banten-conversion-page .seo-service-hero::before { top: 46%; width: 100%; height: 48%; }
                .banten-conversion-page .seo-service-hero-grid { grid-template-columns: 1fr; gap: 32px; }
                .banten-conversion-page .seo-service-copy-block { margin-inline: auto; text-align: center; }
                .banten-conversion-page .seo-service-hero h1,
                .banten-conversion-page .seo-service-hero-copy { margin-left: auto; margin-right: auto; }
                .banten-conversion-page .seo-service-actions { justify-content: center; }
                .banten-hero-visual { width: min(100%, 620px); min-height: 340px; margin-inline: auto; }
                .banten-conversion-page .jasaibnu-startup-footer .footer-about > div {
                    align-items: center !important;
                    padding-right: 0 !important;
                    text-align: center !important;
                }
            }

            @media (max-width: 575.98px) {
                .banten-conversion-page .seo-service-shell { width: min(100% - 28px, 1180px); }
                .banten-conversion-page .seo-service-hero { padding: 36px 0 54px; }
                .banten-conversion-page .seo-service-hero h1 { font-size: clamp(31px, 9.3vw, 39px); }
                .banten-conversion-page .seo-service-hero-copy { font-size: .92rem; }
                .banten-hero-visual { min-height: 250px; height: 250px; border-radius: 42% 8px 8px 42%; }
                .banten-hero-horizon { height: 130px; bottom: -30px; }
                .banten-hero-coast { height: 72px; }
                .banten-hero-tower { right: 27%; bottom: 45px; width: 40px; height: 115px; }
                .banten-hero-cap { right: calc(27% - 4px); bottom: 154px; width: 48px; height: 22px; border-width: 4px; }
                .banten-hero-cap::before { bottom: 17px; width: 32px; height: 13px; }
                .banten-hero-beam { right: calc(27% + 36px); bottom: 157px; width: 105px; height: 38px; }
                .banten-conversion-page .national-trust-strip { margin-top: -24px; }
                .banten-conversion-page .national-final-cta .seo-service-shell { padding: 26px 22px; }
            }

            /* UIUX-SERANG-MURAH-001: isolated simple landing-page body. */
            .serang-murah-simple-page { background: #fff; color: #0b2147; }
            .serang-murah-simple-page .seo-service-shell { width: min(100% - 40px, 1180px); }
            .serang-murah-simple-page .seo-service-hero {
                min-height: 540px;
                padding: 62px 0 72px;
                background: linear-gradient(110deg, #fff 0%, #fff 55%, #f2f9ff 100%);
                color: #0b2147;
            }
            .serang-murah-simple-page .seo-service-hero::after { display: none; }
            .serang-murah-simple-page .seo-service-hero-grid { grid-template-columns: minmax(0, 1.05fr) minmax(380px, .95fr); gap: 54px; }
            .serang-murah-simple-page .seo-service-copy-block { max-width: 640px; margin: 0; text-align: left; }
            .serang-murah-simple-page .seo-service-label { margin-bottom: 12px; border-color: #cceafb; background: #edf8ff; color: #0879ee; }
            .serang-murah-simple-page .seo-service-hero h1 {
                max-width: 650px;
                margin: 0 0 18px;
                color: #0b2147;
                font-size: clamp(38px, 3.2vw, 50px);
                line-height: 1.12;
            }
            .serang-murah-simple-page .seo-service-hero-copy { max-width: 590px; margin: 0 0 24px; color: #526175; line-height: 1.65; }
            .serang-murah-simple-page .seo-service-actions { justify-content: flex-start; }
            .serang-murah-simple-page .seo-service-button { border-color: #087cf0; border-radius: 6px; background: #087cf0; box-shadow: 0 10px 24px rgba(8,124,240,.18); }
            .serang-murah-simple-page .seo-service-button.secondary { border-color: #087cf0; background: #fff; color: #087cf0; box-shadow: none; }

            .serang-murah-hero-visual {
                position: relative;
                min-height: 360px;
                overflow: hidden;
                border: 1px solid #dceefa;
                border-radius: 50% 12px 12px 50%;
                background: linear-gradient(145deg, #f6fbff, #dff2ff);
            }
            .serang-murah-hero-visual::before {
                content: "";
                position: absolute;
                width: 360px;
                height: 360px;
                right: -75px;
                top: -72px;
                border-radius: 50%;
                background: linear-gradient(145deg, rgba(8,124,240,.14), rgba(6,163,218,.03));
            }
            .serang-murah-visual-orbit { position: absolute; border: 1px solid rgba(8,124,240,.25); border-radius: 50%; transform: rotate(-18deg); }
            .serang-murah-visual-orbit.orbit-one { width: 390px; height: 190px; right: -28px; bottom: 40px; }
            .serang-murah-visual-orbit.orbit-two { width: 270px; height: 130px; right: 52px; bottom: 70px; }
            .serang-murah-visual-panel { position: absolute; display: block; border: 7px solid #102a51; border-radius: 10px; background: #fff; box-shadow: 0 24px 42px rgba(11,33,71,.18); transform: rotate(3deg); }
            .serang-murah-visual-panel::before { content: ""; position: absolute; inset: 0 0 auto; height: 30px; background: #f3f8fc; border-bottom: 1px solid #dfebf3; }
            .serang-murah-visual-panel i { position: absolute; display: block; border-radius: 4px; background: #d8edfb; }
            .serang-murah-visual-panel.panel-main { width: 300px; height: 205px; left: 38px; top: 72px; }
            .serang-murah-visual-panel.panel-main i:nth-child(1) { inset: 50px 20px auto; height: 55px; background: linear-gradient(110deg,#087cf0,#06a3da); }
            .serang-murah-visual-panel.panel-main i:nth-child(2) { left: 20px; bottom: 24px; width: 115px; height: 44px; }
            .serang-murah-visual-panel.panel-main i:nth-child(3) { right: 20px; bottom: 24px; width: 115px; height: 44px; }
            .serang-murah-visual-panel.panel-side { width: 120px; height: 210px; right: 28px; bottom: 28px; transform: rotate(-3deg); }
            .serang-murah-visual-panel.panel-side i:nth-child(1) { inset: 48px 12px auto; height: 54px; background: linear-gradient(145deg,#087cf0,#06a3da); }
            .serang-murah-visual-panel.panel-side i:nth-child(2) { inset: 118px 12px auto; height: 52px; }
            .serang-murah-visual-check { position: absolute; display: grid; width: 58px; height: 58px; left: 18px; bottom: 22px; place-items: center; border-radius: 50%; background: #087cf0; color: #fff; font-size: 27px; font-weight: 800; box-shadow: 0 12px 24px rgba(8,124,240,.25); }

            .serang-murah-benefits { position: relative; z-index: 2; margin-top: -38px; }
            .serang-murah-benefit-grid { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); border: 1px solid #e3eef5; border-radius: 8px; background: #fff; box-shadow: 0 14px 34px rgba(11,33,71,.1); }
            .serang-murah-benefit-grid > div { display: flex; min-height: 78px; align-items: center; justify-content: center; gap: 11px; padding: 16px; border-right: 1px solid #e3eef5; color: #17253a; text-align: center; }
            .serang-murah-benefit-grid > div:last-child { border-right: 0; }
            .serang-murah-benefit-grid span { display: grid; width: 35px; height: 35px; flex: 0 0 auto; place-items: center; border-radius: 50%; background: #eef8ff; color: #087cf0; font-size: .78rem; font-weight: 800; }
            .serang-murah-benefit-grid strong { font-size: .9rem; }

            .serang-murah-section { padding: 66px 0; }
            .serang-murah-section:nth-of-type(odd) { background: #f8fcff; }
            .serang-murah-heading { max-width: 720px; margin: 0 auto 30px; text-align: center; }
            .serang-murah-heading.align-left { margin-left: 0; text-align: left; }
            .serang-murah-heading h2 { margin: 0; color: #0b2147; font-family: "Nunito",sans-serif; font-size: clamp(28px,2.5vw,36px); font-weight: 800; line-height: 1.2; }
            .serang-murah-heading > p:last-child { margin: 10px auto 0; color: #637084; line-height: 1.6; }
            .serang-murah-service-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 18px; }
            .serang-murah-service-grid article { min-height: 205px; padding: 27px; border: 1px solid #e0ebf2; border-radius: 7px; background: #fff; box-shadow: 0 10px 24px rgba(11,33,71,.055); }
            .serang-murah-service-grid article > span { display: inline-grid; width: 42px; height: 42px; place-items: center; margin-bottom: 17px; border-radius: 6px; background: #edf8ff; color: #087cf0; font-size: .72rem; font-weight: 800; }
            .serang-murah-service-grid h3,.serang-murah-advantage-grid h3,.serang-murah-process-list h3 { margin: 0 0 7px; color: #0b2147; font-size: 1.03rem; font-weight: 800; }
            .serang-murah-service-grid p,.serang-murah-advantage-grid p,.serang-murah-process-list p { margin: 0; color: #637084; font-size: .9rem; line-height: 1.58; }
            .serang-murah-details { margin-top: 20px; padding: 16px 20px; border: 1px solid #dfeaf1; border-radius: 7px; background: #fff; }
            .serang-murah-details summary { color: #0b2147; font-weight: 800; cursor: pointer; }
            .serang-murah-details p { margin: 14px 0 0; color: #637084; line-height: 1.65; }
            .serang-murah-details a { color: #087cf0; font-weight: 700; }
            .serang-murah-advantages { background: #f8fcff; }
            .serang-murah-advantage-grid { display: grid; grid-template-columns: repeat(6,minmax(0,1fr)); gap: 14px; }
            .serang-murah-advantage-grid article { padding: 9px 14px 12px 0; }
            .serang-murah-advantage-grid span { display: block; margin-bottom: 12px; color: #087cf0; font-weight: 800; }
            .serang-murah-advantage-grid h3 { font-size: .94rem; }
            .serang-murah-advantage-grid p { font-size: .82rem; }
            .serang-murah-split { display: grid; grid-template-columns: minmax(0,.82fr) minmax(0,1.18fr); gap: 64px; align-items: start; }
            .serang-murah-process-list { display: grid; gap: 14px; }
            .serang-murah-process-list article { display: grid; grid-template-columns: 48px minmax(0,1fr); gap: 15px; padding: 18px; border: 1px solid #e0ebf2; border-radius: 7px; background: #fff; }
            .serang-murah-process-list article > span { display: grid; width: 42px; height: 42px; place-items: center; border-radius: 50%; background: #087cf0; color: #fff; font-size: .78rem; font-weight: 800; }
            .serang-murah-faq-list { display: grid; gap: 10px; }
            .serang-murah-faq { border: 1px solid #e0ebf2; border-radius: 7px; background: #fff; }
            .serang-murah-faq summary { position: relative; padding: 16px 44px 16px 18px; list-style: none; cursor: pointer; }
            .serang-murah-faq summary::-webkit-details-marker { display: none; }
            .serang-murah-faq summary::after { content: "+"; position: absolute; right: 18px; top: 50%; color: #087cf0; font-size: 1.25rem; transform: translateY(-50%); }
            .serang-murah-faq[open] summary::after { content: "−"; }
            .serang-murah-faq h3 { margin: 0; color: #0b2147; font-size: .91rem; font-weight: 800; }
            .serang-murah-faq p { margin: 0; padding: 0 18px 16px; color: #637084; font-size: .86rem; line-height: 1.55; }
            .serang-murah-cta { padding: 0 0 28px; }
            .serang-murah-cta .seo-service-shell { display: flex; align-items: center; justify-content: space-between; gap: 30px; padding: 30px 42px; border-radius: 7px; background: linear-gradient(110deg,#0743bf,#087cf0); color: #fff; }
            .serang-murah-cta h2 { margin: 0 0 4px; color: #fff; font-family: "Nunito",sans-serif; font-size: clamp(23px,2vw,30px); font-weight: 800; }
            .serang-murah-cta p { max-width: 720px; margin: 0; color: rgba(255,255,255,.9); font-size: .9rem; }
            .serang-murah-cta .seo-service-button { flex: 0 0 auto; border-color: #fff; background: #fff; color: #087cf0; box-shadow: none; }

            @media (max-width: 1024px) {
                .serang-murah-simple-page .seo-service-hero-grid { grid-template-columns: minmax(0,1fr) minmax(330px,.8fr); gap: 32px; }
                .serang-murah-service-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
                .serang-murah-advantage-grid { grid-template-columns: repeat(3,minmax(0,1fr)); }
                .serang-murah-split { gap: 34px; }
            }
            @media (max-width: 767.98px) {
                .serang-murah-simple-page .seo-service-shell { width: min(100% - 30px,1180px); }
                .serang-murah-simple-page .seo-service-hero { min-height: 0; padding: 48px 0 68px; }
                .serang-murah-simple-page .seo-service-hero-grid { grid-template-columns: 1fr; gap: 34px; }
                .serang-murah-simple-page .seo-service-copy-block { margin-inline: auto; text-align: center; }
                .serang-murah-simple-page .seo-service-hero h1,.serang-murah-simple-page .seo-service-hero-copy { margin-left: auto; margin-right: auto; }
                .serang-murah-simple-page .seo-service-actions { justify-content: center; }
                .serang-murah-hero-visual { width: min(100%,520px); min-height: 300px; margin-inline: auto; }
                .serang-murah-benefit-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
                .serang-murah-benefit-grid > div:nth-child(2) { border-right: 0; }
                .serang-murah-benefit-grid > div:nth-child(-n+2) { border-bottom: 1px solid #e3eef5; }
                .serang-murah-split { grid-template-columns: 1fr; }
                .serang-murah-cta .seo-service-shell { flex-direction: column; align-items: flex-start; }
            }
            @media (max-width: 575.98px) {
                .serang-murah-simple-page .seo-service-shell { width: min(100% - 28px,1180px); }
                .serang-murah-simple-page .seo-service-hero { padding: 34px 0 58px; }
                .serang-murah-simple-page .seo-service-hero h1 { font-size: clamp(31px,9.4vw,38px); }
                .serang-murah-simple-page .seo-service-hero-copy { font-size: .92rem; }
                .serang-murah-hero-visual { min-height: 245px; border-radius: 42% 8px 8px 42%; }
                .serang-murah-visual-panel.panel-main { width: 230px; height: 165px; left: 25px; top: 43px; }
                .serang-murah-visual-panel.panel-side { width: 92px; height: 165px; right: 18px; bottom: 18px; }
                .serang-murah-visual-check { width: 48px; height: 48px; left: 12px; bottom: 12px; }
                .serang-murah-benefit-grid > div { min-height: 88px; flex-direction: column; gap: 6px; padding: 12px 8px; }
                .serang-murah-benefit-grid strong { font-size: .79rem; }
                .serang-murah-section { padding: 48px 0; }
                .serang-murah-service-grid,.serang-murah-advantage-grid { grid-template-columns: 1fr; }
                .serang-murah-service-grid article { min-height: 0; padding: 22px; }
                .serang-murah-advantage-grid article { padding: 14px 0; border-bottom: 1px solid #e0ebf2; }
                .serang-murah-split { gap: 46px; }
                .serang-murah-cta .seo-service-shell { padding: 26px 22px; text-align: center; align-items: stretch; }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const floatingWhatsapp = document.querySelector('.floating-whatsapp');
                const nationalWhatsappCtas = document.querySelectorAll('[data-national-whatsapp-cta]');

                if (floatingWhatsapp && nationalWhatsappCtas.length) {
                    nationalWhatsappCtas.forEach((cta) => {
                        cta.href = floatingWhatsapp.href;
                        cta.target = '_blank';
                        cta.rel = 'noopener noreferrer';
                    });
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
                        <a class="seo-service-button" href="{{ route('contact') }}" @if ($isConversionLanding || $isSerangMurahLanding) data-national-whatsapp-cta @endif>{{ ($isConversionLanding || $isSerangMurahLanding) ? 'Konsultasi via WhatsApp' : 'Konsultasi Website' }}</a>
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
                                            <img src="{{ asset('assets/startup2/img/optimized/carousel-1-desktop.webp') }}" alt="Preview website JASAIBNU" width="720" height="480" decoding="async">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @elseif ($isBantenLanding)
                    <div class="banten-hero-visual" aria-hidden="true">
                        <span class="banten-hero-horizon"></span>
                        <span class="banten-hero-coast"></span>
                        <span class="banten-hero-beam"></span>
                        <span class="banten-hero-tower"></span>
                        <span class="banten-hero-cap"></span>
                    </div>
                @elseif ($isSerangMurahLanding)
                    <div class="serang-murah-hero-visual" aria-hidden="true">
                        <span class="serang-murah-visual-orbit orbit-one"></span>
                        <span class="serang-murah-visual-orbit orbit-two"></span>
                        <span class="serang-murah-visual-panel panel-main"><i></i><i></i><i></i></span>
                        <span class="serang-murah-visual-panel panel-side"><i></i><i></i></span>
                        <span class="serang-murah-visual-check">✓</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if ($isSerangMurahLanding)
        @php
            $serangMurahFaqs = [
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

        <section class="serang-murah-benefits" aria-label="Manfaat utama website Serang murah">
            <div class="seo-service-shell serang-murah-benefit-grid">
                <div><span aria-hidden="true">Rp</span><strong>Harga sesuai budget</strong></div>
                <div><span aria-hidden="true">↗</span><strong>Proses pengerjaan cepat</strong></div>
                <div><span aria-hidden="true">◇</span><strong>Desain modern &amp; responsive</strong></div>
                <div><span aria-hidden="true">⌕</span><strong>Siap dioptimasi SEO</strong></div>
            </div>
        </section>

        <section class="serang-murah-section serang-murah-services" aria-labelledby="serang-murah-services-title">
            <div class="seo-service-shell">
                <div class="serang-murah-heading">
                    <p class="seo-service-label">Layanan website</p>
                    <h2 id="serang-murah-services-title">Website sederhana yang tepat untuk kebutuhan bisnis Anda.</h2>
                    <p>Dari halaman profil sederhana sampai website dengan pengelolaan konten, JASAIBNU membantu memilih bentuk website yang paling realistis untuk target bisnis dan budget.</p>
                </div>
                <div class="serang-murah-service-grid">
                    <article><span>CP</span><h3>Company Profile</h3><p>Website profil perusahaan untuk menampilkan layanan, legalitas, portfolio, kontak, dan kredibilitas bisnis.</p></article>
                    <article><span>CAT</span><h3>Katalog Produk</h3><p>Website katalog untuk menampilkan produk, kategori, detail, dan jalur pemesanan melalui WhatsApp atau form.</p></article>
                    <article><span>LP</span><h3>Landing Page</h3><p>Halaman khusus untuk campaign, iklan, launching produk, pendaftaran, atau penawaran jasa tertentu.</p></article>
                    <article><span>APP</span><h3>Website System Custom</h3><p>Fondasi website bisa dikembangkan menjadi sistem booking, dashboard, member area, atau aplikasi bisnis.</p></article>
                    <article><span>CMS</span><h3>Website Sekolah / Instansi</h3><p>Konten website dapat dikelola sendiri, seperti artikel, portfolio, layanan, halaman, dan pengaturan umum.</p></article>
                    <article><span>UMK</span><h3>Website UMKM / Toko Online</h3><p>Website untuk bisnis lokal agar calon pelanggan lebih mudah melihat layanan, harga awal, lokasi, dan kontak.</p></article>
                </div>
                <details class="serang-murah-details">
                    <summary>Informasi lengkap website hemat untuk bisnis lokal</summary>
                    <p><strong>{{ $landing['impact_title'] }}</strong> {{ $landing['impact_copy'] }}</p>
                    <p>{{ $landing['badge'] }}</p>
                    @if ($primarySerangLink)
                        <p>{{ $primarySerangLink['before'] }}<a href="{{ route('website-development-serang') }}">{{ $primarySerangLink['anchor'] }}</a>{{ $primarySerangLink['after'] }}</p>
                    @endif
                    <p><strong>Meningkatkan penjualan.</strong> Calon pelanggan bisa menemukan layanan, memahami penawaran, dan langsung menghubungi bisnis. <strong>Membangun branding.</strong> Tampilan, pesan, portfolio, dan identitas bisnis tersusun konsisten dalam satu tempat.</p>
                    <p><strong>Menambah kepercayaan.</strong> Bisnis terlihat lebih serius dengan profil, alamat, kontak, testimoni, dan bukti pekerjaan. <strong>Siap dipromosikan.</strong> Website bisa jadi tujuan iklan, Google Search, media sosial, WhatsApp, dan campaign digital.</p>
                </details>
            </div>
        </section>

        <section class="serang-murah-section serang-murah-advantages" aria-labelledby="serang-murah-advantages-title">
            <div class="seo-service-shell">
                <div class="serang-murah-heading">
                    <p class="seo-service-label">Kenapa JASAIBNU</p>
                    <h2 id="serang-murah-advantages-title">Fondasi penting untuk website yang profesional.</h2>
                    <p>Kami membangun website dengan pendekatan teknis yang rapi: desain responsive, performa cepat, struktur konten jelas, keamanan dasar, dan fondasi SEO agar lebih siap masuk pencarian Google.</p>
                </div>
                <div class="serang-murah-advantage-grid">
                    <article><span>01</span><h3>Berpengalaman</h3><p>Tujuan, halaman penting, fitur, dan arah konten dipetakan sejak awal.</p></article>
                    <article><span>02</span><h3>SEO Friendly</h3><p>Title, meta description, heading, canonical, sitemap, dan schema dasar disusun rapi untuk indexing.</p></article>
                    <article><span>03</span><h3>Aman &amp; Terpercaya</h3><p>Form, route, validasi input, dan konfigurasi HTTPS disiapkan agar website lebih aman digunakan.</p></article>
                    <article><span>04</span><h3>Mudah Dikelola</h3><p>Website bisa dilengkapi admin panel untuk mengubah konten dan pengaturan bisnis.</p></article>
                    <article><span>05</span><h3>Dukungan Penuh</h3><p>Struktur teknis yang rapi memudahkan perawatan dan pengembangan bertahap.</p></article>
                    <article><span>06</span><h3>Fleksibel</h3><p>Fondasi dapat dilanjutkan menjadi katalog, booking, dashboard internal, SaaS, atau integrasi AI.</p></article>
                </div>
            </div>
        </section>

        <section class="serang-murah-section serang-murah-process-faq" aria-labelledby="serang-murah-process-title">
            <div class="seo-service-shell serang-murah-split">
                <div>
                    <div class="serang-murah-heading align-left"><p class="seo-service-label">Proses kerja</p><h2 id="serang-murah-process-title">Tiga langkah sampai website online.</h2></div>
                    <div class="serang-murah-process-list">
                        <article><span>01</span><div><h3>Analisis Kebutuhan</h3><p>Kami petakan tujuan website, target pengguna, halaman penting, fitur, dan arah konten yang dibutuhkan.</p></div></article>
                        <article><span>02</span><div><h3>Desain &amp; Development</h3><p>Website dibangun dengan tampilan profesional, struktur teknis rapi, dan pengalaman pengguna yang mudah dipahami.</p></div></article>
                        <article><span>03</span><div><h3>Testing &amp; Go Live</h3><p>Sebelum online, halaman dicek dari sisi performa, mobile view, form kontak, SEO dasar, dan kesiapan indexing.</p></div></article>
                    </div>
                </div>
                <div>
                    <div class="serang-murah-heading align-left"><p class="seo-service-label">FAQ</p><h2 id="website-faq-title">Pertanyaan yang sering diajukan.</h2></div>
                    <div class="serang-murah-faq-list">
                        @foreach ($serangMurahFaqs as $index => [$question, $answer])
                            <details class="serang-murah-faq" @if ($index === 0) open @endif>
                                <summary><h3>{{ $question }}</h3></summary>
                                <p>{{ $answer }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="serang-murah-cta" aria-labelledby="website-cta-title">
            <div class="seo-service-shell">
                <div><h2 id="website-cta-title">Mulai website bisnis Anda dengan langkah yang realistis.</h2><p>Ceritakan kebutuhan website, target bisnis, dan fitur yang ingin dibangun. JASAIBNU akan membantu memetakan solusi yang realistis sebelum masuk tahap produksi.</p></div>
                <a class="seo-service-button" href="{{ route('contact') }}" data-national-whatsapp-cta>Konsultasi via WhatsApp</a>
            </div>
        </section>
    @elseif ($isConversionLanding)
        <div class="national-trust-strip" aria-label="Nilai utama layanan website">
            <div class="seo-service-shell national-trust-grid">
                <div class="national-trust-item">{{ $isBantenLanding ? 'SEO Friendly' : 'Kolaborasi seluruh Indonesia' }}</div>
                <div class="national-trust-item">{{ $isBantenLanding ? 'Mobile-friendly' : 'Tampilan responsive' }}</div>
                <div class="national-trust-item">{{ $isBantenLanding ? 'Fondasi keamanan' : 'Fondasi SEO teknis' }}</div>
                <div class="national-trust-item">{{ $isBantenLanding ? 'Support berkelanjutan' : 'Dukungan setelah go-live' }}</div>
            </div>
        </div>
    @endif

    @if ($isConversionLanding)
        <section class="national-service-section alt" aria-labelledby="national-offer-title">
            <div class="seo-service-shell">
                <div class="seo-service-heading">
                    <p class="seo-service-label">Cakupan layanan</p>
                    <h2 id="national-offer-title">{{ $isBantenLanding ? 'Website disesuaikan dengan kebutuhan bisnis Anda.' : 'Layanan website utama untuk mendukung pertumbuhan bisnis.' }}</h2>
                    <p>Setiap project dimulai dengan pemetaan tujuan, halaman, materi, fitur, dan kebutuhan pengelolaan agar solusi yang dibangun tetap relevan dan dapat dikembangkan.</p>
                </div>
                <div class="national-primary-grid">
                    <article class="national-primary-card">
                        <span aria-hidden="true">▣</span>
                        <h3>Website Company Profile</h3>
                        <p>Website profil perusahaan untuk menampilkan layanan, portfolio, kontak, dan kredibilitas bisnis.</p>
                    </article>
                    <article class="national-primary-card">
                        <span aria-hidden="true">⌑</span>
                        <h3>Website Toko Online</h3>
                        <p>Katalog produk dan informasi bisnis dengan jalur pemesanan melalui WhatsApp atau form.</p>
                    </article>
                    <article class="national-primary-card">
                        <span aria-hidden="true">▤</span>
                        <h3>Website Berita &amp; Blog</h3>
                        <p>Website dengan admin panel untuk mengelola artikel, portfolio, layanan, halaman, dan informasi terbaru.</p>
                    </article>
                    <article class="national-primary-card">
                        <span aria-hidden="true">⚙</span>
                        <h3>Web Application</h3>
                        <p>Fondasi website bisa dikembangkan menjadi sistem booking, dashboard, member area, atau aplikasi bisnis.</p>
                    </article>
                </div>
                <div class="national-compact-facts national-service-disclosure">
                    <details aria-label="{{ $isBantenLanding ? 'Informasi lengkap layanan website' : 'Tahapan kolaborasi jarak jauh' }}">
                        <summary>Informasi lengkap layanan dan kolaborasi</summary>
                        @if ($isBantenLanding)
                        <p><strong>{{ $landing['impact_title'] }}</strong> {{ $landing['impact_copy'] }}</p>
                        <p>{{ $landing['badge'] }}</p>
                        @if ($primarySerangLink)
                            <p>{{ $primarySerangLink['before'] }}<a href="{{ route('website-development-serang') }}">{{ $primarySerangLink['anchor'] }}</a>{{ $primarySerangLink['after'] }}</p>
                        @endif
                        <p>Company profile, landing page promosi, website UMKM dan jasa, katalog produk, website dengan admin panel, serta fondasi aplikasi web dapat disusun mengikuti tujuan bisnis dan kesiapan materi.</p>
                        <p>Struktur halaman, tampilan responsive, jalur kontak, keamanan dasar, dan fondasi SEO teknis disiapkan sesuai scope yang disepakati.</p>
                        <p>Durasi dipengaruhi jumlah halaman, kesiapan materi, kompleksitas fitur, kebutuhan integrasi, dan proses peninjauan. Akses pengelolaan dan dukungan setelah go-live dibahas mengikuti scope project.</p>
                        @else
                        <p><strong>Pembuatan website untuk bisnis di berbagai wilayah Indonesia.</strong> JASAIBNU dapat mendampingi bisnis melalui proses kolaborasi jarak jauh. Diskusi kebutuhan, penyiapan materi, peninjauan desain, pengembangan, dan koordinasi sebelum website online dapat dilakukan secara terstruktur tanpa harus berada di kota yang sama.</p>
                        <p><strong>Scope website disusun mengikuti kebutuhan dan kesiapan bisnis.</strong> Setiap project dipetakan berdasarkan tujuan, halaman, materi, fitur, dan kebutuhan pengelolaan.</p>
                        <p>Company profile, landing page, website layanan, katalog, website dengan admin panel, dan fondasi aplikasi web dapat disusun sesuai tujuan bisnis. Halaman khusus untuk campaign, iklan, launching produk, pendaftaran, atau penawaran jasa tertentu juga dapat disiapkan.</p>
                        <p>Struktur halaman, tampilan responsive, jalur kontak, keamanan dasar, dan fondasi SEO teknis disiapkan sesuai scope yang disepakati.</p>
                        <p>Proses mencakup analisis kebutuhan, penyusunan struktur, desain dan development, testing, serta persiapan go-live.</p>
                        <p>Durasi dipengaruhi jumlah halaman, kesiapan materi, kompleksitas fitur, kebutuhan integrasi, dan kecepatan proses peninjauan.</p>
                        <p>Akses pengelolaan dapat disiapkan saat project menggunakan admin panel. Kebutuhan pengembangan dan dukungan setelah go-live dibahas mengikuti scope project.</p>
                        @endif
                    </details>
                </div>
            </div>
        </section>

        @if ($conversionPortfolioItems->isNotEmpty())
            <section class="national-service-section" aria-labelledby="national-proof-title">
                <div class="seo-service-shell">
                    <div class="seo-service-heading">
                        <p class="seo-service-label">Portfolio terpublikasi</p>
                        <h2 id="national-proof-title">Contoh solusi digital yang telah dipublikasikan JASAIBNU.</h2>
                        <p>Contoh berikut diambil langsung dari portfolio terpublikasi dan menunjukkan cakupan website serta sistem digital yang tersedia.</p>
                    </div>
                    <div class="national-proof-grid">
                        @foreach ($conversionPortfolioItems as $item)
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

    @if ($isConversionLanding)
        <section class="national-conversion-section alt" aria-labelledby="website-benefits-title">
            <div class="seo-service-shell">
                <div class="national-conversion-heading">
                    <p class="seo-service-label">Kenapa JASAIBNU</p>
                    <h2 id="website-benefits-title">{{ $isBantenLanding ? 'Keunggulan yang memberi nilai lebih untuk bisnis Anda.' : 'Fondasi website yang rapi, cepat, aman, dan siap berkembang.' }}</h2>
                    <p>Kami membangun website dengan pendekatan teknis yang rapi: desain responsive, performa cepat, struktur konten jelas, keamanan dasar, dan fondasi SEO agar lebih siap masuk pencarian Google.</p>
                </div>
                <div class="national-why-grid">
                    <article class="national-why-card">
                        <span aria-hidden="true">↗</span>
                        <h3>{{ $isBantenLanding ? 'Desain Modern' : 'Responsive dan cepat' }}</h3>
                        <p>Website disiapkan agar nyaman dibuka di mobile maupun desktop, dengan optimasi gambar dan struktur halaman yang ringan.</p>
                    </article>
                    <article class="national-why-card">
                        <span aria-hidden="true">⌕</span>
                        <h3>{{ $isBantenLanding ? 'SEO Friendly' : 'Siap SEO teknis' }}</h3>
                        <p>Title, meta description, canonical, sitemap, robots, dan struktur heading dibuat agar Google lebih mudah memahami halaman.</p>
                    </article>
                    <article class="national-why-card">
                        <span aria-hidden="true">◇</span>
                        <h3>{{ $isBantenLanding ? 'Aman & Terpercaya' : 'Keamanan dasar' }}</h3>
                        <p>Form, route, validasi input, dan konfigurasi HTTPS disiapkan agar website lebih aman digunakan.</p>
                    </article>
                    <article class="national-why-card">
                        <span aria-hidden="true">♧</span>
                        <h3>{{ $isBantenLanding ? 'Support & Maintenance' : 'Mudah dikelola dan dikembangkan' }}</h3>
                        <p>Website bisa dilengkapi admin panel untuk mengubah konten, portfolio, artikel, layanan, dan pengaturan bisnis.</p>
                    </article>
                </div>
                <div class="national-compact-facts national-why-disclosure">
                    <details>
                        <summary>Selengkapnya tentang manfaat dan fondasi website</summary>
                        <p><strong>Website bukan hanya tampil online, tapi harus membantu bisnis dipercaya dan ditemukan.</strong></p>
                        <p><strong>{{ $landing['impact_title'] }}</strong> {{ $landing['impact_copy'] }}</p>
                        <p><strong>Meningkatkan penjualan.</strong> Calon pelanggan bisa menemukan layanan, memahami penawaran, dan langsung menghubungi bisnis.</p>
                        <p><strong>Membangun branding.</strong> Tampilan, pesan, portfolio, dan identitas bisnis tersusun konsisten dalam satu tempat.</p>
                        <p><strong>Menambah kepercayaan.</strong> Bisnis terlihat lebih serius dengan profil, alamat, kontak, testimoni, dan bukti pekerjaan.</p>
                        <p><strong>Siap dipromosikan.</strong> Website bisa jadi tujuan iklan, Google Search, media sosial, WhatsApp, dan campaign digital.</p>
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
                        <h3>Konsultasi &amp; Analisis</h3>
                        <p>Kami petakan tujuan website, target pengguna, halaman penting, fitur, dan arah konten yang dibutuhkan.</p>
                    </article>
                    <article class="national-process-card">
                        <span>02 — Desain &amp; development</span>
                        <h3>Desain &amp; Development</h3>
                        <p>Website dibangun dengan tampilan profesional, struktur teknis rapi, dan pengalaman pengguna yang mudah dipahami.</p>
                    </article>
                    <article class="national-process-card">
                        <span>03 — Testing &amp; {{ $isBantenLanding ? 'launching' : 'launch' }}</span>
                        <h3>Testing &amp; {{ $isBantenLanding ? 'Launching' : 'Launch' }}</h3>
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
                <div class="national-final-cta-copy">
                    <h2 id="website-cta-title">{{ $isBantenLanding ? 'Siap membangun website bisnis di Banten?' : 'Butuh jasa pembuatan website untuk bisnis Anda?' }}</h2>
                    <p>{{ $isBantenLanding ? 'Ceritakan kebutuhan website dan target bisnis Anda untuk memulai konsultasi.' : 'Ceritakan kebutuhan website, target bisnis, dan fitur yang ingin dibangun. JASAIBNU akan membantu memetakan solusi yang realistis sebelum masuk tahap produksi.' }}</p>
                </div>
                <a class="seo-service-button" href="{{ route('contact') }}" data-national-whatsapp-cta>Konsultasi via WhatsApp</a>
            </div>
        </section>
    @endif

    @if (!$isConversionLanding && !$isSerangMurahLanding)
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
