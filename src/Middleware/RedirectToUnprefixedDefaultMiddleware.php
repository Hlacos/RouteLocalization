<?php

namespace BAP\RouteLocalization\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Route;

class RedirectToUnprefixedDefaultMiddleware
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        $currentRoute = $request->route();

        return redirect()->route($currentRoute->getName(), $currentRoute->parameters, 301);
    }
}
