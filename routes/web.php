<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutPageController as AdminAboutPageController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ServiceTechnologyController as AdminServiceTechnologyController;
use App\Http\Controllers\Admin\SolutionController as AdminSolutionController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InsightCategoryController as AdminInsightCategoryController;
use App\Http\Controllers\Admin\InsightController as AdminInsightController;
use App\Http\Controllers\Admin\PortfolioCategoryController as AdminPortfolioCategoryController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\PortfolioPageSettingController as AdminPortfolioPageSettingController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\HeroSlideController as AdminHeroSlideController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RobotsController;

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', RobotsController::class)->name('robots');

Route::view('/', 'home')->name('home');
Route::view('/jasa-pembuatan-website', 'pages.website-development')->name('website-development');
Route::view('/jasa-pembuatan-website-serang', 'pages.website-development', [
    'landing' => [
        'title' => 'Jasa Pembuatan Website Serang & Banten | JASAIBNU',
        'meta_description' => 'JASAIBNU menyediakan jasa pembuatan website di Serang dan Banten untuk company profile, landing page, website UMKM, dan website bisnis yang cepat, aman, SEO-ready, dan mobile-friendly.',
        'canonical' => url('/jasa-pembuatan-website-serang'),
        'label' => 'Jasa Pembuatan Website Serang',
        'h1' => 'Jasa Pembuatan Website di Serang untuk Bisnis yang Ingin Tampil Profesional',
        'hero_copy' => 'JASAIBNU membantu bisnis di Serang dan Banten membangun website company profile, landing page, website layanan, dan sistem web yang cepat, aman, mobile-friendly, serta siap dioptimasi untuk Google.',
        'impact_label' => 'Website untuk bisnis lokal',
        'impact_title' => 'Website membantu bisnis Serang dan Banten lebih mudah ditemukan, dipercaya, dan dihubungi calon pelanggan.',
        'impact_copy' => 'Website menjadi pusat informasi resmi bisnis lokal: pelanggan bisa melihat layanan, area kerja, portfolio, alamat, kontak WhatsApp, dan penawaran sebelum memutuskan untuk bertanya atau membeli.',
        'badge' => 'Website bekerja 24 jam untuk memperkenalkan bisnis Anda ke calon pelanggan di Serang, Banten, dan sekitarnya.',
    ],
])->name('website-development-serang');
Route::view('/jasa-pembuatan-website-banten', 'pages.website-development', [
    'landing' => [
        'title' => 'Jasa Pembuatan Website Banten | Website Bisnis & UMKM',
        'meta_description' => 'Jasa pembuatan website Banten untuk bisnis, UMKM, company profile, landing page, dan website layanan yang cepat, mobile-friendly, SEO-ready, aman, dan mudah dikembangkan.',
        'canonical' => url('/jasa-pembuatan-website-banten'),
        'label' => 'Jasa Pembuatan Website Banten',
        'h1' => 'Jasa Pembuatan Website Banten untuk Bisnis, UMKM, dan Layanan Profesional',
        'hero_copy' => 'JASAIBNU membantu bisnis di Banten membangun website yang rapi, cepat dibuka, mudah dipahami pelanggan, terhubung ke WhatsApp, dan siap dipakai sebagai pusat promosi digital.',
        'impact_label' => 'Website untuk area Banten',
        'impact_title' => 'Website membantu bisnis di Banten tampil lebih kredibel dan lebih mudah dijangkau calon pelanggan online.',
        'impact_copy' => 'Dengan website yang jelas, pelanggan bisa mengenal bisnis Anda dari Google, media sosial, iklan, atau WhatsApp, lalu melihat layanan, portfolio, alamat, dan kontak dalam satu tempat yang profesional.',
        'badge' => 'Website menjadi pusat informasi bisnis yang siap melayani calon pelanggan dari Serang, Cilegon, Tangerang, Pandeglang, Lebak, dan area Banten lainnya.',
    ],
])->name('website-development-banten');
Route::view('/jasa-pembuatan-website-serang-murah', 'pages.website-development', [
    'landing' => [
        'title' => 'Jasa Pembuatan Website Serang Murah & Profesional | JASAIBNU',
        'meta_description' => 'Jasa pembuatan website Serang murah dan profesional untuk UMKM, company profile, landing page, dan website bisnis yang cepat, mobile-friendly, SEO-ready, dan mudah dikelola.',
        'canonical' => url('/jasa-pembuatan-website-serang-murah'),
        'label' => 'Jasa Website Serang Murah',
        'h1' => 'Jasa Pembuatan Website Serang Murah untuk Bisnis yang Tetap Ingin Terlihat Profesional',
        'hero_copy' => 'JASAIBNU membantu UMKM dan bisnis lokal Serang membuat website dengan biaya yang lebih efisien, tampilan rapi, struktur SEO dasar, kontak WhatsApp, dan fondasi yang bisa dikembangkan.',
        'impact_label' => 'Website hemat untuk bisnis lokal',
        'impact_title' => 'Website terjangkau tetap bisa membantu bisnis Serang terlihat serius, mudah dipercaya, dan siap menerima calon pelanggan.',
        'impact_copy' => 'Paket website yang efisien cocok untuk bisnis yang ingin mulai online tanpa membangun sistem terlalu besar sejak awal. Fokusnya jelas: profil usaha, layanan, kontak, portfolio, dan jalur konsultasi yang mudah.',
        'badge' => 'Mulai dari website sederhana yang rapi, cepat, mobile-friendly, dan siap menjadi pintu masuk pelanggan baru.',
    ],
])->name('website-development-serang-murah');
Route::view('/jasa-website-umkm-serang', 'pages.website-development', [
    'landing' => [
        'title' => 'Jasa Website UMKM Serang | Website Usaha Lokal',
        'meta_description' => 'Jasa website UMKM Serang untuk usaha lokal, toko, jasa, kuliner, bengkel, klinik, dan bisnis kecil yang ingin tampil profesional, mudah ditemukan, dan mudah dihubungi pelanggan.',
        'canonical' => url('/jasa-website-umkm-serang'),
        'label' => 'Jasa Website UMKM Serang',
        'h1' => 'Jasa Website UMKM Serang untuk Usaha Lokal yang Ingin Lebih Mudah Ditemukan',
        'hero_copy' => 'JASAIBNU membantu UMKM di Serang memiliki website usaha yang rapi, cepat, mobile-friendly, terhubung ke WhatsApp, dan mudah dipakai untuk menampilkan layanan, produk, alamat, serta bukti pekerjaan.',
        'impact_label' => 'Website untuk UMKM lokal',
        'impact_title' => 'Website membantu UMKM Serang terlihat lebih dipercaya saat pelanggan mencari produk atau layanan secara online.',
        'impact_copy' => 'Untuk UMKM, website bisa menjadi profil resmi usaha, katalog sederhana, halaman promosi, tempat menampilkan testimoni, dan tujuan iklan atau link WhatsApp agar calon pelanggan lebih yakin sebelum menghubungi.',
        'badge' => 'Cocok untuk toko, jasa lokal, kuliner, bengkel, klinik, komunitas, dan usaha kecil di Serang yang ingin mulai serius online.',
    ],
])->name('website-development-umkm-serang');
Route::get('/services', function () {
    return view('pages.services', [
        'services' => \App\Models\Service::active()->ordered()->get(),
        'technologies' => \App\Models\ServiceTechnology::active()->ordered()->get(),
    ]);
})->name('services.index');
Route::get('/solutions', function () {
    return view('pages.solutions', [
        'solutions' => \App\Models\Solution::active()->ordered()->get(),
    ]);
})->name('solutions.index');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
Route::get('/insights/{slug}', [InsightController::class, 'show'])->name('insights.show');
Route::get('/about', function () {
    return view('pages.about', [
        'about' => \App\Models\AboutPage::current(),
    ]);
})->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:contact-form')->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/weblogin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/weblogin', [AdminAuthController::class, 'login'])->name('admin.login.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', fn () => redirect()->route('admin.login'))->name('login.redirect');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('hero-slides', AdminHeroSlideController::class)->except(['show']);
        Route::resource('insights', AdminInsightController::class)->except(['show']);
        Route::resource('insight-categories', AdminInsightCategoryController::class)
            ->parameters(['insight-categories' => 'insightCategory'])
            ->except(['show']);
        Route::resource('portfolio', AdminPortfolioController::class)
            ->parameters(['portfolio' => 'portfolioItem'])
            ->except(['show']);
        Route::resource('portfolio-categories', AdminPortfolioCategoryController::class)
            ->parameters(['portfolio-categories' => 'portfolioCategory'])
            ->except(['show']);
        Route::get('/portfolio-page-settings', [AdminPortfolioPageSettingController::class, 'edit'])->name('portfolio-page-settings.edit');
        Route::put('/portfolio-page-settings', [AdminPortfolioPageSettingController::class, 'update'])->name('portfolio-page-settings.update');
        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('service-technologies', AdminServiceTechnologyController::class)->except(['show']);
        Route::resource('solutions', AdminSolutionController::class)->except(['show']);
        Route::get('/contact', [AdminContactMessageController::class, 'index'])->name('contact.index');
        Route::get('/contact/{contactMessage}', [AdminContactMessageController::class, 'show'])->name('contact.show');
        Route::patch('/contact/{contactMessage}/read', [AdminContactMessageController::class, 'markRead'])->name('contact.read');
        Route::patch('/contact/{contactMessage}/unread', [AdminContactMessageController::class, 'markUnread'])->name('contact.unread');
        Route::delete('/contact/{contactMessage}', [AdminContactMessageController::class, 'destroy'])->name('contact.destroy');
        Route::get('/site-settings', [AdminSiteSettingController::class, 'edit'])->name('site-settings.edit');
        Route::put('/site-settings', [AdminSiteSettingController::class, 'update'])->name('site-settings.update');
        Route::get('/about', [AdminAboutPageController::class, 'edit'])->name('about.edit');
        Route::put('/about', [AdminAboutPageController::class, 'update'])->name('about.update');
        Route::resource('administrators', AdministratorController::class)->parameters(['administrators' => 'user'])->except(['show']);
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
