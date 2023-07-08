<?php

namespace App\Services;


use App\Contracts\PaymentGatewayInterface;
use App\Enums\OrderPaymentFondyStatusEnum;
use App\Enums\OrderPaymentStatus;
use App\Models\Order;
use Cloudipsp\Checkout;

class FondyService implements PaymentGatewayInterface
{
    public function __construct()
    {
        \Cloudipsp\Configuration::setMerchantId('1396424');
        \Cloudipsp\Configuration::setSecretKey('test');
    }

    public function createPayment(Order $order): string
    {
        $data = [
            'order_desc' => 'tests SDK',
            'currency' => "UAH",
            'amount' => $order->total * 100,
            'response_url' => route('response', ['order' => $order->id]),
            'server_callback_url' => route('response', ['order' => $order->id]),
            'order_id' => $order->id,
            'lifetime' => 36000,
        ];
        $url = Checkout::url($data);
        $redirectUrl = $url->getUrl();
        return $redirectUrl;
    }
    public function checkPayment(Order $order): string
    {
        $dataToGetStatus = [
            'order_id' => $order->id,
        ];
        $orderStatus = \Cloudipsp\Order::status($dataToGetStatus);
        switch ($orderStatus->getData()['order_status']){
            case OrderPaymentFondyStatusEnum::created->name:
                return OrderPaymentStatus::created->value;
                break;
            case OrderPaymentFondyStatusEnum::processing->name:
                return OrderPaymentStatus::processing->value;
                break;
            case OrderPaymentFondyStatusEnum::approved->name:
                return OrderPaymentStatus::approved->value;
                break;
            case OrderPaymentFondyStatusEnum::declined->name:
                return OrderPaymentStatus::declined->value;
                break;
            case OrderPaymentFondyStatusEnum::reversed->name:
                return OrderPaymentStatus::reversed->value;
                break;
            case OrderPaymentFondyStatusEnum::expired->name:
                return OrderPaymentStatus::expired->value;
                break;
        }
    }
}
