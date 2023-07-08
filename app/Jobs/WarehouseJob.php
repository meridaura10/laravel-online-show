<?php

namespace App\Jobs;

use App\Services\NovaPoshtaService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WarehouseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NovaPoshtaService $service)
    {
        $page = 1;
        $limit = 200;
        $total = 400;

        while ($page < ($total / $limit) + 1) {
            $response = $service->getWareHouses($page,$limit);
            if ($response){
                $total = $response['info']['totalCount'];
                $service->updateOrCreateWareHouses($response['data']);
                $page++;
            }
            sleep(2);
        }
    }
}
