<?php

namespace App\Services;


use App\Enums\OrderPaySystemEnum;
use App\Enums\OrderStatus;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Models\Order;
use Cloudipsp\Checkout;
use function App\Helpers\basket;

class OrderService
{
    public function createOrder(City $city, CityWarehouse $cityWarehouse)
    {
        $order = auth()->user()->orders()->create([
            'total' => basket()->sum(),
            'status' => 'create',
            'api' => false,
        ]);
        $basketProducts = basket()->getItems()->toArray();

        $order->products()->createMany($basketProducts);

        $order->address()->updateOrCreate([
            'city_id' => $city->id,
            'city_warehouse_id' => $cityWarehouse->id,
        ]);

        return $order;
    }

    public function cardPay(Order $order)
    {
        $service = new FondyService();
        $order->payment()->updateOrCreate([
            'currency' => "UAN",
            'amount' => $order->total,
            'status' => 'waiting',
            'system' => OrderPaySystemEnum::Card->value,
        ]);
        return $service->createPayment($order);
    }

    public function cashPay(Order $order)
    {
        $order->update([
            'status' => OrderStatus::COMPLETED,
        ]);
        $orderPayment = $order->payment()->updateOrCreate([
            'currency' => "UAN",
            'amount' => $order->total,
            'status' => 'waiting',
            'system' => OrderPaySystemEnum::Cash->value,
        ]);

        return $orderPayment;
    }
}
