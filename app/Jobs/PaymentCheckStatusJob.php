<?php

namespace App\Jobs;

use App\Enums\OrderPaymentStatus;
use App\Enums\OrderPaySystemEnum;
use App\Enums\OrderStatus;
use App\Models\OrderPayment;
use App\Services\FondyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentCheckStatusJob implements ShouldQueue
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
    public function handle()
    {
        $service = new FondyService();
        $payments = OrderPayment::where('system', OrderPaySystemEnum::Card->value)->get();
        foreach ($payments as $payment) {
            $order = $payment->order;
            $status = $service->checkPayment($order);
            if ($status === OrderPaymentStatus::declined->value || $status === OrderPaymentStatus::reversed->value){
                $order->update(['status' => OrderStatus::CANCELLED->value]);
            }
            $payment->update(['status' => $status]);
        }
    }
}
