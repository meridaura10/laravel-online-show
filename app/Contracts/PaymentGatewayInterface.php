<?php

namespace App\Contracts;

use App\Models\Order;

interface PaymentGatewayInterface {
    public function createPayment(Order $order): string;
    public function checkPayment(Order $order): string;

}
