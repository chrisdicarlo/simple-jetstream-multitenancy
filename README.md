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

And then run the install command.  This will prompt you to specify which model is the tenant and publish the config file:

```bash
php artisan sjm:install
```

## Usage

You can create a migration to add the appropriate tenant columns to tables that should be tenant aware:

```bash
php artisan sjm:migration App\\Models\\Post
```

This will generate a migration file that looks like this:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('tenant_id');
            $table->dropColumn('tenant_id');
        });
    }
};
```

Lastly, add the ChrisDiCarlo\SimpleJetstreamMultitenancy\TenantAware trait to the applicable model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chrisdicarlo\SimpleJetstreamMultitenancy\TenantAware;

class Post extends Model
{
    ...
    use TenantAware;
    ...
}
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
