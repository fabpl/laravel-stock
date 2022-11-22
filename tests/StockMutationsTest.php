<?php

use Fabpl\Stock\Exceptions\InvalidDecrementStockCallException;
use Fabpl\Stock\Exceptions\InvalidQuantityStockArgumentException;
use Fabpl\Stock\Models\StockMutation;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

it('can have no mutations', function () {
    assertEmpty($this->stockable->stock_mutations->toArray());
});

it('can increment stock', function () {
    $this->stockable->incrementStock(2, 'Incremented stock #2');
    $this->stockable->incrementStock(3, 'Incremented stock #3');
    $this->stockable->incrementStock(4, 'Incremented stock #4');

    $mutations = $this->stockable->stock_mutations;

    $quantities = $mutations->pluck(['quantity'])->toArray();
    assertEquals([2, 3, 4], $quantities);

    $descriptions = $mutations->pluck(['description'])->toArray();
    assertEquals(['Incremented stock #2', 'Incremented stock #3', 'Incremented stock #4'], $descriptions);

    assertEquals(9, $this->stockable->fresh()->stock_quantity);
});

it('can increment stock with reference', function () {
    $this->stockable->incrementStock(2, null, $this->reference);

    $mutation = $this->stockable->stock_mutations->first();

    assertEquals($this->reference->id, $mutation->reference_id);
    assertEquals(get_class($this->reference), $mutation->reference_type);
    assertEquals($this->reference->stock_references()->first()->id, $mutation->id);
});

it('throws exception when negative quantity is set to increment stock', function () {
    $this->stockable->incrementStock(-1);
})->throws(InvalidQuantityStockArgumentException::class);

it('can decrement stock', function () {
    $this->stockable->incrementStock(2, 'Decremented stock #2');
    $this->stockable->decrementStock(1, 'Decremented stock #1');

    $mutations = $this->stockable->stock_mutations;

    $quantities = $mutations->pluck(['quantity'])->toArray();
    assertEquals([2, -1], $quantities);

    $descriptions = $mutations->pluck(['description'])->toArray();
    assertEquals(['Decremented stock #2', 'Decremented stock #1'], $descriptions);

    assertEquals(1, $this->stockable->fresh()->stock_quantity);
});

it('can decrement stock with reference', function () {
    $this->stockable->incrementStock(2);
    $this->stockable->decrementStock(2, null, $this->reference);

    assertEquals($this->reference->id, $this->stockable->stock_mutations->last()->reference_id);
    assertEquals(get_class($this->reference), $this->stockable->stock_mutations->last()->reference_type);
});

it('throws exception when negative quantity is set to decrement stock', function () {
    $this->stockable->decrementStock(-1);
})->throws(InvalidQuantityStockArgumentException::class);

it('throws exception when try to decrement without stock', function () {
    $this->stockable->decrementStock(2);
})->throws(InvalidDecrementStockCallException::class);

it('throws exception when there no sufficient quantity to decrement stock', function () {
    $this->stockable->incrementStock(2);
    $this->stockable->decrementStock(3);
})->throws(InvalidDecrementStockCallException::class);

it('can access to stockable model from stock mutation', function () {
    $this->stockable->incrementStock(2);

    assertTrue($this->stockable->is(StockMutation::first()->stockable));
});

it('can access to reference model from stock mutation', function () {
    $this->stockable->incrementStock(2, null, $this->reference);

    assertTrue($this->reference->is(StockMutation::first()->reference));
});
