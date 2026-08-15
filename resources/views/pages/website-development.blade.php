@extends('layouts.app')

@section('title', 'Jasa Pembuatan Website Profesional | JASAIBNU')
@section('meta_description', 'JASAIBNU menyediakan jasa pembuatan website profesional untuk company profile, landing page, website bisnis, SEO, dan sistem web yang cepat, aman, dan mudah dikembangkan.')
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
            grid-template-columns: minmax(0, 1fr) minmax(320px, 430px);
            gap: clamp(30px, 5vw, 70px);
            align-items: center;
        }

        .seo-service-copy-block {
            max-width: 720px;
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
            max-width: 700px;
            margin: 0 0 20px;
            color: #fff;
            font-family: "Nunito", sans-serif;
            font-size: clamp(44px, 4.45vw, 62px);
            font-weight: 800;
            line-height: 1.06;
        }

        .seo-service-hero-copy {
            max-width: 620px;
            margin: 0 0 28px;
            color: rgba(255, 255, 255, .9);
            font-size: clamp(1rem, 1.12vw, 1.1rem);
            line-height: 1.75;
        }

        .seo-service-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
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

        .seo-service-panel {
            position: relative;
            padding: clamp(24px, 3vw, 34px);
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 6px;
            background: rgba(255, 255, 255, .96);
            color: #091e3e;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .2);
            transform: translateY(20px);
        }

        .seo-service-panel::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 5px;
            border-radius: 6px 0 0 6px;
            background: #06a3da;
        }

        .seo-service-panel-kicker {
            margin: 0 0 8px;
            color: #06a3da;
            font-size: .78rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .seo-service-panel h2 {
            margin: 0 0 16px;
            font-size: clamp(1.45rem, 2vw, 1.75rem);
            font-weight: 800;
            line-height: 1.18;
        }

        .seo-service-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .seo-service-list li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #10284a;
            font-weight: 600;
            line-height: 1.55;
        }

        .seo-service-list span {
            color: #06a3da;
            font-weight: 800;
        }

        .seo-service-panel-footer {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            margin-top: 22px;
        }

        .seo-service-panel-footer span {
            display: inline-flex;
            min-height: 42px;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: #eef9ff;
            color: #091e3e;
            font-size: .8rem;
            font-weight: 800;
            text-align: center;
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

        @media (max-width: 991.98px) {
            .seo-service-hero-grid,
            .seo-service-card-grid,
            .seo-service-faq-grid {
                grid-template-columns: 1fr;
            }

            .seo-service-hero {
                min-height: auto;
                padding: 56px 0 72px;
                background-image: linear-gradient(180deg, rgba(9, 30, 62, .88), rgba(9, 30, 62, .72)), url("/assets/startup2/img/optimized/carousel-1-mobile.webp");
            }

            .seo-service-panel {
                transform: none;
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
                margin-bottom: 16px;
                font-size: clamp(34px, 10vw, 42px);
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

            .seo-service-panel,
            .seo-service-card,
            .seo-service-faq {
                padding: 22px;
            }

            .seo-service-panel h2 {
                font-size: 1.28rem;
            }

            .seo-service-list {
                gap: 10px;
            }

            .seo-service-list li {
                font-size: .95rem;
                line-height: 1.45;
            }

            .seo-service-panel-footer {
                grid-template-columns: 1fr;
                margin-top: 16px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="seo-service-hero" aria-labelledby="website-service-title">
        <div class="seo-service-shell">
            <div class="seo-service-hero-grid">
                <div class="seo-service-copy-block">
                    <p class="seo-service-label">Jasa Pembuatan Website</p>
                    <h1 id="website-service-title">Jasa Pembuatan Website Profesional untuk Bisnis yang Ingin Tumbuh</h1>
                    <p class="seo-service-hero-copy">JASAIBNU membantu bisnis membuat website company profile, landing page, website layanan, dan sistem web yang cepat, aman, mobile-friendly, serta siap dioptimasi untuk Google.</p>
                    <div class="seo-service-actions">
                        <a class="seo-service-button" href="{{ route('contact') }}">Konsultasi Website</a>
                        <a class="seo-service-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio</a>
                    </div>
                </div>
                <aside class="seo-service-panel" aria-label="Ringkasan layanan pembuatan website">
                    <p class="seo-service-panel-kicker">Fokus deliverable</p>
                    <h2>Website yang kami bangun</h2>
                    <ul class="seo-service-list">
                        <li><span>✓</span> Website company profile profesional</li>
                        <li><span>✓</span> Landing page promosi dan campaign</li>
                        <li><span>✓</span> Website jasa, UMKM, dan bisnis lokal</li>
                        <li><span>✓</span> Struktur SEO, sitemap, dan schema dasar</li>
                        <li><span>✓</span> Integrasi WhatsApp, form kontak, dan analytics</li>
                    </ul>
                    <div class="seo-service-panel-footer" aria-label="Keunggulan teknis website">
                        <span>SEO-ready</span>
                        <span>Mobile-first</span>
                        <span>Fast loading</span>
                    </div>
                </aside>
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

    <section class="seo-service-section alt" aria-labelledby="website-process-title">
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
@endsection
