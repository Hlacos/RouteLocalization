<?php

function currentRouteOnLocale($locale)
{
    $currentRoute = request()->route();

    return localizedRoute(plainRouteName($currentRoute->getName()), $currentRoute->parameters(), null, $locale);
}

function plainRouteName($name)
{
    $array = explode('.', $name);
    unset($array[0]);

    return implode('.', $array);
}

function localesForLangSelect()
{
    $locales = supportedLocales();
    unset($locales[app()->getLocale()]);
    return $locales;
}

function localizedRouteName($routeName, $locale = null)
{
    if (is_null($locale)) {
        $locale = app()->getLocale();
    }

    return $locale . '.' . $routeName;
}

/**
 * @param $routeName
 * @param array $parameters
 * @param bool $absolute
 * @param null $locale
 * @return mixed
 *
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
function localizedRoute($routeName, $parameters = [], $absolute = true, $locale = null)
{
    return route(localizedRouteName($routeName, $locale), $parameters, $absolute);
}
