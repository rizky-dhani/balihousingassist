<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Services\AnalyticsService;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use RalphJSmit\Laravel\SEO\TagManager;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TagManager::class);

        $this->app->singleton(AnalyticsService::class, function ($app) {
            return new AnalyticsService(
                config('analytics.service_account_credentials_json'),
                config('analytics.property_id')
            );
        });
    }

    public function boot(): void
    {
        FilamentAsset::register([
            Css::make('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css'),
            Js::make('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js'),
        ]);

        View::composer('*', function ($view) {
            $view->with('siteSettings', SiteSetting::getSingleton());
        });
    }
}
