<?php

namespace App\Console\Commands;

use App\Jobs\CitiesJob;
use Illuminate\Console\Command;

class Cities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:cities';

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
    public function handle(): void
    {
        dispatch(new CitiesJob());
    }
}
