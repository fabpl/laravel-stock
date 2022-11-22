<?php

namespace Fabpl\Stock\Concerns;

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
        return $this->morphMany(config('stock.models.stock_mutation'), 'reference');
    }
}
