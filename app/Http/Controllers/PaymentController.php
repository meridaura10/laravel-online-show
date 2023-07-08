<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function response(Request $request)
    {
        $result = new \Cloudipsp\Result\Result($request->all(), 'test');
        $order = Order::find($result->getData()['order_id']);
        $order->update([
            'status' => 'approved',
        ]);
        return redirect()->route('orders.show',compact('order'));
    }
}
