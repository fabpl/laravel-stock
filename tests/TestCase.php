<?php

namespace Fabpl\Stock\Tests;

use Fabpl\Stock\StockServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected Stockable $stockable;

    protected function setUp(): void
    {
        parent::setUp();

        $migration = include __DIR__.'/../database/migrations/create_stock_table.php.stub';
        $migration->up();

        $builder = $this->app['db']->connection()->getSchemaBuilder();

        $builder->create('stockables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $builder->create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $this->reference = Reference::create(['name' => 'Test Stockable']);
        $this->stockable = Stockable::create(['name' => 'Test Stockable']);
    }

    protected function getPackageProviders($app): array
    {
        return [
            StockServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
