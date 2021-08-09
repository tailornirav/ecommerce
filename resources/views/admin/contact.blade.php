@extends('layouts.admin')
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Active <b>Orders</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="100px">id</th>
                    <th>User</th>
                    <th>Cart</th>
                    <th width="100px">Shipping</th>
                    <th width="100px">Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order -> id }}</td>
                    <td>{{ $order -> name }}</br>{{ $order -> mobile }}</br> {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->pincode }}.</td>
                    <td>
                        @foreach($carts -> $cart)
                        @if($cart->place_orders_id === $order->id)
                        hello
                        @endif
                        @endforeach
                    </td>
                    <td>{{ $order -> shipping }}</td>
                    <td>(171) 555-2222</td>
                    <td>
                        <a class="edit" title="Accept" data-toggle="tooltip"><i class="material-icons">check</i></a>
                        <a class="delete" title="Reject" data-toggle="tooltip"><i class="material-icons">close</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
