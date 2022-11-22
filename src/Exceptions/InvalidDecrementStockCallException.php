<?php

namespace Fabpl\Stock\Exceptions;

use BadMethodCallException;

class InvalidDecrementStockCallException extends BadMethodCallException
{
    public static function make(): InvalidDecrementStockCallException
    {
        return new InvalidDecrementStockCallException('Cannot decrement stock without available quantity.');
    }
}
