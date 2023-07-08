<?php

namespace App\Console\Commands;

use App\Jobs\PaymentCheckStatusJob;
use Illuminate\Console\Command;

class PaymentCheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:paymentStatus';

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
        dispatch(new PaymentCheckStatusJob());
    }
}
