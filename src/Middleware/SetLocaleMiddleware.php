<?php

namespace BAP\RouteLocalization\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        if (in_array($locale, config('localization.supported-locales'))) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
