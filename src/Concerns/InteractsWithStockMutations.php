<?php

namespace Fabpl\Stock\Concerns;

use Fabpl\Stock\Contract\CauseStockMutation;
use Fabpl\Stock\Exceptions\InvalidDecrementStockCallException;
use Fabpl\Stock\Exceptions\InvalidQuantityStockArgumentException;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait InteractsWithStockMutations
{
    /**
     * A stockable model has many stock mutations.
     *
     * @return MorphMany
     */
    public function stock_mutations(): MorphMany
    {
        return $this->morphMany(config('stock.models.stock_mutation'), 'stockable');
    }

    public function incrementStock(int $quantity = 1, ?string $description = null, ?CauseStockMutation $causer = null): void
    {
        if ($quantity <= 0) {
            throw InvalidQuantityStockArgumentException::make();
        }

        $this->stock_mutations()->create(collect([
            'quantity' => $quantity,
            'description' => $description,
        ])->when($causer, function ($collection) use ($causer) {
            return $collection
                ->put('reference_type', get_class($causer))
                ->put('reference_id', $causer->getKey());
        })->toArray());

        if ($this->stock()->exists()) {
            $this->stock()->increment('quantity', $quantity);
        } else {
            $this->stock()->create([
                'quantity' => $quantity,
            ]);
        }
    }

    public function decrementStock(int $quantity = 1, ?string $description = null, ?CauseStockMutation $causer = null): void
    {
        if ($quantity <= 0) {
            throw InvalidQuantityStockArgumentException::make();
        }

        if (! $this->stock()->exists()) {
            throw InvalidDecrementStockCallException::make();
        }

        if ($this->stock->quantity < $quantity) {
            throw InvalidDecrementStockCallException::make();
        }

        $this->stock_mutations()->create(collect([
            'quantity' => -1 * $quantity,
            'description' => $description,
        ])->when($causer, function ($collection) use ($causer) {
            return $collection
                ->put('reference_type', get_class($causer))
                ->put('reference_id', $causer->getKey());
        })->toArray());

        $this->stock()->decrement('quantity', $quantity);
    }
}
