<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Models\HeroSlide;
use App\Models\AboutPage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'layouts.app',
            'partials.header',
            'partials.footer',
            'pages.contact',
            'admin.layouts.app',
            'admin.auth.login',
            'admin.partials.sidebar',
        ], function ($view) {
            $settings = SiteSetting::fallback();

            try {
                if (Schema::hasTable('site_settings')) {
                    $settings = SiteSetting::current();
                }
            } catch (Throwable) {
                $settings = SiteSetting::fallback();
            }

            $view->with('siteSettings', $settings);
        });

        View::composer('home', function ($view) {
            $heroSlides = collect();
            $homepageAbout = AboutPage::fallback();

            try {
                if (Schema::hasTable('hero_slides')) {
                    $heroSlides = HeroSlide::active()->ordered()->get();
                }

                if (Schema::hasTable('about_pages')) {
                    $homepageAbout = AboutPage::current();
                }
            } catch (Throwable) {
                $heroSlides = collect();
                $homepageAbout = AboutPage::fallback();
            }

            $view->with([
                'heroSlides' => $heroSlides,
                'homepageAbout' => $homepageAbout,
            ]);
        });
    }
}
