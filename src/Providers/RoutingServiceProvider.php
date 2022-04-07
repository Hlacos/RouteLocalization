<?php

namespace BAP\RouteLocalization\Providers;

use BAP\RouteLocalization\Middleware\RedirectToPrefixedDefaultMiddleware;
use BAP\RouteLocalization\Middleware\RedirectToUnprefixedDefaultMiddleware;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use BAP\RouteLocalization\Routing\Router;
use BAP\RouteLocalization\Middleware\SetLocaleMiddleware;

class RoutingServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'set-locale' => SetLocaleMiddleware::class,
        'redirect-to-prefixed' => RedirectToPrefixedDefaultMiddleware::class,
        'redirect-to-unprefixed' => RedirectToUnprefixedDefaultMiddleware::class
    ];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        /** @var  \Illuminate\Routing\Router  $router */
        $router = $this->app['router'];

        $router->mixin(new Router());

        foreach ($this->routeMiddleware as $name => $class) {
            $router->aliasMiddleware($name, $class);
        }
    }
}
