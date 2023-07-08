<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use Cloudipsp\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('user.orders.show',compact('order'));
    }


    public function create()
    {

        return view('user.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function response(Request $request)
    {
        $result = new \Cloudipsp\Result\Result($request->all(), 'test');
        return redirect()->route('products.index');
    }
}
