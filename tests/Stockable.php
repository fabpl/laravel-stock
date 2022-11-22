<?php

namespace Fabpl\Stock\Tests;

use Fabpl\Stock\Concerns\InteractsWithStock;
use Fabpl\Stock\Contract\HasStock;
use Illuminate\Database\Eloquent\Model;

class Stockable extends Model implements HasStock
{
    use InteractsWithStock;

    public $timestamps = false;

    protected $table = 'stockables';

    protected $guarded = [];
}
