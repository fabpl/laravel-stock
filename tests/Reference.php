<?php

namespace Fabpl\Stock\Tests;

use Fabpl\Stock\Concerns\ReferencesInStockMutations;
use Fabpl\Stock\Contract\CauseStockMutation;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model implements CauseStockMutation
{
    use ReferencesInStockMutations;

    public $timestamps = false;

    protected $table = 'references';

    protected $guarded = [];
}
