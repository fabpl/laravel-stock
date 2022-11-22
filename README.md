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
php artisan vendor:publish --tag="laravel-stock-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-stock-config"
```

This is the contents of the published config file:

```php
return [
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
