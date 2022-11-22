<?php

namespace Fabpl\Stock\Contract;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface HasStock
{
    public function getStockQuantityAttribute(): int;

    public function stock(): MorphOne;

    public function stock_mutations(): MorphMany;

    public function incrementStock(int $quantity = 1, ?string $description = null, ?CauseStockMutation $causer = null): void;

    public function decrementStock(int $quantity = 1, ?string $description = null, ?CauseStockMutation $causer = null): void;
}
