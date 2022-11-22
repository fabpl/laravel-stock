<?php

namespace Fabpl\Stock\Contract;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @method string getKey()
 */
interface CauseStockMutation
{
    public function stock_references(): MorphMany;
}
