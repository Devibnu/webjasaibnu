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
