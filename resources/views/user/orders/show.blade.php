@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="order-details p-4">
            <h2>замовлення</h2>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> {{ $order['id'] }}</p>
                    <p><strong>Status:</strong> {{ $order['status'] }}</p>
                    <p><strong>Total:</strong> {{ $order['total'] }}</p>
                    <p><strong>Created At:</strong> {{ $order['created_at'] }}</p>
                </div>
            </div>
            <div class="product-list mt-4">
                <h2>Products</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order['products'] as $product)
                        <tr>
                            <td>{{ $product['product']['name'] }}</td>
                            <td>{{ $product['product']['description'] }}</td>
                            <td>{{ $product['product']['price'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ $product['total'] * $product['quantity'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
