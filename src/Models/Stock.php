<?php

namespace Fabpl\Stock\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Stock extends Model
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'stockable_id' => 'integer',
        'quantity' => 'integer',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'stockable_id',
        'stockable_type',
        'quantity',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        return config('stock.table_names.stocks', parent::getTable());
    }

    /**
     * A stock mutation belongs to a stockable model.
     *
     * @return MorphTo
     */
    public function stockable(): MorphTo
    {
        return $this->morphTo();
    }
}
