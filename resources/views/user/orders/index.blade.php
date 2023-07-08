@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>замовлення</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Total</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="table-row pointer" onclick="window.location.href='/orders/{{ $order['id'] }}'" onmouseover="this.style.backgroundColor='#f2f2f2'" onmouseout="this.style.backgroundColor='transparent'">
                    <td>{{ $order['id'] }}</td>
                    <td>{{ $order['status'] }}</td>
                    <td>{{ $order['total'] }}</td>
                    <td>{{ $order['created_at'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

