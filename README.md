# Simple multi-tenancy for Laravel Jetstream apps

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisdicarlo/simple-jetstream-multitenancy.svg?style=flat-square)](https://packagist.org/packages/chrisdicarlo/simple-jetstream-multitenancy)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/chrisdicarlo/simple-jetstream-multitenancy/run-tests?label=tests)](https://github.com/chrisdicarlo/simple-jetstream-multitenancy/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/chrisdicarlo/simple-jetstream-multitenancy/Check%20&%20fix%20styling?label=code%20style)](https://github.com/chrisdicarlo/simple-jetstream-multitenancy/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisdicarlo/simple-jetstream-multitenancy.svg?style=flat-square)](https://packagist.org/packages/chrisdicarlo/simple-jetstream-multitenancy)

Simple package to support multi-tenancy in Laravel Jetstream using a trait, with some development niceties thrown in.

## Installation

You can install the package via composer:

```bash
composer require chrisdicarlo/simple-jetstream-multitenancy
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Chrisdicarlo\SimpleJetstreamMultitenancy\SimpleJetstreamMultitenancyServiceProvider" --tag="simple-jetstream-multitenancy-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Chrisdicarlo\SimpleJetstreamMultitenancy\SimpleJetstreamMultitenancyServiceProvider" --tag="simple-jetstream-multitenancy-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$simple-jetstream-multitenancy = new Chrisdicarlo\SimpleJetstreamMultitenancy();
echo $simple-jetstream-multitenancy->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Chris Di Carlo](https://github.com/chrisdicarlo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
