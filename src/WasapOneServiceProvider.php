<?php

namespace ZarulIzham\WasapOne;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ZarulIzham\WasapOne\Commands\WasapOneCommand;

class WasapOneServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wasap-one')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-wasap-one_table')
            ->hasCommand(WasapOneCommand::class);
    }
}
