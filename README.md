Foundation Service
======================

[![Packagist](https://img.shields.io/packagist/v/goodjun/foundation-service.svg)](https://packagist.org/packages/goodjun/foundation-service)
[![Packagist](https://img.shields.io/packagist/l/goodjun/foundation-service.svg)](https://packagist.org/packages/goodjun/foundation-service)
[![Packagist](https://img.shields.io/packagist/dm/goodjun/foundation-service.svg)]()

TL;DR
-----
Foundation service in laravel.

Install
-------
Install via composer

```
composer require goodjun/foundation-service
```

Add Service Provider to `config/app.php` in `providers` section

```php
goodjun\FoundationService\FoundationServiceProvider::class,
```

Generate config file

```
php artisan vendor:publish  --provider="goodjun\FoundationService\FoundationServiceProvider"
```

Usage
-----

```
php artisan foundation:work
```
