<?php

namespace BAP\RouteLocalization;

use Illuminate\Support\ServiceProvider as ServiceProvider;
use BAP\RouteLocalization\Providers\RoutingServiceProvider;

class RouteLocalizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/route-localization.php' => config_path('route-localization.php'),
            ], 'config');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RoutingServiceProvider::class);
    }
}
