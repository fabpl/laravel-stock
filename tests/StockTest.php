<?php

use Fabpl\Stock\Models\Stock;
use function PHPUnit\Framework\assertTrue;

it('can access to stockable model from stock', function () {
    $this->stockable->incrementStock(2);

    assertTrue($this->stockable->is(Stock::first()->stockable));
});
