<?php

namespace Fabpl\Stock\Concerns;

use Fabpl\Stock\Models\Stock;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithStock
{
    use InteractsWithStockMutations;

    /**
     * Return the stock quantity for the model.
     *
     * @return int
     */
    public function getStockQuantityAttribute(): int
    {
        return $this->stock?->quantity ?? 0;
    }

    /**
     * A stockable model has one stock.
     *
     * @return MorphOne
     */
    public function stock(): MorphOne
    {
        return $this->morphOne(Stock::class, 'stockable');
    }
}
