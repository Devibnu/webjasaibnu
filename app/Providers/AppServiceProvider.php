<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
        View::composer(['layouts.app', 'partials.header', 'partials.footer', 'pages.contact'], function ($view) {
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
    }
}
