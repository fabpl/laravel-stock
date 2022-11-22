<?php

namespace Fabpl\LaravelStock;

use Fabpl\LaravelStock\Commands\LaravelStockCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelStockServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-stock')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-stock_table')
            ->hasCommand(LaravelStockCommand::class);
    }
}
