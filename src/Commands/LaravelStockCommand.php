<?php

namespace Fabpl\LaravelStock\Commands;

use Illuminate\Console\Command;

class LaravelStockCommand extends Command
{
    public $signature = 'laravel-stock';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
