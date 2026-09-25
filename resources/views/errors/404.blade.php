@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - JASAIBNU')
@section('robots', 'noindex,nofollow')
@section('body_class', 'clean-404-page')

@php
    $siteSettings = \App\Models\SiteSetting::current();
@endphp

@push('head')
<style>
    /* Google Fonts Import */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* Header Override (Make it look like inner pages / Gambar 3) */
    .clean-404-page .site-header {
        border-bottom-color: #e5edf5;
        background: rgba(255, 255, 255, .96);
        box-shadow: 0 3px 18px rgba(11, 33, 71, .05);
    }
    .clean-404-page .site-header .header-inner {
        width: calc(100% - 96px);
        max-width: none;
        min-height: 96px;
    }
    .clean-404-page .site-header .primary-nav {
        gap: 0;
        color: #33445b;
        font-size: 17px;
        font-weight: 600;
    }
    .clean-404-page .site-header .primary-nav > a:not(.button) {
        position: relative;
        display: inline-flex;
        min-height: 96px;
        align-items: center;
        margin-left: 18px;
    }
    .clean-404-page .site-header .primary-nav a[aria-current="page"],
    .clean-404-page .site-header .primary-nav a:not(.button):hover { color: #087cf0; }
    .clean-404-page .site-header .nav-cta {
        min-height: 40px;
        margin-left: 18px;
        padding: .48rem 1.05rem;
        border-radius: 2px;
        font-size: .96rem;
    }
    @if ($siteSettings && $siteSettings->logo_dark_path)
    .clean-404-page .site-header .brand {
        width: 199px;
        min-height: 45px;
        background: url("{{ asset('storage/' . $siteSettings->logo_dark_path) }}") left center / contain no-repeat;
    }
    .clean-404-page .site-header .brand > img { opacity: 0; }
    @endif
    .clean-404-page .site-header .brand-text strong { color: #0b2147; }
    .clean-404-page .site-header .brand-text span { color: #68788b; }
    .clean-404-page .site-header .menu-toggle { border-color: #cad8e6; background: #fff; }
    .clean-404-page .site-header .menu-toggle span { background: #0b2147; }

    /* Global reset for this section */
    .clean-404-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #F8FAFC; /* Light background */
        color: #1e293b;
        padding: 4rem 1rem;
        line-height: 1.6;
    }

    .clean-404-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* --- HERO SECTION --- */
    .hero-404 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        background: #ffffff;
        border-radius: 24px;
        padding: 4rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.02);
        margin-bottom: 4rem;
    }

    /* Hero Illustration (Left) */
    .hero-ill-container {
        position: relative;
        width: 100%;
        max-width: 450px;
        margin: 0 auto;
    }
    
    .hero-ill-browser {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        position: relative;
        z-index: 2;
    }
    .hero-ill-header {
        background: #f1f5f9;
        padding: 12px 16px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        gap: 6px;
    }
    .hero-ill-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #cbd5e1;
    }
    .hero-ill-dot:nth-child(1) { background: #ef4444; }
    .hero-ill-dot:nth-child(2) { background: #eab308; }
    .hero-ill-dot:nth-child(3) { background: #22c55e; }
    
    .hero-ill-body {
        padding: 4rem 2rem;
        text-align: center;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }
    .hero-ill-text {
        font-size: 5rem;
        font-weight: 800;
        color: #0ea5e9; /* Soft blue accent */
        line-height: 1;
        margin-bottom: 1rem;
        letter-spacing: -2px;
    }
    .hero-ill-mag {
        width: 64px;
        height: 64px;
        margin: 0 auto;
        color: #94a3b8;
    }
    
    .hero-ill-decor-1 {
        position: absolute;
        width: 120px;
        height: 120px;
        background: #e0f2fe;
        border-radius: 50%;
        top: -20px;
        left: -30px;
        z-index: 1;
    }
    .hero-ill-decor-2 {
        position: absolute;
        width: 80px;
        height: 80px;
        background: #bae6fd;
        border-radius: 50%;
        bottom: -20px;
        right: -20px;
        z-index: 1;
    }

    /* Hero Text (Right) */
    .hero-badge {
        display: inline-block;
        background: #e0f2fe;
        color: #0284c7;
        font-weight: 700;
        font-size: 0.875rem;
        padding: 0.25rem 1rem;
        border-radius: 50px;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
    }
    
    .hero-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }
    
    .hero-desc {
        font-size: 1.125rem;
        color: #64748b;
        margin-bottom: 2.5rem;
        line-height: 1.7;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .btn-primary-clean {
        background: #0284c7;
        color: #ffffff !important;
        font-weight: 600;
        padding: 0.875rem 1.75rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2);
    }
    .btn-primary-clean:hover {
        background: #0369a1;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(2, 132, 199, 0.3);
    }
    
    .btn-secondary-clean {
        background: #ffffff;
        color: #0f172a !important;
        font-weight: 600;
        padding: 0.875rem 1.75rem;
        border-radius: 8px;
        text-decoration: none;
        border: 1px solid #cbd5e1;
        transition: all 0.2s;
    }
    .btn-secondary-clean:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    /* --- SECTION TITLES --- */
    .section-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .section-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }
    .section-subtitle {
        color: #64748b;
        font-size: 1.05rem;
    }

    /* --- POPULAR PAGES --- */
    .popular-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.5rem;
        margin-bottom: 5rem;
    }

    .popular-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        text-decoration: none;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .popular-card:hover {
        border-color: #38bdf8;
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(56, 189, 248, 0.1);
    }
    
    .card-icon {
        width: 40px;
        height: 40px;
        background: #f0f9ff;
        color: #0284c7;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .card-icon svg { width: 20px; height: 20px; }
    
    .card-title {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.25rem;
        font-size: 1.05rem;
    }
    .card-desc {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 1rem;
        flex-grow: 1;
    }
    .card-arrow {
        color: #0ea5e9;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .card-arrow svg { width: 14px; height: 14px; }

    /* --- DISCOVERY SECTION --- */
    .discovery-section {
        background: #e0f2fe;
        border-radius: 20px;
        padding: 3rem 2rem;
        text-align: center;
        margin-bottom: 4rem;
        border: 1px solid #bae6fd;
    }
    .discovery-section h3 {
        color: #0c4a6e;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .discovery-section p {
        color: #0369a1;
        margin-bottom: 1.5rem;
    }
    .discovery-btn {
        display: inline-block;
        background: #ffffff;
        color: #0284c7 !important;
        font-weight: 600;
        padding: 0.875rem 2rem;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }
    .discovery-btn:hover {
        background: #f8fafc;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    /* --- SUPPORT SECTION --- */
    .support-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .support-icon {
        width: 56px;
        height: 56px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
    }
    .support-icon svg { width: 28px; height: 28px; }
    
    .support-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
    }
    .support-card p {
        color: #64748b;
        margin-bottom: 2rem;
    }
    
    .btn-whatsapp {
        background: #25D366;
        color: #ffffff !important;
        font-weight: 600;
        padding: 0.875rem 1.75rem;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 4px 6px -1px rgba(37, 211, 102, 0.2);
    }
    .btn-whatsapp:hover {
        background: #20bd5a;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(37, 211, 102, 0.3);
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 1024px) {
        .popular-grid { grid-template-columns: repeat(3, 1fr); }
    }
    
    @media (max-width: 768px) {
        .hero-404 {
            grid-template-columns: 1fr;
            padding: 3rem 2rem;
            text-align: center;
            gap: 2.5rem;
        }
        .hero-cta { justify-content: center; }
        .popular-grid { grid-template-columns: repeat(2, 1fr); }
        .hero-ill-container { max-width: 350px; }
    }

    @media (max-width: 576px) {
        .hero-404 { padding: 2.5rem 1.5rem; }
        .hero-title { font-size: 2rem; }
        .hero-cta { flex-direction: column; width: 100%; }
        .btn-primary-clean, .btn-secondary-clean { width: 100%; text-align: center; }
        
        .popular-grid { grid-template-columns: 1fr; }
        
        .discovery-section { padding: 2rem 1.5rem; }
        .support-card { padding: 2.5rem 1.5rem; }
        .btn-whatsapp { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')
<div class="clean-404-wrapper">
    <div class="clean-404-container">
        
        <!-- HERO TWO COLUMN -->
        <div class="hero-404">
            <!-- Left: Illustration -->
            <div class="hero-ill-container">
                <div class="hero-ill-decor-1"></div>
                <div class="hero-ill-decor-2"></div>
                
                <div class="hero-ill-browser">
                    <div class="hero-ill-header">
                        <div class="hero-ill-dot"></div>
                        <div class="hero-ill-dot"></div>
                        <div class="hero-ill-dot"></div>
                    </div>
                    <div class="hero-ill-body">
                        <svg class="hero-ill-mag" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <div class="hero-ill-text">404</div>
                    </div>
                </div>
            </div>

            <!-- Right: Text Content -->
            <div class="hero-text">
                <div class="hero-badge">Kesalahan 404</div>
                <h1 class="hero-title">Halaman tidak ditemukan</h1>
                <p class="hero-desc">
                    Maaf, halaman yang Anda cari tidak tersedia atau mungkin sudah dipindahkan. Silakan periksa kembali alamat URL, atau gunakan menu di bawah ini untuk menemukan informasi yang Anda butuhkan.
                </p>
                <div class="hero-cta">
                    <a href="{{ route('home') }}" class="btn-primary-clean">Kembali ke Beranda</a>
                    <a href="{{ route('services.index') }}" class="btn-secondary-clean">Cari di JASAIBNU</a>
                </div>
            </div>
        </div>

        <!-- POPULAR PAGES -->
        <div class="section-header">
            <h2 class="section-title">Halaman Populer</h2>
            <p class="section-subtitle">Berikut beberapa halaman yang sering dicari oleh pengunjung kami.</p>
        </div>

        <div class="popular-grid">
            <!-- Card 1 -->
            <a href="{{ route('home') }}" class="popular-card">
                <div class="card-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                </div>
                <div class="card-title">Beranda</div>
                <div class="card-desc">Kembali ke halaman utama</div>
                <div class="card-arrow">Buka <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></div>
            </a>

            <!-- Card 2 -->
            <a href="{{ route('services.index') }}" class="popular-card">
                <div class="card-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <div class="card-title">Layanan</div>
                <div class="card-desc">Lihat semua layanan kami</div>
                <div class="card-arrow">Buka <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></div>
            </a>

            <!-- Card 3 -->
            <a href="{{ route('portfolio.index') }}" class="popular-card">
                <div class="card-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div class="card-title">Portofolio</div>
                <div class="card-desc">Lihat hasil pekerjaan kami</div>
                <div class="card-arrow">Buka <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></div>
            </a>

            <!-- Card 4 -->
            <a href="{{ route('insights.index') }}" class="popular-card">
                <div class="card-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                </div>
                <div class="card-title">Insights</div>
                <div class="card-desc">Artikel dan tips seputar website</div>
                <div class="card-arrow">Buka <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></div>
            </a>

            <!-- Card 5 -->
            <a href="{{ route('contact') }}" class="popular-card">
                <div class="card-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </div>
                <div class="card-title">Kontak</div>
                <div class="card-desc">Hubungi kami untuk konsultasi</div>
                <div class="card-arrow">Buka <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></div>
            </a>
        </div>

        <!-- DISCOVERY SECTION -->
        <div class="discovery-section">
            <h3>Cari halaman yang Anda butuhkan</h3>
            <p>Gunakan tombol di bawah ini untuk menjelajahi berbagai informasi dan layanan di website kami.</p>
            <a href="{{ route('services.index') }}" class="discovery-btn">
                Jelajahi Layanan
            </a>
        </div>

        <!-- SUPPORT SECTION -->
        <div class="support-card">
            <div class="support-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <h3>Masih belum menemukan yang Anda cari?</h3>
            <p>Tim JASAIBNU siap membantu Anda. Hubungi kami melalui WhatsApp atau formulir kontak.</p>
            
            <a href="https://wa.me/6281234567890" class="btn-whatsapp" target="_blank" rel="noopener">
                <!-- WhatsApp SVG Icon -->
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                </svg>
                Chat via WhatsApp
            </a>
        </div>

    </div>
</div>
@endsection
