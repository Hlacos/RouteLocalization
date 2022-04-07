# Route Localization plugin

This plugin is creating localized route groups. Sets application locale based on url...

## Installation

### Run composer require

> composer require hlacos/route-localization

### Publish configuration

> php artisan vendor publish --provider="BAP\RouteLocalization\RouteLocalizationServiceProvider" --tag="config"

### Configure package

* **supported-locales:** array of the supported locales
* **use_prefix_on_default_locale:** set true if you want to use locale segment in url for default language as well
* **redirect_to_default_locale:** if it is true based on previous configuration, it will redirect between prefixed and not prefixed default language url-s. If you use prefixed default url and locale segment is missing (/* (301)-> /[default-locale]/*), or you not using prefix but in the given url is contains locale prefix (/[default-locale/*] (301)-> /*). 

### Add package service provider to app config

> BAP\RouteLocalization\RouteLocalizationServiceProvider::class

