<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Chrisdicarlo\SimpleJetstreamMultitenancy\Commands\InstallCommand;

class SimpleJetstreamMultitenancyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('simple-jetstream-multitenancy')
            ->hasConfigFile()
            ->hasCommand(InstallCommand::class);
    }
}
