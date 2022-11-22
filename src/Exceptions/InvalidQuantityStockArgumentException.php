<?php

namespace Fabpl\Stock\Exceptions;

use InvalidArgumentException;

class InvalidQuantityStockArgumentException extends InvalidArgumentException
{
    public static function make(): InvalidQuantityStockArgumentException
    {
        return new InvalidQuantityStockArgumentException('Invalid quantity stock argument');
    }
}
