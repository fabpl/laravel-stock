<?php

namespace Fabpl\LaravelStock\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fabpl\LaravelStock\LaravelStock
 */
class LaravelStock extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fabpl\LaravelStock\LaravelStock::class;
    }
}
