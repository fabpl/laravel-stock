<?php

namespace Fabpl\Stock;

use Fabpl\LaravelStock\Commands\LaravelStockCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class StockServiceProvider extends PackageServiceProvider
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
            ->hasConfigFile('stock')
            ->hasMigration('create_stock_table');
    }
}
