<?php

namespace BAP\RouteLocalization\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RedirectToPrefixedDefaultMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request,)
    {
        $currentRoute = $request->route();

        return redirect()->route(
            str_replace_first(
                'redirect_to_prefixed_default',
                config('app.fallback_locale'),
                $currentRoute->getName()
            ),
            $currentRoute->parameters,
            301
        );
    }
}
