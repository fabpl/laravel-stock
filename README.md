# Laravel Stock

Keep stock for Eloquent models. 
This package will track stock mutations for your models. 
You can increase, decrease stock.

## Installation

You can install the package via composer:

```bash
composer require fabpl/laravel-stock
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="stock-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="stock-config"
```

This is the contents of the published config file:

```php
return [

    'models' => [

        /*
         * When using the "InteractsWithStock" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your stocks. Of course, it
         * is often just the "Stock" model, but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Fabpl\Stock\Contracts\Permission` contract.
         */

        'stock' => Fabpl\Stock\Models\Stock::class,

        /*
         * When using "InteractsWithStockMutations" or "ReferencesInStockMutations" traits from this package, we need to know which
         * Eloquent model should be used to retrieve your stock mutations. Of course, it
         * is often just the "StockMutation" model, but you may use whatever you like.
         *
         * The model you want to use as a StockMutation model needs to implement the
         * `Fabpl\Stock\Contracts\StockMutation` contract.
         */

        'stock_mutation' => Fabpl\Stock\Models\StockMutation::class,

    ],

    'table_names' => [

        /*
         * When using the "InteractsWithStock" trait from this package, we need to know which
         * table should be used to retrieve your stocks. We have chosen a basic
         * default value, but you may easily change it to any table you like.
         */

        'stocks' => 'stocks',

        /*
         * When using "InteractsWithStockMutations" or "ReferencesInStockMutations" traits from this package, we need to know which
         * table should be used to retrieve your stock mutations. We have chosen a basic
         * default value, but you may easily change it to any table you like.
         */

        'stock_mutations' => 'stock_mutations',
    ],

];
```

## Preparing your model

To associate stock with a model, the model must implement the following interface and trait:

```php
use \Fabpl\Stock\Concerns\InteractsWithStock;
use \Fabpl\Stock\Contract\HasStock;

class Product extends Model implements HasStock
{
    use InteractsWithStock;
}
```

To increment stock, you can use the `incrementStock` method:

```php
$product->incrementStock(10);
```

To decrement stock, you can use the `decrementStock` method:

```php
$product->decrementStock(10);
```

If you want to use _reference_ functionality, the model must implement the following interface and trait:

```php
use \Fabpl\Stock\Concerns\ReferencesInStockMutations;
use \Fabpl\Stock\Contract\CauseStockMutation;

class Order extends Model implements CauseStockMutation
{
    use ReferencesInStockMutations;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Fabrice Planchette](https://github.com/fabpl)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
