@extends('layouts.app')

@php
    $canonical = route('website-development-company-profile');
    $companyProfileSettings = \App\Models\SiteSetting::current();
    $whatsappMessage = "Halo JASAIBNU, saya ingin berkonsultasi mengenai website company profile.\n\nNama bisnis:\nBidang usaha:\nInformasi/halaman yang dibutuhkan:\nCatatan:";
    $consultationUrl = $companyProfileSettings->whatsappContactUrl($whatsappMessage) ?: route('contact');
    $consultationExternal = str_starts_with($consultationUrl, 'http');
    $faqs = [
        ['Apa itu website company profile?', 'Website company profile adalah website resmi yang menyajikan identitas bisnis, informasi perusahaan, layanan atau produk, portfolio, dan jalur kontak secara terstruktur.'],
        ['Apa perbedaannya dengan website ecommerce?', 'Website company profile berfokus pada informasi, kredibilitas, dan komunikasi bisnis. Website ecommerce berfokus pada transaksi seperti katalog, cart, checkout, pembayaran, pesanan, dan pengelolaan stok.'],
        ['Bisnis apa yang cocok menggunakan website company profile?', 'Website company profile dapat digunakan oleh perusahaan jasa profesional, kontraktor, manufaktur, distributor, konsultan, institusi pendidikan, klinik, lembaga, dan UKM yang perlu menyajikan informasi bisnis secara resmi. Contoh tersebut menunjukkan kebutuhan yang sesuai, bukan daftar pengalaman industri JASAIBNU.'],
        ['Konten apa yang perlu disiapkan?', 'Materi awal biasanya mencakup profil bisnis, layanan atau produk, keunggulan, portfolio atau proyek yang dapat dipublikasikan, serta informasi kontak. Riwayat perusahaan, visi dan misi, tim, legalitas, sertifikasi, karier, dan artikel dapat ditambahkan sesuai kebutuhan dan materi yang tersedia.'],
        ['Apakah website dapat memiliki CMS atau admin panel?', 'Bisa. CMS atau admin panel dapat disiapkan sesuai scope agar tim dapat mengelola konten seperti layanan, portfolio, artikel, karier, atau informasi perusahaan.'],
        ['Apakah website sudah memiliki fondasi SEO?', 'Website dapat disiapkan dengan fondasi SEO teknis dan on-page seperti title, meta description, struktur heading, canonical, sitemap, dan performa halaman sesuai scope. Fondasi ini tidak menjamin posisi tertentu di hasil pencarian.'],
        ['Apakah domain dan hosting dapat dibantu?', 'JASAIBNU dapat membantu menyiapkan domain, hosting, SSL, email bisnis, dan konfigurasi deployment sesuai ruang lingkup. Kepemilikan, akses, dan biaya perpanjangan dijelaskan dalam penawaran project.'],
        ['Bagaimana kepemilikan dan handover website?', 'Akses, source code, konten, domain, hosting, serta bentuk handover ditetapkan dalam ruang lingkup dan kesepakatan project agar tanggung jawab setiap pihak jelas.'],
        ['Apakah website dapat dibuat multilingual?', 'Bisa. Kebutuhan bahasa, struktur terjemahan, pengelolaan konten, dan alur publikasinya dipetakan sebagai bagian dari scope project.'],
        ['Apakah tersedia maintenance dan support?', 'Kebutuhan maintenance, pembaruan konten, pemantauan, dan support setelah go-live dapat dibahas sesuai ruang lingkup atau kesepakatan lanjutan.'],
        ['Berapa lama proses pembuatannya?', 'Durasi ditentukan oleh jumlah halaman, kesiapan konten, kompleksitas desain, kebutuhan fitur dan integrasi, serta proses peninjauan. Timeline disepakati setelah kebutuhan project dipetakan.'],
        ['Berapa biaya website company profile?', 'Biaya ditentukan berdasarkan ruang lingkup halaman, desain, pengelolaan konten, integrasi, serta kebutuhan deployment dan support. Penawaran disusun setelah kebutuhan utama dipahami.'],
    ];
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $canonical . '#service',
        'url' => $canonical,
        'name' => 'Jasa Pembuatan Website Company Profile',
        'description' => 'JASAIBNU menyediakan jasa pembuatan website company profile profesional untuk menampilkan profil bisnis, layanan, portfolio, dan kontak secara kredibel.',
        'serviceType' => 'Jasa pembuatan website company profile',
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

@section('title', 'Jasa Pembuatan Website Company Profile | JASAIBNU')
@section('meta_description', 'JASAIBNU menyediakan jasa pembuatan website company profile profesional untuk menampilkan profil bisnis, layanan, portfolio, dan kontak secara kredibel.')
@section('canonical', $canonical)
@section('robots', 'index,follow')
@section('body_class', 'startup2-home company-profile-page')

@push('head')
    <style>
        .company-profile-page { --cp-navy: #061429; --cp-blue: #06a3da; --cp-ink: #243247; --cp-soft: #f3f7fa; color: var(--cp-ink); overflow-x: hidden; }
        .cp-shell { width: min(100% - 48px, 1180px); margin-inline: auto; }
        .cp-hero { position: relative; padding: 86px 0 72px; overflow: hidden; background: var(--cp-navy); color: #fff; }
        .cp-hero::after { position: absolute; inset: 0 0 0 auto; width: 34%; content: ""; background: linear-gradient(145deg, transparent 10%, rgba(6,163,218,.2)); pointer-events: none; }
        .cp-hero-grid { position: relative; z-index: 1; display: grid; grid-template-columns: minmax(0, 1.2fr) minmax(300px, .8fr); gap: 64px; align-items: center; }
        .cp-eyebrow { margin: 0 0 14px; color: var(--cp-blue); font-size: .82rem; font-weight: 800; text-transform: uppercase; }
        .cp-hero h1 { max-width: 760px; margin: 0; color: #fff; font-size: clamp(2.35rem, 4vw, 4.25rem); line-height: 1.08; letter-spacing: 0; }
        .cp-hero-copy { max-width: 720px; margin: 24px 0 0; color: #d5deea; font-size: 1.08rem; line-height: 1.75; }
        .cp-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
        .cp-button { display: inline-flex; min-height: 48px; align-items: center; justify-content: center; padding: 12px 20px; border: 1px solid var(--cp-blue); background: var(--cp-blue); color: #fff; font-weight: 700; text-decoration: none; }
        .cp-button:hover { background: #078bb9; color: #fff; }
        .cp-button.secondary { border-color: rgba(255,255,255,.55); background: transparent; }
        .cp-hero-panel { padding: 28px; border: 1px solid rgba(255,255,255,.18); background: rgba(255,255,255,.07); }
        .cp-hero-panel strong { display: block; margin-bottom: 16px; color: #fff; font-size: 1.15rem; }
        .cp-hero-panel span { display: block; padding: 12px 0; border-top: 1px solid rgba(255,255,255,.14); color: #d5deea; }
        .cp-section { padding: 78px 0; }
        .cp-section.alt { background: var(--cp-soft); }
        .cp-heading { max-width: 760px; margin-bottom: 36px; }
        .cp-heading h2 { margin: 0 0 14px; color: var(--cp-navy); font-size: clamp(1.75rem, 2.4vw, 2.6rem); line-height: 1.2; letter-spacing: 0; }
        .cp-heading p:last-child { margin-bottom: 0; line-height: 1.75; }
        .cp-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .cp-card { min-width: 0; padding: 26px; border: 1px solid #dce5eb; border-radius: 6px; background: #fff; box-shadow: 0 12px 28px rgba(6,20,41,.05); }
        .cp-card h3 { margin: 0 0 10px; color: var(--cp-navy); font-size: 1.08rem; letter-spacing: 0; }
        .cp-card p { margin: 0; line-height: 1.68; }
        .cp-problem-grid { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr); gap: 54px; align-items: start; }
        .cp-problem-list { display: grid; gap: 14px; }
        .cp-problem-list article { padding: 20px 22px; border-left: 3px solid var(--cp-blue); background: #fff; }
        .cp-problem-list h3, .cp-problem-list p { margin: 0; }
        .cp-problem-list h3 { margin-bottom: 6px; color: var(--cp-navy); font-size: 1rem; }
        .cp-audiences { display: flex; flex-wrap: wrap; gap: 10px; }
        .cp-audiences span { padding: 10px 14px; border: 1px solid #cfdae2; background: #fff; color: var(--cp-navy); font-weight: 700; }
        .cp-matrix { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); overflow: hidden; border: 1px solid #d6e1e8; border-radius: 6px; background: #fff; }
        .cp-matrix-column { min-width: 0; padding: 30px; }
        .cp-matrix-column + .cp-matrix-column { border-left: 1px solid #d6e1e8; }
        .cp-matrix h3 { margin: 0 0 18px; color: var(--cp-navy); font-size: 1.2rem; }
        .cp-checklist { display: grid; gap: 12px; margin: 0; padding: 0; list-style: none; }
        .cp-checklist li { position: relative; padding-left: 24px; line-height: 1.55; }
        .cp-checklist li::before { position: absolute; left: 0; color: var(--cp-blue); content: "✓"; font-weight: 900; }
        .cp-structure { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
        .cp-structure span { padding: 13px 16px; border: 1px solid #d6e1e8; background: #fff; color: var(--cp-navy); font-weight: 700; }
        .cp-structure b { color: var(--cp-blue); }
        .cp-note { margin-top: 20px; padding: 18px 20px; border-left: 3px solid var(--cp-blue); background: #eaf6fb; line-height: 1.65; }
        .cp-process { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 14px; counter-reset: cp-step; }
        .cp-process article { min-width: 0; padding: 22px; border-top: 3px solid var(--cp-blue); background: #fff; counter-increment: cp-step; }
        .cp-process article::before { display: block; margin-bottom: 18px; color: var(--cp-blue); content: "0" counter(cp-step); font-weight: 800; }
        .cp-process h3 { margin: 0 0 8px; color: var(--cp-navy); font-size: 1rem; }
        .cp-process p { margin: 0; font-size: .94rem; line-height: 1.6; }
        .cp-proof { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 30px; align-items: center; padding: 36px; background: var(--cp-navy); color: #d5deea; }
        .cp-proof h2 { margin: 0 0 10px; color: #fff; font-size: 1.75rem; letter-spacing: 0; }
        .cp-proof p { max-width: 760px; margin: 0; line-height: 1.7; }
        .cp-faq-list { display: grid; gap: 12px; }
        .cp-faq { border: 1px solid #d6e1e8; border-radius: 6px; background: #fff; }
        .cp-faq summary { padding: 20px 22px; color: var(--cp-navy); cursor: pointer; }
        .cp-faq summary h3 { display: inline; margin: 0; font-size: 1.02rem; letter-spacing: 0; }
        .cp-faq p { margin: 0; padding: 0 22px 22px; line-height: 1.7; }
        .cp-final { padding: 64px 0; background: var(--cp-blue); color: #fff; }
        .cp-final-row { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 30px; align-items: center; }
        .cp-final h2 { margin: 0 0 10px; color: #fff; font-size: clamp(1.7rem, 2.4vw, 2.5rem); letter-spacing: 0; }
        .cp-final p { max-width: 760px; margin: 0; line-height: 1.7; }
        .cp-final .cp-button { border-color: #fff; background: #fff; color: var(--cp-navy); }
        @media (max-width: 1024px) { .cp-hero-grid { gap: 36px; } .cp-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .cp-process { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (max-width: 767.98px) { .cp-shell { width: min(100% - 32px, 680px); } .cp-hero { padding: 64px 0 56px; } .cp-hero-grid, .cp-problem-grid, .cp-proof, .cp-final-row { grid-template-columns: 1fr; } .cp-hero-grid, .cp-problem-grid { gap: 32px; } .cp-section { padding: 58px 0; } .cp-grid, .cp-process { grid-template-columns: 1fr; } .cp-matrix { grid-template-columns: 1fr; } .cp-matrix-column + .cp-matrix-column { border-top: 1px solid #d6e1e8; border-left: 0; } .cp-proof, .cp-final-row { gap: 22px; } }
        @media (max-width: 430px) { .cp-shell { width: min(100% - 24px, 406px); } .cp-hero h1 { font-size: 2.2rem; } .cp-actions { display: grid; } .cp-button { width: 100%; } .cp-card, .cp-matrix-column, .cp-hero-panel { padding: 22px; } .cp-proof { padding: 26px 22px; } .cp-structure { align-items: stretch; } .cp-structure span { width: 100%; } .cp-structure b { display: none; } }
    </style>
    <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="cp-hero" aria-labelledby="company-profile-title">
        <div class="cp-shell cp-hero-grid">
            <div>
                <p class="cp-eyebrow">Website Company Profile untuk Bisnis</p>
                <h1 id="company-profile-title">Jasa Pembuatan Website Company Profile Profesional</h1>
                <p class="cp-hero-copy">Bangun kehadiran digital resmi yang membantu calon pelanggan dan partner memahami profil perusahaan, layanan, kapabilitas, portfolio, dan informasi kontak dalam struktur yang profesional.</p>
                <div class="cp-actions">
                    <a class="cp-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Website Company Profile</a>
                    <a class="cp-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a>
                </div>
            </div>
            <aside class="cp-hero-panel" aria-label="Fokus website company profile">
                <strong>Satu website, informasi bisnis lebih terstruktur</strong>
                <span>Identitas dan profil perusahaan</span><span>Layanan, produk, dan kapabilitas</span><span>Portfolio atau proyek yang dapat dipublikasikan</span><span>Kontak dan jalur konsultasi</span>
            </aside>
        </div>
    </section>

    <section class="cp-section alt" aria-labelledby="credibility-title"><div class="cp-shell cp-problem-grid">
        <div class="cp-heading"><p class="cp-eyebrow">Kredibilitas bisnis</p><h2 id="credibility-title">Informasi perusahaan perlu hadir dalam satu tempat yang resmi dan mudah diperiksa.</h2><p>Informasi yang tersebar di berbagai kanal dapat menyulitkan calon pelanggan atau partner memahami bisnis secara utuh.</p></div>
        <div class="cp-problem-list"><article><h3>Belum ada pusat informasi resmi</h3><p>Profil, layanan, dan kontak bisnis belum tersusun dalam satu alamat web yang jelas.</p></article><article><h3>Layanan sulit dipahami dengan cepat</h3><p>Calon pelanggan atau partner perlu mencari informasi dari beberapa kanal untuk memahami penawaran bisnis.</p></article><article><h3>Kapabilitas belum terpresentasi rapi</h3><p>Portfolio, proyek, atau informasi pendukung dapat kehilangan konteks ketika tidak disusun dalam struktur website.</p></article></div>
    </div></section>

    <section class="cp-section" aria-labelledby="content-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">Isi website</p><h2 id="content-title">Informasi yang dapat disusun dalam website company profile.</h2><p>Struktur dipilih berdasarkan kebutuhan bisnis dan kesiapan materi, bukan paket halaman yang dipaksakan.</p></div><div class="cp-grid">
        @foreach ([['Home','Ringkasan identitas, fokus bisnis, dan jalur utama menuju informasi penting.'],['Tentang Perusahaan','Profil, latar belakang, nilai, serta konteks bisnis yang perlu diketahui pengunjung.'],['Layanan atau Produk','Penjelasan penawaran yang dikelompokkan agar lebih mudah dipahami.'],['Portfolio atau Proyek','Pekerjaan yang memang dapat dipublikasikan beserta konteks yang tersedia.'],['Kontak','Alamat, email, telepon, form, atau jalur konsultasi sesuai scope.'],['Informasi Tambahan','Riwayat, visi dan misi, tim, legalitas, sertifikasi, karier, atau artikel jika dibutuhkan.']] as [$title, $copy])
            <article class="cp-card"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>
        @endforeach
    </div><p class="cp-note">Elemen tambahan bersifat scope-dependent dan hanya digunakan ketika relevan serta didukung materi bisnis yang dapat dipublikasikan.</p></div></section>

    <section class="cp-section alt" aria-labelledby="audience-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">Kebutuhan bisnis</p><h2 id="audience-title">Cocok untuk bisnis yang perlu menjelaskan identitas dan kapabilitasnya.</h2><p>Contoh berikut menggambarkan jenis kebutuhan, bukan klaim pengalaman industri JASAIBNU.</p></div><div class="cp-audiences">@foreach (['Jasa profesional','Kontraktor','Manufaktur','Distributor','Konsultan','Pendidikan','Klinik','Institusi','UKM yang berkembang'] as $audience)<span>{{ $audience }}</span>@endforeach</div></div></section>

    <section class="cp-section" aria-labelledby="capability-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">Ruang lingkup</p><h2 id="capability-title">Fondasi utama dan kemampuan yang mengikuti kebutuhan project.</h2><p>Detail implementasi dikonfirmasi melalui discovery dan kesepakatan scope.</p></div><div class="cp-matrix">
        <div class="cp-matrix-column"><h3>Foundation</h3><ul class="cp-checklist"><li>Responsive dan mobile-friendly</li><li>Informasi perusahaan yang terstruktur</li><li>Jalur kontak atau lead yang jelas</li><li>Fondasi SEO teknis dan on-page</li><li>Fundamental performa website</li><li>Keamanan dasar</li></ul></div>
        <div class="cp-matrix-column"><h3>Scope-dependent</h3><ul class="cp-checklist"><li>CMS atau admin panel</li><li>WhatsApp atau contact form</li><li>Konten multilingual</li><li>Integrasi peta</li><li>Modul karier atau berita</li><li>Integrasi custom dan fungsi lanjutan</li></ul></div>
    </div></div></section>

    <section class="cp-section alt" aria-labelledby="structure-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">Contoh struktur</p><h2 id="structure-title">Susun alur informasi agar pengunjung memahami bisnis secara bertahap.</h2><p>Susunan menu berikut adalah contoh awal dan dapat berubah mengikuti prioritas perusahaan.</p></div><div class="cp-structure"><span>Home</span><b>→</b><span>Tentang</span><b>→</b><span>Layanan / Produk</span><b>→</b><span>Portfolio / Proyek</span><b>→</b><span>Kontak</span></div><p class="cp-note">Karier, berita, sertifikasi, dokumen legal yang dapat dipublikasikan, dan pilihan bahasa dapat menjadi cabang tambahan sesuai scope.</p></div></section>

    <section class="cp-section" aria-labelledby="process-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">Proses development</p><h2 id="process-title">Tahapan kerja dari kebutuhan sampai website siap digunakan.</h2><p>Durasi setiap tahap mengikuti lingkup, materi, fitur, dan proses peninjauan project.</p></div><div class="cp-process">
        @foreach ([['Konsultasi / Discovery','Memetakan tujuan, pengguna, informasi, dan kebutuhan bisnis.'],['Struktur Konten','Menyusun hierarki halaman dan materi yang perlu disiapkan.'],['Desain & Development','Membangun tampilan dan fungsi sesuai arah yang disepakati.'],['Pengujian','Memeriksa tampilan, fungsi, form, dan kesiapan teknis.'],['Go Live / Handover','Menyiapkan deployment, akses, dan penyerahan sesuai scope.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="cp-section alt" aria-labelledby="technical-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">Fondasi teknis</p><h2 id="technical-title">Website disiapkan agar rapi digunakan dan realistis dikembangkan.</h2><p>Fondasi teknis dipilih sesuai kebutuhan aktual, tanpa menjanjikan hasil ranking atau performa bisnis tertentu.</p></div><div class="cp-grid">@foreach ([['Responsive','Layout dirancang agar informasi tetap jelas di desktop, tablet, dan perangkat mobile.'],['Performance','Struktur halaman dan asset disiapkan dengan perhatian pada efisiensi pemuatan.'],['Security Basics','Validasi, konfigurasi, dan jalur input disiapkan mengikuti kebutuhan implementasi.'],['Technical SEO','Metadata, heading, canonical, sitemap, dan struktur semantik disiapkan sebagai fondasi.'],['CMS bila Dibutuhkan','Pengelolaan konten mandiri dapat disiapkan sesuai kebutuhan tim.'],['Deployment','Persiapan go-live, akses, dan konfigurasi dibahas dalam ruang lingkup project.']] as [$title, $copy])<article class="cp-card"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach</div></div></section>

    <section class="cp-section" aria-labelledby="proof-title"><div class="cp-shell"><div class="cp-proof"><div><h2 id="proof-title">Tinjau portfolio yang tersedia sebelum menentukan arah website.</h2><p>Portfolio JASAIBNU menampilkan pekerjaan dan kapabilitas yang telah dipublikasikan. Kesesuaian contoh dengan kebutuhan Company Profile dapat dibahas saat konsultasi.</p></div><a class="cp-button" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a></div></div></section>

    <section class="cp-section alt" aria-labelledby="faq-title"><div class="cp-shell"><div class="cp-heading"><p class="cp-eyebrow">FAQ</p><h2 id="faq-title">Pertanyaan tentang website company profile.</h2></div><div class="cp-faq-list">@foreach ($faqs as $index => [$question, $answer])<details class="cp-faq" @if($index === 0) open @endif><summary><h3>{{ $question }}</h3></summary><p>{{ $answer }}</p></details>@endforeach</div></div></section>

    <section class="cp-final" aria-labelledby="final-title"><div class="cp-shell cp-final-row"><div><h2 id="final-title">Diskusikan website company profile yang sesuai dengan kebutuhan perusahaan Anda.</h2><p>Ceritakan konteks bisnis, informasi yang perlu ditampilkan, halaman yang dibutuhkan, dan kebutuhan pengelolaannya untuk memulai pemetaan scope.</p><p class="mt-3 mb-0">Untuk jenis website lain dan kebutuhan yang lebih luas, pelajari <a class="text-white text-decoration-underline" href="{{ route('website-development') }}">layanan pembuatan website profesional</a>.</p></div><a class="cp-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Mulai Konsultasi</a></div></section>
@endsection
