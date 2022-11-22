<?php

namespace Fabpl\Stock\Concerns;

use Fabpl\Stock\Models\StockMutation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ReferencesInStockMutations
{
    /**
     * A reference model has many stock mutations.
     *
     * @return MorphMany
     */
    public function stock_references(): MorphMany
    {
        return $this->morphMany(StockMutation::class, 'reference');
    }
}
