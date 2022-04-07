<?php

namespace BAP\RouteLocalization\Contracts;

use Closure;

interface RouterContract
{
    public function localizedGroup(): Closure;
}
