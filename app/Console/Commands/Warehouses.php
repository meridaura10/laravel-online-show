<?php

namespace App\Console\Commands;

use App\Jobs\WarehouseJob;
use Illuminate\Console\Command;

class Warehouses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:warehouses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new WarehouseJob());
    }
}
