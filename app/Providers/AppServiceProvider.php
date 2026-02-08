<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings and logoUrl to all views for footer
        View::composer('*', function ($view) {
            $settings = WebsiteSetting::all()->pluck('value', 'key');
            $logoUrl = isset($settings['site_logo']) && $settings['site_logo']
                ? asset('storage/' . $settings['site_logo'])
                : asset('image/logometland.png');

            $view->with('settings', $settings);
            $view->with('logoUrl', $logoUrl);
        });
    }
}
