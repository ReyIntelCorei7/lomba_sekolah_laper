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
        // Force HTTPS on production (Vercel)
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share settings and logoUrl to public views only (exclude admin views)
        View::composer(['layouts.*', 'news.*', 'ppdb.*', 'aboutschool.*', 'kurikulum.*', 'program_keahlian.*', 'errors.*', 'eskul.*'], function ($view) {
            try {
                $settings = WebsiteSetting::all()->pluck('value', 'key');
            } catch (\Exception $e) {
                $settings = collect();
            }
            $logoUrl = isset($settings['site_logo']) && $settings['site_logo']
                ? asset('storage/' . $settings['site_logo'])
                : asset('image/logometland.png');

            $view->with('settings', $settings);
            $view->with('logoUrl', $logoUrl);
        });
    }
}
