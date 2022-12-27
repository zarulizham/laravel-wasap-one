<?php

namespace ZarulIzham\WasapOne;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ZarulIzham\WasapOne\Http\Livewire\GenerateQR;

class WasapOneServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        Livewire::component('wasap-one.generate-qr', GenerateQR::class);

        $this->publishes([
            __DIR__.'/../config/wasap-one.php' => config_path('wasap-one.php'),
        ]);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wasap-one')
            ->hasConfigFile('wasap-one')
            ->hasViews('wasap-one');

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'wasap-one');
    }
}
