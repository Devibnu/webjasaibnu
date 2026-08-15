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
            padding: clamp(72px, 9vw, 120px) 0;
            background: linear-gradient(rgba(9, 30, 62, .82), rgba(9, 30, 62, .76)), url("/assets/startup2/img/optimized/carousel-1-desktop.webp") center center / cover no-repeat;
            color: #fff;
        }

        .seo-service-shell {
            width: min(100% - 32px, 1120px);
            margin-inline: auto;
        }

        .seo-service-hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(280px, .85fr);
            gap: clamp(28px, 5vw, 64px);
            align-items: center;
        }

        .seo-service-label {
            margin: 0 0 14px;
            color: #06a3da;
            font-weight: 800;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .seo-service-hero h1 {
            max-width: 760px;
            margin: 0 0 20px;
            color: #fff;
            font-family: "Nunito", sans-serif;
            font-size: clamp(42px, 5vw, 64px);
            font-weight: 800;
            line-height: 1.08;
        }

        .seo-service-hero-copy {
            max-width: 690px;
            margin: 0 0 28px;
            color: rgba(255, 255, 255, .9);
            font-size: 1.08rem;
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
            border-radius: 2px;
            background: #06a3da;
            color: #fff;
            font-weight: 700;
        }

        .seo-service-button.secondary {
            border-color: rgba(255, 255, 255, .6);
            background: transparent;
        }

        .seo-service-panel {
            padding: 28px;
            background: rgba(255, 255, 255, .96);
            color: #091e3e;
            box-shadow: 0 22px 54px rgba(0, 0, 0, .18);
        }

        .seo-service-panel h2 {
            margin: 0 0 16px;
            font-size: 1.35rem;
            font-weight: 800;
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
            line-height: 1.55;
        }

        .seo-service-list span {
            color: #06a3da;
            font-weight: 800;
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
                background-image: linear-gradient(rgba(9, 30, 62, .84), rgba(9, 30, 62, .78)), url("/assets/startup2/img/optimized/carousel-1-mobile.webp");
            }
        }

        @media (max-width: 575.98px) {
            .seo-service-actions {
                display: grid;
            }

            .seo-service-button {
                width: 100%;
            }

            .seo-service-panel,
            .seo-service-card,
            .seo-service-faq {
                padding: 22px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="seo-service-hero" aria-labelledby="website-service-title">
        <div class="seo-service-shell">
            <div class="seo-service-hero-grid">
                <div>
                    <p class="seo-service-label">Jasa Pembuatan Website</p>
                    <h1 id="website-service-title">Jasa Pembuatan Website Profesional untuk Bisnis yang Ingin Tumbuh</h1>
                    <p class="seo-service-hero-copy">JASAIBNU membantu bisnis membuat website company profile, landing page, website layanan, dan sistem web yang cepat, aman, mobile-friendly, serta siap dioptimasi untuk Google.</p>
                    <div class="seo-service-actions">
                        <a class="seo-service-button" href="{{ route('contact') }}">Konsultasi Website</a>
                        <a class="seo-service-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio</a>
                    </div>
                </div>
                <aside class="seo-service-panel" aria-label="Ringkasan layanan pembuatan website">
                    <h2>Website yang kami bangun</h2>
                    <ul class="seo-service-list">
                        <li><span>✓</span> Website company profile profesional</li>
                        <li><span>✓</span> Landing page promosi dan campaign</li>
                        <li><span>✓</span> Website jasa, UMKM, dan bisnis lokal</li>
                        <li><span>✓</span> Struktur SEO, sitemap, dan schema dasar</li>
                        <li><span>✓</span> Integrasi WhatsApp, form kontak, dan analytics</li>
                    </ul>
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
