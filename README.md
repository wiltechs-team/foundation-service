Foundation Service
======================

[![Packagist](https://img.shields.io/packagist/v/wiltechsteam/foundation-service.svg)](https://packagist.org/packages/goodjun/foundation-service)
[![Packagist](https://img.shields.io/packagist/l/wiltechsteam/foundation-service.svg)](https://packagist.org/packages/goodjun/foundation-service)
[![Packagist](https://img.shields.io/packagist/dm/wiltechsteam/foundation-service.svg)]()

TL;DR
-----
Foundation service in laravel.

Install
-------
Install via composer

```
composer require wiltechsteam/foundation-service
```

Add Service Provider to `config/app.php` in `providers` section

```php
wiltechsteam\FoundationService\FoundationServiceProvider::class,
```

Generate config file

```
php artisan vendor:publish  --provider="wiltechsteam\FoundationService\FoundationServiceProvider"
```

Usage
-----

```
php artisan foundation:work
```

