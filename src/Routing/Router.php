<?php

namespace BAP\RouteLocalization\Routing;

use BAP\RouteLocalization\Contracts\RouterContract;
use Closure;

class Router implements RouterContract
{
    /**
     * @return Closure
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function localizedGroup(): Closure
    {
        return function (Closure $callback, array $attributes = []) {
            /**
             * Add routing on all language
             */
            foreach (config('route-localization.supported-locales') as $locale) {
                $middlewares = ['set-locale'];

                if ($locale == config('app.fallback_locale')) {
                    if (
                        (
                            config('route-localization.use_prefix_on_default_locale') &&
                            config('route-localization.redirect_to_default_locale')
                        ) ||
                        (
                            config('route-localization.use_prefix_on_default_locale') &&
                            !config('route-localization.redirect_to_default_locale')) ||
                        (
                            !config('route-localization.use_prefix_on_default_locale') &&
                            config('route-localization.redirect_to_default_locale')
                        )
                    ) {
                        if (
                            !config('route-localization.use_prefix_on_default_locale') &&
                            config('route-localization.redirect_to_default_locale')
                        ) {
                            $middlewares[] = 'redirect-to-unprefixed';
                        }

                        $routeGroupParameters = [
                            'prefix'     => $locale,
                            'as'         => $locale . '.',
                            'locale'     => $locale,
                            'middleware' => $middlewares
                        ];

                        $attributesForLocale = array_merge($attributes, $routeGroupParameters);

                        $this->group(array_filter($attributesForLocale), $callback);
                    }
                }

                if ($locale != config('app.fallback_locale')) {
                    $routeGroupParameters = [
                        'prefix'     => $locale,
                        'as'         => $locale . '.',
                        'locale'     => $locale,
                        'middleware' => $middlewares
                    ];

                    $attributesForLocale = array_merge($attributes, $routeGroupParameters);

                    $this->group(array_filter($attributesForLocale), $callback);
                }
            }

            /**
             * Add unprefixed routing for default language with redirect middleware
             */
            if (
                !config('route-localization.use_prefix_on_default_locale') ||
                config('route-localization.redirect_to_default_locale')
            ) {
                $locale = config('app.fallback_locale');
                $middlewares = ['set-locale'];
                $name = $locale;

                if (
                    config('route-localization.use_prefix_on_default_locale') &&
                    config('route-localization.redirect_to_default_locale')
                ) {
                    $middlewares[] = 'redirect-to-prefixed';
                    $name = 'redirect_to_prefixed_default';
                }

                $routeGroupParameters = [
                    'as'         => $name  . '.',
                    'locale'     => $locale,
                    'middleware' => $middlewares
                ];

                $attributesForLocale = array_merge($attributes, $routeGroupParameters);

                $this->group(array_filter($attributesForLocale), $callback);
            }
        };
    }
}
