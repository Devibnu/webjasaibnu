@extends('layouts.app')

@php
    $ecommerceSiteSettings = \App\Models\SiteSetting::current();
    $canonical = route('website-development-ecommerce');
    $description = 'JASAIBNU menyediakan jasa pembuatan website toko online dari katalog WhatsApp, cart dan checkout, hingga ecommerce lengkap dan integrasi custom.';
    $whatsappMessage = "Halo JASAIBNU, saya ingin berkonsultasi mengenai website toko online.\n\nJenis bisnis:\nJumlah produk: Belum ditentukan / 1–20 / 21–100 / Lebih dari 100\nKebutuhan:\nIntegrasi yang dibutuhkan:\nCatatan:";
    $whatsappUrl = $ecommerceSiteSettings->whatsappContactUrl($whatsappMessage) ?: route('contact');
    $levels = [
        ['number' => '01', 'name' => 'Toko Online Sederhana', 'summary' => 'Untuk bisnis yang ingin merapikan produk dan tetap menerima pesanan melalui WhatsApp.', 'features' => ['Katalog produk', 'Detail produk', 'Pemesanan melalui WhatsApp']],
        ['number' => '02', 'name' => 'Toko Online Standar', 'summary' => 'Untuk bisnis yang membutuhkan alur belanja dan pembayaran langsung dari website.', 'features' => ['Katalog produk', 'Cart', 'Checkout', 'Pembayaran']],
        ['number' => '03', 'name' => 'Ecommerce Lengkap', 'summary' => 'Untuk bisnis yang perlu mengelola transaksi, pesanan, stok, dan akun pelanggan.', 'features' => ['Katalog, cart, dan checkout', 'Payment gateway atau QRIS', 'Integrasi ongkir', 'Order management', 'Stock atau inventory', 'Customer account']],
        ['number' => '04', 'name' => 'Custom Ecommerce', 'summary' => 'Untuk perusahaan dengan alur khusus atau sistem operasional yang perlu dihubungkan.', 'features' => ['Custom workflow', 'Integrasi ERP dan POS', 'Integrasi API', 'Integrasi marketplace', 'Integrasi sistem lain sesuai scope']],
    ];
    $faqs = [
        ['Apa perbedaan toko online sederhana dan ecommerce lengkap?', 'Toko online sederhana berfokus pada katalog, detail produk, dan pemesanan melalui WhatsApp. Ecommerce lengkap dapat mencakup cart, checkout, pembayaran, ongkir, pengelolaan pesanan dan stok, serta akun pelanggan sesuai scope.'],
        ['Apakah website dapat memiliki cart dan checkout?', 'Ya. Cart dan checkout tersedia untuk Toko Online Standar dan Ecommerce Lengkap, dengan alur yang ditentukan berdasarkan kebutuhan transaksi bisnis.'],
        ['Apakah website dapat menerima pembayaran online dan QRIS?', 'Ya. Pembayaran, payment gateway, atau QRIS dapat disiapkan sesuai tingkat layanan dan ruang lingkup integrasi yang disepakati.'],
        ['Apakah ongkir dapat diintegrasikan ke website?', 'Ya. Integrasi ongkir dapat disiapkan untuk Ecommerce Lengkap sesuai kebutuhan pengiriman dan ruang lingkup project.'],
        ['Apakah produk, pesanan, dan stok dapat dikelola sendiri?', 'Ya. Pengelolaan produk, pesanan, dan stok dapat disiapkan melalui CMS atau admin panel sesuai tingkat layanan dan scope.'],
        ['Apakah pelanggan dapat memiliki akun?', 'Ya. Customer account dapat menjadi bagian dari Ecommerce Lengkap jika diperlukan dalam alur transaksi dan layanan pelanggan.'],
        ['Bisakah ecommerce diintegrasikan dengan ERP, POS, API, atau marketplace?', 'Bisa. Integrasi ERP, POS, API, marketplace, dan sistem bisnis lain dapat dikembangkan melalui Custom Ecommerce setelah kebutuhan dan sistem yang terlibat dipetakan.'],
        ['Apakah website toko online responsive dan memiliki fondasi SEO?', 'Website dapat disiapkan responsive dan mobile-friendly dengan fondasi SEO teknis seperti metadata, heading, canonical, sitemap, dan struktur halaman sesuai scope. Fondasi tersebut tidak menjamin posisi tertentu di hasil pencarian.'],
        ['Berapa lama pembuatan website toko online?', 'Durasi ditentukan setelah jumlah produk, fitur, integrasi, kesiapan materi, dan alur bisnis dipetakan. Timeline kemudian disepakati berdasarkan ruang lingkup project.'],
        ['Berapa biaya pembuatan website toko online?', 'Biaya ditentukan berdasarkan tingkat solusi, fitur, integrasi, jumlah produk, serta kebutuhan pengelolaan. Penawaran disusun setelah kebutuhan utama dipahami.'],
        ['Apakah tersedia maintenance dan support setelah website online?', 'Kebutuhan maintenance dan support dibahas sesuai ruang lingkup atau kesepakatan project setelah website go-live.'],
    ];
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $canonical . '#service',
        'url' => $canonical,
        'name' => 'Jasa Pembuatan Website Toko Online',
        'serviceType' => 'Jasa pembuatan website toko online dan ecommerce',
        'description' => $description,
        'areaServed' => ['@type' => 'Country', 'name' => 'Indonesia'],
        'provider' => ['@id' => rtrim(route('home'), '/') . '#professional-service'],
    ];
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        '@id' => $canonical . '#faq',
        'mainEntity' => collect($faqs)->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
        ])->values()->all(),
    ];
@endphp

@section('title', 'Jasa Pembuatan Website Toko Online & Ecommerce | JASAIBNU')
@section('meta_description', $description)
@section('canonical', $canonical)
@section('robots', 'index,follow')
@section('body_class', 'startup2-home ecommerce-service-page')

@push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .ecommerce-service-page { --ec-navy:#071b36; --ec-blue:#0967d2; --ec-cyan:#00aee8; --ec-pale:#f4f9fe; --ec-line:#dce9f6; --ec-muted:#52677f; color:#172b44; font-family:"Rubik",sans-serif; overflow-x:hidden; }
        .ec-shell { width:min(100% - 40px,1160px); margin-inline:auto; }
        .ec-hero { position:relative; padding:clamp(72px,9vw,118px) 0; overflow:hidden; background:linear-gradient(135deg,#071b36 0%,#0a315c 100%); color:#fff; }
        .ec-hero::after { position:absolute; inset:auto -10% -45% auto; width:520px; height:520px; border:1px solid rgba(0,174,232,.18); border-radius:50%; content:""; }
        .ec-hero-grid { position:relative; z-index:1; display:grid; grid-template-columns:minmax(0,1.08fr) minmax(380px,.92fr); gap:64px; align-items:center; }
        .ec-kicker,.ec-eyebrow { margin:0 0 14px; color:var(--ec-cyan); font:800 .78rem/1.2 "Nunito",sans-serif; letter-spacing:.14em; text-transform:uppercase; }
        .ec-hero h1 { max-width:790px; margin:0; color:#fff; font-size:clamp(2.35rem,5vw,4.35rem); line-height:1.04; letter-spacing:-.045em; }
        .ec-hero-copy { max-width:720px; margin:24px 0 0; color:#dcecff; font-size:clamp(1rem,1.6vw,1.16rem); line-height:1.75; }
        .ec-actions { display:flex; flex-wrap:wrap; gap:12px; margin-top:30px; }
        .ec-button { display:inline-flex; min-height:50px; align-items:center; justify-content:center; padding:13px 22px; border:1px solid var(--ec-cyan); border-radius:10px; background:var(--ec-cyan); color:#03182e; font-weight:800; text-decoration:none; box-shadow:0 10px 24px rgba(0,174,232,.16); transition:transform .2s ease,box-shadow .2s ease,background .2s ease; }
        .ec-button:hover { transform:translateY(-2px); color:#03182e; box-shadow:0 14px 30px rgba(0,174,232,.24); }
        .ec-button.secondary { border-color:rgba(255,255,255,.42); background:transparent; color:#fff; }
        .ec-button:focus-visible,.ec-table-wrap:focus-visible,.ec-faq summary:focus-visible,.ec-solution-link:focus-visible { outline:3px solid #ffd65a; outline-offset:3px; }
        .ec-solution-link { display:inline-block; margin-top:18px; color:#bcecff; font-weight:700; text-underline-offset:4px; }
        .ec-trust-list { display:flex; flex-wrap:wrap; gap:10px 18px; margin:28px 0 0; padding:0; list-style:none; color:#dcecff; font-size:.88rem; }
        .ec-trust-list li::before { margin-right:8px; color:var(--ec-cyan); content:"✓"; font-weight:800; }
        .ec-storefront { position:relative; padding:14px; border:1px solid rgba(255,255,255,.18); border-radius:22px; background:rgba(255,255,255,.09); box-shadow:0 28px 70px rgba(0,0,0,.28); }
        .ec-browser { overflow:hidden; border-radius:15px; background:#fff; color:var(--ec-navy); }
        .ec-browser-bar { display:flex; gap:6px; padding:12px 14px; border-bottom:1px solid var(--ec-line); background:#f5f8fb; }
        .ec-browser-bar i { width:7px; height:7px; border-radius:50%; background:#b8c6d4; }
        .ec-browser-body { padding:20px; }
        .ec-browser-head { display:flex; align-items:center; justify-content:space-between; gap:12px; }
        .ec-browser-head strong { font-size:.95rem; }
        .ec-browser-head span { padding:6px 9px; border-radius:8px; background:#e8f7fd; color:#0879a1; font-size:.72rem; font-weight:800; }
        .ec-product-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-top:18px; }
        .ec-product { padding:8px; border:1px solid var(--ec-line); border-radius:10px; }
        .ec-product-image { height:64px; border-radius:7px; background:#eaf3fb; }
        .ec-product b,.ec-product small { display:block; }
        .ec-product b { margin-top:8px; font-size:.66rem; }
        .ec-product small { margin-top:4px; color:#657a90; font-size:.56rem; }
        .ec-commerce-bar { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-top:14px; }
        .ec-commerce-bar div { padding:11px; border-radius:9px; background:var(--ec-pale); }
        .ec-commerce-bar small,.ec-commerce-bar strong { display:block; }
        .ec-commerce-bar small { color:#6d8094; font-size:.58rem; }
        .ec-commerce-bar strong { margin-top:3px; font-size:.72rem; }
        .ec-order-card { position:absolute; right:-24px; bottom:32px; width:155px; padding:14px; border:1px solid var(--ec-line); border-radius:13px; background:#fff; color:var(--ec-navy); box-shadow:0 18px 40px rgba(0,0,0,.2); }
        .ec-order-card span { display:block; color:#60758a; font-size:.64rem; }
        .ec-order-card strong { display:block; margin-top:4px; font-size:.82rem; }
        .ec-order-card i { display:block; height:5px; margin-top:10px; border-radius:5px; background:linear-gradient(90deg,var(--ec-cyan) 72%,#e4edf5 72%); }
        .ec-section { padding:clamp(64px,8vw,104px) 0; }
        .ec-section.alt { background:var(--ec-pale); }
        .ec-heading { max-width:820px; margin-bottom:36px; }
        .ec-heading h2 { margin:0; color:var(--ec-navy); font-size:clamp(1.85rem,3.6vw,3rem); line-height:1.14; letter-spacing:-.035em; }
        .ec-heading > p:last-child { margin:18px 0 0; color:#52677f; line-height:1.75; }
        .ec-problem-grid,.ec-audience-grid,.ec-foundation-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:18px; }
        .ec-card { padding:26px; border:1px solid var(--ec-line); border-radius:16px; background:#fff; box-shadow:0 12px 34px rgba(20,60,100,.06); transition:transform .2s ease,border-color .2s ease; }
        .ec-card:hover { transform:translateY(-3px); border-color:#b6d6f1; }
        .ec-card strong { display:block; margin-bottom:12px; color:var(--ec-blue); }
        .ec-card h3 { margin:0 0 10px; color:var(--ec-navy); font-size:1.12rem; }
        .ec-card p { margin:0; color:#5a6e84; line-height:1.65; }
        .ec-level-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; }
        .ec-level { display:flex; min-width:0; flex-direction:column; padding:24px; border:1px solid var(--ec-line); border-radius:18px; background:#fff; box-shadow:0 12px 32px rgba(20,60,100,.05); }
        .ec-level-number { display:grid; width:54px; height:54px; place-items:center; border-radius:14px; background:var(--ec-navy); color:#fff; font-weight:800; }
        .ec-level h3 { margin:20px 0 8px; color:var(--ec-navy); font-size:1.15rem; }
        .ec-level p { margin:0 0 14px; color:#5a6e84; line-height:1.6; }
        .ec-level ul { margin:0 0 22px; padding-left:20px; color:#314b67; font-size:.9rem; line-height:1.7; }
        .ec-level .ec-level-content { display:flex; height:100%; flex-direction:column; }
        .ec-level .ec-button { width:100%; margin-top:auto; text-align:center; }
        .ec-level .ec-button { min-height:44px; padding:9px 16px; font-size:.9rem; }
        .ec-table-wrap { overflow-x:auto; border:1px solid var(--ec-line); border-radius:16px; background:#fff; -webkit-overflow-scrolling:touch; }
        .ec-table { width:100%; min-width:760px; border-collapse:collapse; text-align:center; }
        .ec-table th,.ec-table td { padding:16px 14px; border-bottom:1px solid var(--ec-line); }
        .ec-table th { background:var(--ec-navy); color:#fff; font-size:.9rem; }
        .ec-table th:first-child,.ec-table td:first-child { position:sticky; left:0; z-index:1; text-align:left; }
        .ec-table th:first-child { background:var(--ec-navy); }
        .ec-table td:first-child { background:#fff; color:var(--ec-navy); font-weight:700; }
        .ec-table tr:last-child td { border-bottom:0; }
        .ec-yes { color:#08783e; font-weight:800; }
        .ec-na { color:#8291a2; }
        .ec-flow-grid { display:grid; grid-template-columns:1fr 1fr; gap:24px; }
        .ec-flow-card { padding:30px; border-radius:18px; background:var(--ec-navy); color:#fff; }
        .ec-flow-card h3 { margin:0 0 22px; font-size:1.35rem; }
        .ec-flow-steps { display:flex; flex-wrap:wrap; gap:10px; align-items:center; }
        .ec-flow-steps span { padding:9px 12px; border:1px solid rgba(255,255,255,.18); border-radius:8px; background:rgba(255,255,255,.08); }
        .ec-flow-note { margin:18px 0 0; color:#cfe1f4; line-height:1.6; }
        .ec-process { display:grid; grid-template-columns:repeat(5,minmax(0,1fr)); gap:16px; counter-reset:process; }
        .ec-process article { position:relative; padding:24px 20px; border-top:3px solid var(--ec-cyan); background:#fff; box-shadow:0 10px 30px rgba(20,60,100,.07); }
        .ec-process span { color:var(--ec-blue); font-weight:800; }
        .ec-process h3 { margin:12px 0 8px; color:var(--ec-navy); font-size:1rem; }
        .ec-process p { margin:0; color:#5a6e84; font-size:.9rem; line-height:1.6; }
        .ec-integration { display:grid; grid-template-columns:minmax(0,1fr) minmax(320px,.72fr); gap:42px; align-items:center; }
        .ec-integration-list { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
        .ec-integration-list div { padding:18px; border:1px solid var(--ec-line); border-radius:12px; background:#fff; color:var(--ec-navy); font-weight:700; }
        .ec-integration-aside { padding:30px; border-radius:18px; background:var(--ec-navy); color:#fff; }
        .ec-integration-aside h3 { margin-top:0; }
        .ec-integration-aside p { margin-bottom:0; color:#d6e6f6; line-height:1.7; }
        .ec-faq { display:grid; gap:12px; }
        .ec-faq details { border:1px solid var(--ec-line); border-radius:12px; background:#fff; }
        .ec-faq summary { position:relative; padding:20px 58px 20px 22px; color:var(--ec-navy); font-weight:800; cursor:pointer; list-style:none; }
        .ec-faq summary::-webkit-details-marker { display:none; }
        .ec-faq summary::after { position:absolute; top:50%; right:22px; color:var(--ec-blue); content:"+"; font-size:1.5rem; line-height:1; transform:translateY(-50%); }
        .ec-faq details[open] summary::after { content:"−"; }
        .ec-faq details p { margin:0; padding:0 22px 22px; color:#52677f; line-height:1.7; }
        .ec-final { padding:64px 0; background:#073764; color:#fff; }
        .ec-final-row { display:flex; gap:32px; align-items:center; justify-content:space-between; }
        .ec-final h2 { max-width:720px; margin:0; font-size:clamp(1.8rem,3.5vw,2.8rem); }
        .ec-final p { max-width:700px; margin:14px 0 0; color:#dcecff; line-height:1.7; }
        .ec-final .ec-button { flex:0 0 auto; }
        .ec-portfolio-link { margin-top:28px; }
        @media (max-width:1100px) { .ec-level-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media (max-width:1024px) { .ec-hero-grid { grid-template-columns:1fr; gap:46px; } .ec-storefront { max-width:700px; } .ec-problem-grid,.ec-audience-grid,.ec-foundation-grid { grid-template-columns:repeat(2,1fr); } .ec-process { grid-template-columns:repeat(3,1fr); } }
        @media (min-width:769px) { .ec-table-wrap { overflow-x:visible; } .ec-table { min-width:0; } }
        @media (max-width:768px) { .ec-shell { width:min(100% - 30px,1160px); } .ec-flow-grid,.ec-integration { grid-template-columns:1fr; } .ec-process { grid-template-columns:1fr 1fr; } .ec-final-row { align-items:flex-start; flex-direction:column; } .ec-order-card { right:-4px; } }
        @media (max-width:560px) { .ec-level-grid { grid-template-columns:1fr; } }
        @media (max-width:480px) { .ec-hero { padding:58px 0 68px; } .ec-hero h1 { font-size:clamp(2rem,11vw,2.7rem); } .ec-actions,.ec-actions .ec-button { width:100%; } .ec-problem-grid,.ec-audience-grid,.ec-foundation-grid,.ec-process,.ec-integration-list { grid-template-columns:1fr; } .ec-card,.ec-level { padding:22px; } .ec-storefront { padding:9px; } .ec-browser-body { padding:14px; } .ec-order-card { display:none; } }
        @media (prefers-reduced-motion:reduce) { .ec-button,.ec-card { transition:none; } }
    </style>
    <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="ec-hero" aria-labelledby="ecommerce-service-title">
        <div class="ec-shell ec-hero-grid">
            <div>
                <p class="ec-kicker">Solusi ecommerce nasional</p>
                <h1 id="ecommerce-service-title">Jasa Pembuatan Website Toko Online untuk Sistem Penjualan yang Sesuai Bisnis Anda</h1>
                <p class="ec-hero-copy">Mulai dari katalog dengan pemesanan WhatsApp, toko online standar dengan cart dan checkout, ecommerce lengkap, hingga integrasi custom untuk kebutuhan operasional yang lebih kompleks.</p>
                <div class="ec-actions">
                    <a class="ec-button" href="{{ $whatsappUrl }}" @if(str_starts_with($whatsappUrl, 'http')) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Toko Online Anda</a>
                    <a class="ec-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a>
                </div>
                <a class="ec-solution-link" href="#jenis-solusi">Pilih Jenis Solusi ↓</a>
                <ul class="ec-trust-list" aria-label="Pendekatan layanan"><li>Empat tingkat solusi</li><li>Scope sesuai kebutuhan</li><li>Konsultasi sebelum development</li></ul>
            </div>
            <div class="ec-storefront" aria-hidden="true">
                <div class="ec-browser">
                    <div class="ec-browser-bar"><i></i><i></i><i></i></div>
                    <div class="ec-browser-body">
                        <div class="ec-browser-head"><strong>Katalog Produk</strong><span>Cart · Checkout</span></div>
                        <div class="ec-product-grid">
                            @foreach(['Produk A','Produk B','Produk C'] as $product)<div class="ec-product"><div class="ec-product-image"></div><b>{{ $product }}</b><small>Detail produk</small></div>@endforeach
                        </div>
                        <div class="ec-commerce-bar"><div><small>Pengelolaan</small><strong>Order & stok</strong></div><div><small>Integrasi</small><strong>Payment & ongkir</strong></div></div>
                    </div>
                </div>
                <div class="ec-order-card"><span>Alur ecommerce</span><strong>Sesuai proses bisnis</strong><i></i></div>
            </div>
        </div>
    </section>

    <section class="ec-section" aria-labelledby="business-value-title">
        <div class="ec-shell">
            <div class="ec-heading"><p class="ec-eyebrow">Dari katalog ke operasional</p><h2 id="business-value-title">Toko online perlu mengikuti cara bisnis Anda menerima dan mengelola pesanan.</h2><p>Sistem yang tepat dimulai dari proses bisnis, bukan dari daftar fitur yang sama untuk semua kebutuhan.</p></div>
            <div class="ec-problem-grid">
                <article class="ec-card"><strong>01</strong><h3>Katalog dan order</h3><p>Produk perlu mudah ditemukan, dipahami, dan diarahkan ke jalur pemesanan yang sesuai.</p></article>
                <article class="ec-card"><strong>02</strong><h3>Checkout</h3><p>Ketika transaksi bertambah, cart dan checkout membantu menyusun alur belanja yang lebih terstruktur.</p></article>
                <article class="ec-card"><strong>03</strong><h3>Order dan stok</h3><p>Pengelolaan pesanan dan inventory menjadi relevan saat operasional tidak lagi cukup ditangani melalui chat.</p></article>
                <article class="ec-card"><strong>04</strong><h3>Integrasi sistem</h3><p>ERP, POS, API, marketplace, atau sistem lain dapat dihubungkan ketika proses bisnis berkembang.</p></article>
            </div>
        </div>
    </section>

    <section class="ec-section alt" id="jenis-solusi" aria-labelledby="solution-level-title">
        <div class="ec-shell">
            <div class="ec-heading"><p class="ec-eyebrow">Empat tingkat solusi</p><h2 id="solution-level-title">Pilih tingkat toko online sesuai alur penjualan Anda.</h2><p>Setiap pilihan menjadi titik awal diskusi. Fitur akhir tetap ditetapkan melalui pemetaan kebutuhan dan scope.</p></div>
            <div class="ec-level-grid">
                @foreach($levels as $level)
                    @php $levelMessage = $whatsappMessage . "\n\nPilihan awal: " . $level['name']; $levelUrl = $ecommerceSiteSettings->whatsappContactUrl($levelMessage) ?: route('contact'); @endphp
                    <article class="ec-level">
                        <span class="ec-level-number">{{ $level['number'] }}</span>
                        <div class="ec-level-content"><h3>{{ $level['name'] }}</h3><p>{{ $level['summary'] }}</p><ul>@foreach($level['features'] as $feature)<li>{{ $feature }}</li>@endforeach</ul><a class="ec-button" href="{{ $levelUrl }}" @if(str_starts_with($levelUrl, 'http')) target="_blank" rel="noopener noreferrer" @endif>{{ $level['number'] === '04' ? 'Diskusikan Custom Ecommerce' : 'Konsultasikan ' . $level['name'] }}</a></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ec-section" aria-labelledby="feature-comparison-title">
        <div class="ec-shell">
            <div class="ec-heading"><p class="ec-eyebrow">Perbandingan kapabilitas</p><h2 id="feature-comparison-title">Bandingkan fitur setiap tingkat toko online.</h2><p>Tabel dapat digeser secara horizontal pada layar kecil.</p></div>
            <div class="ec-table-wrap" role="region" aria-label="Perbandingan fitur toko online" tabindex="0">
                <table class="ec-table"><thead><tr><th>Kapabilitas</th><th>Sederhana</th><th>Standar</th><th>Lengkap</th><th>Custom</th></tr></thead><tbody>
                    @foreach([
                        ['Katalog dan detail produk',1,1,1,1], ['Order WhatsApp',1,0,0,0], ['Cart dan checkout',0,1,1,1], ['Pembayaran',0,1,1,1], ['Payment gateway atau QRIS',0,0,1,1], ['Integrasi ongkir',0,0,1,1], ['Order management',0,0,1,1], ['Stock atau inventory',0,0,1,1], ['Customer account',0,0,1,1], ['ERP, POS, API, atau marketplace',0,0,0,1]
                    ] as $row)
                        <tr><td>{{ $row[0] }}</td>@foreach(array_slice($row,1) as $available)<td class="{{ $available ? 'ec-yes' : 'ec-na' }}">{{ $available ? 'Tersedia' : '—' }}</td>@endforeach</tr>
                    @endforeach
                </tbody></table>
            </div>
        </div>
    </section>

    <section class="ec-section alt" aria-labelledby="audience-title"><div class="ec-shell"><div class="ec-heading"><p class="ec-eyebrow">Kebutuhan yang berbeda</p><h2 id="audience-title">Solusi toko online untuk kebutuhan bisnis yang berbeda.</h2></div><div class="ec-audience-grid"><article class="ec-card"><h3>Merapikan katalog</h3><p>Untuk bisnis yang ingin menyajikan produk secara rapi dan mempertahankan order melalui WhatsApp.</p></article><article class="ec-card"><h3>Menggunakan checkout</h3><p>Untuk brand yang ingin pelanggan memilih produk dan menyelesaikan pesanan dari website.</p></article><article class="ec-card"><h3>Mengelola order dan stok</h3><p>Untuk bisnis yang membutuhkan proses pesanan, inventory, dan akun pelanggan dalam sistem.</p></article><article class="ec-card"><h3>Menghubungkan operasional</h3><p>Untuk perusahaan yang memerlukan ecommerce terhubung dengan sistem bisnis lain.</p></article></div></div></section>

    <section class="ec-section" aria-labelledby="commerce-flow-title"><div class="ec-shell"><div class="ec-heading"><p class="ec-eyebrow">Dua sisi satu sistem</p><h2 id="commerce-flow-title">Rancang alur belanja pelanggan dan alur kerja tim dalam satu scope.</h2><p>Tahapan yang digunakan mengikuti tingkat layanan; tidak setiap solusi memerlukan seluruh langkah.</p></div><div class="ec-flow-grid"><article class="ec-flow-card"><h3>Sisi pelanggan</h3><div class="ec-flow-steps"><span>Katalog</span><b>→</b><span>Produk</span><b>→</b><span>Cart atau WhatsApp</span><b>→</b><span>Checkout</span><b>→</b><span>Pembayaran</span></div><p class="ec-flow-note">Pada toko sederhana, pelanggan dapat langsung berpindah dari detail produk ke WhatsApp tanpa cart dan checkout.</p></article><article class="ec-flow-card"><h3>Sisi operasional</h3><div class="ec-flow-steps"><span>Produk</span><b>→</b><span>Stok</span><b>→</b><span>Order</span><b>→</b><span>Status</span><b>→</b><span>Integrasi</span></div><p class="ec-flow-note">Pengelolaan stok, order, status, dan integrasi digunakan pada level yang membutuhkannya.</p></article></div></div></section>

    <section class="ec-section alt" aria-labelledby="development-process-title"><div class="ec-shell"><div class="ec-heading"><p class="ec-eyebrow">Proses pengembangan</p><h2 id="development-process-title">Proses pengembangan dimulai dari pemetaan kebutuhan.</h2></div><div class="ec-process">@foreach([['Konsultasi','Memahami produk, pelanggan, transaksi, dan proses operasional.'],['Perencanaan','Memilih tingkat solusi serta fungsi yang benar-benar diperlukan.'],['Pengembangan','Menyusun pengalaman pelanggan dan pengelolaan sistem.'],['Pengujian','Memeriksa alur yang termasuk dalam scope sebelum peluncuran.'],['Go Live','Menyiapkan peluncuran serta akses pengelolaan sesuai kesepakatan.']] as $index => $step)<article><span>0{{ $index + 1 }}</span><h3>{{ $step[0] }}</h3><p>{{ $step[1] }}</p></article>@endforeach</div></div></section>

    <section class="ec-section" aria-labelledby="integration-title"><div class="ec-shell ec-integration"><div><div class="ec-heading"><p class="ec-eyebrow">Custom ecommerce</p><h2 id="integration-title">Integrasi ecommerce untuk kebutuhan operasional yang lebih kompleks.</h2><p>Custom Ecommerce digunakan ketika website perlu mengikuti workflow khusus atau bertukar data dengan sistem lain.</p></div><div class="ec-integration-list"><div>ERP integration</div><div>POS integration</div><div>API integration</div><div>Marketplace integration</div><div>Custom workflow</div><div>Sistem lain sesuai scope</div></div></div><aside class="ec-integration-aside"><h3>Discovery sebelum integrasi</h3><p>Sistem, data, hak akses, dependensi, dan alur operasional perlu dipetakan sebelum scope integrasi ditetapkan. Integrasi tidak diasumsikan kompatibel dengan provider tertentu tanpa pemeriksaan teknis.</p></aside></div></section>

    <section class="ec-section alt" aria-labelledby="technical-foundation-title"><div class="ec-shell"><div class="ec-heading"><p class="ec-eyebrow">Fondasi teknis</p><h2 id="technical-foundation-title">Fondasi website untuk pelanggan dan pengelola.</h2><p>Detail implementasi mengikuti level layanan dan ruang lingkup yang disepakati.</p></div><div class="ec-foundation-grid"><article class="ec-card"><h3>Responsive</h3><p>Tampilan disiapkan agar nyaman digunakan pada perangkat mobile dan desktop.</p></article><article class="ec-card"><h3>CMS atau admin</h3><p>Akses pengelolaan dapat disiapkan sesuai konten, produk, dan data yang termasuk dalam scope.</p></article><article class="ec-card"><h3>Fondasi SEO teknis</h3><p>Metadata, heading, canonical, sitemap, dan struktur halaman dapat disiapkan tanpa menjanjikan ranking.</p></article><article class="ec-card"><h3>Security dan maintainability</h3><p>Validasi dan keamanan dasar disiapkan agar sistem lebih mudah diuji, dirawat, dan dikembangkan.</p></article></div><p class="ec-portfolio-link"><a href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a></p></div></section>

    <section class="ec-section" aria-labelledby="ecommerce-faq-title"><div class="ec-shell"><div class="ec-heading"><p class="ec-eyebrow">FAQ ecommerce</p><h2 id="ecommerce-faq-title">Pertanyaan umum sebelum membangun toko online.</h2></div><div class="ec-faq">@foreach($faqs as [$question,$answer])<details class="ec-faq-item"><summary>{{ $question }}</summary><p>{{ $answer }}</p></details>@endforeach</div></div></section>

    <section class="ec-final" aria-labelledby="ecommerce-final-title"><div class="ec-shell ec-final-row"><div><h2 id="ecommerce-final-title">Diskusikan toko online yang sesuai dengan proses bisnis Anda.</h2><p>Ceritakan jenis bisnis, jumlah produk, kebutuhan transaksi, dan integrasi yang diperlukan. Jika WhatsApp tidak tersedia, konsultasi tetap dapat dimulai melalui halaman contact.</p></div><a class="ec-button" href="{{ $whatsappUrl }}" @if(str_starts_with($whatsappUrl, 'http')) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Toko Online Anda</a></div></section>
@endsection
