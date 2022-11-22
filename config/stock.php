<?php

return [

    'models' => [

        /*
         * When using the "HasStock" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your stocks. Of course, it
         * is often just the "Stock" model, but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Fabpl\Stock\Contracts\Permission` contract.
         */

        'stock' => Fabpl\Stock\Models\Stock::class,

        /*
         * When using the "HasStockMutations" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your stock mutations. Of course, it
         * is often just the "StockMutation" model, but you may use whatever you like.
         *
         * The model you want to use as a StockMutation model needs to implement the
         * `Fabpl\Stock\Contracts\StockMutation` contract.
         */

        'stock_mutation' => Fabpl\Stock\Models\StockMutation::class,

    ],

    'table_names' => [

        /*
         * When using the "HasStock" trait from this package, we need to know which
         * table should be used to retrieve your stocks. We have chosen a basic
         * default value, but you may easily change it to any table you like.
         */

        'stocks' => 'stocks',

        /*
         * When using the "HasStockMutations" trait from this package, we need to know which
         * table should be used to retrieve your stock mutations. We have chosen a basic
         * default value, but you may easily change it to any table you like.
         */

        'stock_mutations' => 'stock_mutations',
    ],

];
