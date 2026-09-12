@extends('layouts.app')

@php
    $canonical = route('landing-page-development');
    $metaDescription = 'JASAIBNU menyediakan jasa pembuatan landing page profesional untuk campaign, penawaran, dan lead capture dengan desain responsif, CTA jelas, serta fondasi SEO.';
    $landingPageSettings = \App\Models\SiteSetting::current();
    $whatsappMessage = "Halo JASAIBNU, saya ingin berkonsultasi mengenai landing page.\n\nCampaign atau penawaran:\nTarget audiens:\nAksi utama yang diharapkan:\nCatatan:";
    $consultationUrl = $landingPageSettings->whatsappContactUrl($whatsappMessage) ?: route('contact');
    $consultationExternal = str_starts_with($consultationUrl, 'http');
    $faqs = [
        ['Apa itu landing page?', 'Landing page adalah satu halaman yang disusun untuk satu campaign, penawaran, pendaftaran, atau tindakan utama agar pesan dan jalur respons tetap terarah.'],
        ['Apa perbedaan landing page dan website biasa?', 'Landing page berfokus pada satu tujuan dan satu alur tindakan. Website biasa dapat memiliki beberapa halaman, kelompok informasi, serta tujuan yang lebih luas untuk kebutuhan bisnis.'],
        ['Kapan bisnis membutuhkan landing page?', 'Landing page sesuai ketika bisnis memiliki campaign, peluncuran produk atau layanan, pendaftaran, penawaran tertentu, atau kebutuhan lead capture dengan tujuan yang sudah jelas.'],
        ['Apakah landing page dapat diarahkan ke WhatsApp?', 'Bisa. WhatsApp dapat menjadi CTA utama atau pendamping sesuai alur komunikasi, nomor tujuan, dan pesan awal yang disepakati dalam ruang lingkup project.'],
        ['Apakah landing page dapat memakai formulir?', 'Bisa. Field, validasi, notifikasi, penyimpanan data, dan kebutuhan privasi formulir ditentukan berdasarkan data yang perlu dikumpulkan serta ruang lingkup project.'],
        ['Apakah landing page dapat digunakan untuk Google Ads atau Meta Ads?', 'Landing page dapat disiapkan sebagai tujuan campaign. Pengaturan dan pengelolaan Google Ads atau Meta Ads serta hasil iklannya bukan bagian layanan ini kecuali disepakati secara terpisah.'],
        ['Apakah analytics atau conversion tracking termasuk?', 'Integrasi analytics atau tracking dapat dibahas setelah tools, akun, event, kebutuhan consent, dan akses teknis dipetakan. Implementasinya mengikuti ruang lingkup yang disepakati.'],
        ['Apakah domain dan hosting termasuk?', 'Penyediaan domain, hosting, SSL, akses, kepemilikan, dan biaya perpanjangan dijelaskan dalam penawaran karena kebutuhan setiap project dapat berbeda.'],
        ['Apakah konten harus disiapkan oleh klien?', 'Klien perlu menyediakan informasi penawaran, identitas bisnis, materi visual, dan data yang akurat. Bantuan struktur konten atau copy mengikuti ruang lingkup yang disepakati.'],
        ['Apakah tersedia revisi?', 'Tahap review, jumlah atau batas revisi, serta materi yang dapat diubah ditetapkan dalam ruang lingkup agar proses desain dan development tetap terarah.'],
        ['Apakah landing page memiliki fondasi SEO?', 'Landing page dapat disiapkan dengan metadata, struktur heading, canonical, robots, sitemap, dan struktur semantik sebagai fondasi teknis tanpa menjanjikan ranking tertentu.'],
        ['Apakah tersedia maintenance atau integrasi custom?', 'Maintenance dan integrasi custom dapat dievaluasi berdasarkan sistem terkait, ketersediaan akses, dependensi teknis, serta tanggung jawab operasional yang disepakati.'],
    ];
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $canonical . '#service',
        'url' => $canonical,
        'name' => 'Jasa Pembuatan Landing Page Profesional untuk Campaign Bisnis',
        'description' => $metaDescription,
        'serviceType' => 'Jasa pembuatan landing page',
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

@section('title', 'Jasa Pembuatan Landing Page Profesional | JASAIBNU')
@section('meta_description', $metaDescription)
@section('canonical', $canonical)
@section('robots', 'index,follow')
@section('body_class', 'startup2-home landing-page-development-page')

@push('head')
    <style>
        .landing-page-development-page { --lp-navy: #071a33; --lp-blue: #06a3da; --lp-ink: #26364a; --lp-muted: #627084; --lp-line: #d8e4ea; --lp-soft: #f4f8fa; color: var(--lp-ink); overflow-x: hidden; }
        .landing-page-development-page .lp-shell { width: min(100% - 48px, 1180px); margin-inline: auto; }
        .landing-page-development-page .lp-hero { padding: 78px 0 70px; background: #fff; }
        .landing-page-development-page .lp-hero-grid { display: grid; grid-template-columns: minmax(0, 1.08fr) minmax(360px, .92fr); gap: 68px; align-items: center; }
        .landing-page-development-page .lp-eyebrow { margin: 0 0 13px; color: var(--lp-blue); font-size: .8rem; font-weight: 800; text-transform: uppercase; }
        .landing-page-development-page .lp-hero h1 { max-width: 720px; margin: 0; color: var(--lp-navy); font-size: clamp(2.45rem, 4vw, 4.2rem); line-height: 1.08; letter-spacing: 0; }
        .landing-page-development-page .lp-hero-copy { max-width: 690px; margin: 22px 0 0; color: var(--lp-muted); font-size: 1.08rem; line-height: 1.75; }
        .landing-page-development-page .lp-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; }
        .landing-page-development-page .lp-button { display: inline-flex; min-height: 48px; align-items: center; justify-content: center; padding: 12px 20px; border: 1px solid var(--lp-blue); border-radius: 4px; background: var(--lp-blue); color: #fff; font-weight: 700; text-decoration: none; }
        .landing-page-development-page .lp-button:hover { border-color: #078ab7; background: #078ab7; color: #fff; }
        .landing-page-development-page .lp-button.secondary { border-color: #adc3cf; background: #fff; color: var(--lp-navy); }
        .landing-page-development-page .lp-blueprint { padding: 28px; border: 1px solid var(--lp-line); border-radius: 7px; background: var(--lp-soft); }
        .landing-page-development-page .lp-blueprint strong { display: block; margin-bottom: 18px; color: var(--lp-navy); font-size: 1.08rem; }
        .landing-page-development-page .lp-blueprint-flow { display: grid; gap: 9px; }
        .landing-page-development-page .lp-blueprint-flow span { padding: 11px 13px; border-left: 3px solid var(--lp-blue); background: #fff; color: #425269; font-size: .9rem; }
        .landing-page-development-page .lp-value-strip { border-top: 1px solid var(--lp-line); border-bottom: 1px solid var(--lp-line); background: var(--lp-navy); }
        .landing-page-development-page .lp-values { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .landing-page-development-page .lp-values div { min-width: 0; padding: 21px 24px; color: #dce7f1; text-align: center; }
        .landing-page-development-page .lp-values div + div { border-left: 1px solid rgba(255,255,255,.14); }
        .landing-page-development-page .lp-values strong { color: #fff; font-size: .94rem; }
        .landing-page-development-page .lp-section { padding: 76px 0; }
        .landing-page-development-page .lp-section.alt { background: var(--lp-soft); }
        .landing-page-development-page .lp-heading { max-width: 780px; margin-bottom: 34px; }
        .landing-page-development-page .lp-heading.center { margin-inline: auto; text-align: center; }
        .landing-page-development-page .lp-heading h2 { margin: 0 0 13px; color: var(--lp-navy); font-size: clamp(1.75rem, 2.5vw, 2.55rem); line-height: 1.2; letter-spacing: 0; }
        .landing-page-development-page .lp-heading p:last-child { margin-bottom: 0; color: var(--lp-muted); line-height: 1.72; }
        .landing-page-development-page .lp-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .landing-page-development-page .lp-card { min-width: 0; padding: 25px; border: 1px solid var(--lp-line); border-radius: 6px; background: #fff; }
        .landing-page-development-page .lp-card h3 { margin: 0 0 9px; color: var(--lp-navy); font-size: 1.05rem; letter-spacing: 0; }
        .landing-page-development-page .lp-card p { margin: 0; color: var(--lp-muted); line-height: 1.65; }
        .landing-page-development-page .lp-comparison { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); border: 1px solid var(--lp-line); background: #fff; }
        .landing-page-development-page .lp-comparison article { padding: 31px; }
        .landing-page-development-page .lp-comparison article + article { border-left: 1px solid var(--lp-line); }
        .landing-page-development-page .lp-comparison h3 { margin: 0 0 15px; color: var(--lp-navy); font-size: 1.25rem; }
        .landing-page-development-page .lp-list { display: grid; gap: 10px; margin: 0; padding: 0; list-style: none; }
        .landing-page-development-page .lp-list li { position: relative; padding-left: 20px; color: var(--lp-muted); line-height: 1.55; }
        .landing-page-development-page .lp-list li::before { position: absolute; left: 0; color: var(--lp-blue); content: "\2713"; font-weight: 800; }
        .landing-page-development-page .lp-flow { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); border-top: 1px solid var(--lp-line); border-bottom: 1px solid var(--lp-line); }
        .landing-page-development-page .lp-flow article { min-width: 0; padding: 24px 16px; }
        .landing-page-development-page .lp-flow article + article { border-left: 1px solid var(--lp-line); }
        .landing-page-development-page .lp-flow span { color: var(--lp-blue); font-size: .76rem; font-weight: 800; }
        .landing-page-development-page .lp-flow h3 { margin: 8px 0 0; color: var(--lp-navy); font-size: .96rem; }
        .landing-page-development-page .lp-split { display: grid; grid-template-columns: minmax(0, .82fr) minmax(0, 1.18fr); gap: 56px; align-items: start; }
        .landing-page-development-page .lp-split .lp-heading { margin-bottom: 0; }
        .landing-page-development-page .lp-boundary { display: grid; gap: 14px; }
        .landing-page-development-page .lp-boundary article { padding: 21px 23px; border-left: 3px solid var(--lp-blue); background: #fff; }
        .landing-page-development-page .lp-boundary h3 { margin: 0 0 7px; color: var(--lp-navy); font-size: 1.02rem; }
        .landing-page-development-page .lp-boundary p { margin: 0; color: var(--lp-muted); line-height: 1.62; }
        .landing-page-development-page .lp-process { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; counter-reset: lp-step; }
        .landing-page-development-page .lp-process article { padding: 24px 0; border-top: 2px solid var(--lp-blue); counter-increment: lp-step; }
        .landing-page-development-page .lp-process article::before { color: var(--lp-blue); content: "0" counter(lp-step); font-size: .78rem; font-weight: 800; }
        .landing-page-development-page .lp-process h3 { margin: 11px 0 7px; color: var(--lp-navy); font-size: 1rem; }
        .landing-page-development-page .lp-process p { margin: 0; color: var(--lp-muted); line-height: 1.6; }
        .landing-page-development-page .lp-proof { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 30px; align-items: center; padding: 30px; border: 1px solid var(--lp-line); background: #fff; }
        .landing-page-development-page .lp-proof h2 { margin: 0 0 8px; color: var(--lp-navy); font-size: 1.55rem; letter-spacing: 0; }
        .landing-page-development-page .lp-proof p { margin: 0; color: var(--lp-muted); line-height: 1.65; }
        .landing-page-development-page .lp-faq-list { border-top: 1px solid var(--lp-line); }
        .landing-page-development-page .lp-faq { border-bottom: 1px solid var(--lp-line); }
        .landing-page-development-page .lp-faq summary { padding: 19px 4px; cursor: pointer; list-style: none; }
        .landing-page-development-page .lp-faq summary::-webkit-details-marker { display: none; }
        .landing-page-development-page .lp-faq h3 { margin: 0; color: var(--lp-navy); font-size: 1rem; letter-spacing: 0; }
        .landing-page-development-page .lp-faq p { max-width: 900px; margin: 0 0 20px 4px; color: var(--lp-muted); line-height: 1.7; }
        .landing-page-development-page .lp-final { padding: 62px 0; background: var(--lp-navy); color: #fff; }
        .landing-page-development-page .lp-final-row { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 40px; align-items: center; }
        .landing-page-development-page .lp-final h2 { margin: 0 0 10px; color: #fff; font-size: clamp(1.7rem, 2.7vw, 2.6rem); letter-spacing: 0; }
        .landing-page-development-page .lp-final p { max-width: 760px; margin: 0; color: #cbd7e4; line-height: 1.7; }
        .landing-page-development-page .lp-final a:not(.lp-button) { color: #fff; text-decoration: underline; }
        @media (min-width: 992px) { .landing-page-development-page > .startup-inner-shell .navbar:not(.sticky-top) { background: #091e3e; } }
        @media (max-width: 991.98px) { .landing-page-development-page .lp-hero-grid, .landing-page-development-page .lp-split { grid-template-columns: 1fr; gap: 38px; } .landing-page-development-page .lp-values { grid-template-columns: repeat(2, minmax(0, 1fr)); } .landing-page-development-page .lp-values div:nth-child(3) { border-left: 0; } .landing-page-development-page .lp-values div:nth-child(n+3) { border-top: 1px solid rgba(255,255,255,.14); } .landing-page-development-page .lp-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .landing-page-development-page .lp-flow { grid-template-columns: repeat(3, minmax(0, 1fr)); } .landing-page-development-page .lp-flow article:nth-child(4) { border-left: 0; } .landing-page-development-page .lp-flow article:nth-child(n+4) { border-top: 1px solid var(--lp-line); } .landing-page-development-page .lp-process { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 767.98px) { .landing-page-development-page .lp-shell { width: min(100% - 32px, 680px); } .landing-page-development-page .lp-hero { padding: 60px 0 54px; } .landing-page-development-page .lp-section { padding: 56px 0; } .landing-page-development-page .lp-grid, .landing-page-development-page .lp-comparison, .landing-page-development-page .lp-process, .landing-page-development-page .lp-final-row { grid-template-columns: 1fr; } .landing-page-development-page .lp-comparison article + article { border-top: 1px solid var(--lp-line); border-left: 0; } .landing-page-development-page .lp-final-row { gap: 24px; } }
        @media (max-width: 430px) { .landing-page-development-page .lp-shell { width: min(100% - 24px, 406px); } .landing-page-development-page .lp-hero h1 { font-size: 2.15rem; } .landing-page-development-page .lp-actions { display: grid; } .landing-page-development-page .lp-button { width: 100%; } .landing-page-development-page .lp-values, .landing-page-development-page .lp-flow { grid-template-columns: 1fr; } .landing-page-development-page .lp-values div + div, .landing-page-development-page .lp-flow article + article { border-top: 1px solid rgba(255,255,255,.14); border-left: 0; } .landing-page-development-page .lp-flow article + article { border-top-color: var(--lp-line); } .landing-page-development-page .lp-card, .landing-page-development-page .lp-comparison article, .landing-page-development-page .lp-blueprint, .landing-page-development-page .lp-proof { padding: 22px; } .landing-page-development-page .lp-proof { grid-template-columns: 1fr; } }
    </style>
    <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="lp-hero" aria-labelledby="landing-page-title"><div class="lp-shell lp-hero-grid">
        <div><p class="lp-eyebrow">Landing Page untuk Campaign Bisnis</p><h1 id="landing-page-title">Jasa Pembuatan Landing Page Profesional untuk Campaign Bisnis</h1><p class="lp-hero-copy">Bangun satu halaman yang membantu audiens memahami satu penawaran dan menuju satu tindakan utama, seperti menghubungi WhatsApp, mengisi formulir, atau melakukan pendaftaran.</p><div class="lp-actions"><a class="lp-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Landing Page</a><a class="lp-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a></div></div>
        <aside class="lp-blueprint" aria-label="Contoh alur landing page"><strong>Satu halaman, satu alur yang terarah</strong><div class="lp-blueprint-flow"><span>Pesan utama campaign</span><span>Manfaat dan konteks penawaran</span><span>Bukti yang dapat dipublikasikan</span><span>CTA atau formulir yang disepakati</span></div></aside>
    </div></section>

    <section class="lp-value-strip" aria-label="Fondasi landing page"><div class="lp-shell lp-values"><div><strong>Fokus satu tujuan</strong></div><div><strong>Responsive</strong></div><div><strong>CTA terarah</strong></div><div><strong>Fondasi teknis</strong></div></div></section>

    <section class="lp-section" aria-labelledby="appropriate-title"><div class="lp-shell"><div class="lp-heading"><p class="lp-eyebrow">Kapan digunakan</p><h2 id="appropriate-title">Landing page tepat ketika penawaran dan tindakan utamanya sudah jelas.</h2><p>Halaman ini bukan pengganti seluruh website bisnis. Fungsinya adalah memberi satu campaign ruang yang lebih fokus.</p></div><div class="lp-grid">
        @foreach ([['Campaign atau promosi','Menjelaskan satu program, periode promosi, atau pesan campaign secara terarah.'],['Produk atau layanan tertentu','Memusatkan perhatian pada satu penawaran tanpa mencampurnya dengan seluruh layanan bisnis.'],['Peluncuran','Menyusun konteks, manfaat, dan jalur respons untuk produk, layanan, atau program baru.'],['Pendaftaran','Mengarahkan pengunjung pada informasi dan tindakan registrasi yang telah ditentukan.'],['Lead capture','Menyediakan jalur WhatsApp atau formulir sesuai data yang memang perlu dikumpulkan.'],['Penawaran bisnis','Membantu audiens memahami masalah, pendekatan, manfaat, dan langkah konsultasi.']] as [$title, $copy])<article class="lp-card"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="lp-section alt" aria-labelledby="comparison-title"><div class="lp-shell"><div class="lp-heading"><p class="lp-eyebrow">Batas layanan</p><h2 id="comparison-title">Landing page dan website reguler melayani kebutuhan yang berbeda.</h2></div><div class="lp-comparison"><article><h3>Landing page campaign</h3><ul class="lp-list"><li>Satu halaman dan satu penawaran utama</li><li>Satu jalur tindakan yang diprioritaskan</li><li>Konten mengikuti konteks campaign</li><li>Cocok untuk promosi, peluncuran, atau pendaftaran</li></ul></article><article><h3>Website multi-page</h3><ul class="lp-list"><li>Beberapa halaman dan tujuan bisnis</li><li>Informasi perusahaan yang lebih luas</li><li>Navigasi untuk berbagai kelompok konten</li><li>Cocok sebagai kehadiran digital jangka panjang</li></ul><p class="mt-3 mb-0">Untuk cakupan tersebut, pelajari <a href="{{ route('website-development') }}">layanan pembuatan website profesional</a>.</p></article></div></div></section>

    <section class="lp-section" aria-labelledby="structure-title"><div class="lp-shell"><div class="lp-heading center"><p class="lp-eyebrow">Struktur halaman</p><h2 id="structure-title">Susun pesan dari perhatian awal sampai tindakan berikutnya.</h2><p>Urutan akhir mengikuti audiens, penawaran, materi, dan keberatan yang perlu dijawab.</p></div><div class="lp-flow">
        @foreach (['Hero & pesan utama','Masalah atau konteks','Manfaat penawaran','Detail & bukti','FAQ atau keberatan','CTA utama'] as $index => $item)<article><span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $item }}</h3></article>@endforeach
    </div></div></section>

    <section class="lp-section alt" aria-labelledby="deliverables-title"><div class="lp-shell"><div class="lp-heading"><p class="lp-eyebrow">Ruang lingkup</p><h2 id="deliverables-title">Fondasi utama dan opsi yang mengikuti kebutuhan campaign.</h2><p>Biaya disusun melalui scope-based quotation setelah kebutuhan utama dipahami.</p></div><div class="lp-grid">
        @foreach ([['Desain responsive','Layout disiapkan agar pesan dan tindakan utama tetap jelas di desktop, tablet, dan mobile.'],['Struktur konten','Bagian halaman disusun berdasarkan audiens, penawaran, materi, dan tujuan campaign.'],['CTA utama','WhatsApp, formulir, pendaftaran, atau tautan eksternal dipilih sesuai alur yang disepakati.'],['Fondasi SEO teknis','Metadata, heading, canonical, robots, sitemap, dan struktur semantik disiapkan sebagai fondasi.'],['Pengujian','Tampilan, tautan, CTA, formulir, dan kesiapan teknis diperiksa sesuai ruang lingkup.'],['Persiapan go-live','Deployment, domain, hosting, akses, dan konfigurasi dibahas berdasarkan kebutuhan project.']] as [$title, $copy])<article class="lp-card"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="lp-section" aria-labelledby="cta-options-title"><div class="lp-shell lp-split"><div class="lp-heading"><p class="lp-eyebrow">CTA & mobile</p><h2 id="cta-options-title">Jalur tindakan harus mudah ditemukan dan nyaman digunakan.</h2><p>Prioritas CTA, informasi yang dikumpulkan, serta pengalaman mobile disusun mengikuti kebutuhan aktual, bukan asumsi hasil campaign.</p></div><div class="lp-boundary"><article><h3>WhatsApp atau formulir</h3><p>WhatsApp dapat memakai pesan awal yang relevan. Formulir dapat disiapkan dengan field, validasi, notifikasi, dan penyimpanan sesuai scope.</p></article><article><h3>Pengalaman responsive</h3><p>Hierarki konten, ukuran teks, tombol, media, dan jarak antarelemen diperiksa agar tetap mudah digunakan pada layar kecil.</p></article><article><h3>Tracking dan analytics</h3><p>Integrasi dapat dibahas setelah akun, tools, event, kebutuhan consent, serta akses teknis tersedia. Layanan ini tidak mencakup pengelolaan iklan.</p></article></div></div></section>

    <section class="lp-section alt" aria-labelledby="process-title"><div class="lp-shell"><div class="lp-heading"><p class="lp-eyebrow">Proses development</p><h2 id="process-title">Dari tujuan campaign sampai halaman siap digunakan.</h2><p>Durasi mengikuti kesiapan materi, kompleksitas desain, kebutuhan fungsi, integrasi, dan proses review.</p></div><div class="lp-process">
        @foreach ([['Discovery','Memetakan audiens, penawaran, tindakan utama, materi, dan batasan project.'],['Struktur & desain','Menyusun hierarki pesan, konten, visual, CTA, dan pengalaman responsive.'],['Development & testing','Membangun halaman dan memeriksa fungsi, tampilan, form, serta jalur tindakan.'],['Go live & handover','Menyiapkan deployment, akses, dokumentasi, dan dukungan sesuai kesepakatan.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="lp-section" aria-labelledby="handover-title"><div class="lp-shell lp-split"><div class="lp-heading"><p class="lp-eyebrow">Handover & maintenance</p><h2 id="handover-title">Kepemilikan dan tanggung jawab dijelaskan sejak ruang lingkup disusun.</h2><p>Akses, source code, domain, hosting, konten, kredensial, dokumentasi, dan bentuk handover ditetapkan dalam kesepakatan project. Maintenance atau pembaruan campaign dapat dibahas sebagai ruang lingkup lanjutan.</p></div><div class="lp-proof"><div><h2 id="proof-title">Tinjau portfolio yang tersedia.</h2><p>Portfolio menampilkan pekerjaan yang telah dipublikasikan. Kesesuaian contoh dengan kebutuhan landing page Anda dapat dibahas saat konsultasi tanpa menganggap setiap proyek sebagai studi kasus campaign.</p></div><a class="lp-button" href="{{ route('portfolio.index') }}">Lihat Portfolio</a></div></div></section>

    <section class="lp-section alt" aria-labelledby="faq-title"><div class="lp-shell"><div class="lp-heading"><p class="lp-eyebrow">FAQ</p><h2 id="faq-title">Pertanyaan tentang pembuatan landing page.</h2></div><div class="lp-faq-list">@foreach ($faqs as $index => [$question, $answer])<details class="lp-faq" @if($index === 0) open @endif><summary><h3>{{ $question }}</h3></summary><p>{{ $answer }}</p></details>@endforeach</div></div></section>

    <section class="lp-final" aria-labelledby="final-title"><div class="lp-shell lp-final-row"><div><h2 id="final-title">Diskusikan landing page yang sesuai dengan campaign bisnis Anda.</h2><p>Ceritakan penawaran, target audiens, materi yang tersedia, dan tindakan utama yang diharapkan agar ruang lingkup dapat dipetakan secara realistis. Untuk kebutuhan yang lebih luas, lihat <a href="{{ route('website-development') }}">jasa pembuatan website profesional</a> atau gunakan <a href="{{ route('contact') }}">halaman kontak JASAIBNU</a>.</p></div><a class="lp-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Mulai Konsultasi</a></div></section>
@endsection
