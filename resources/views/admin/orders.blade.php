@extends('layouts.admin')
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Orders</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="100px">id</th>
                    <th>User</th>
                    <th width="200px">{{$datename}} Date</th>
                    <th width="100px">Shipping</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order -> id }}</td>
                    <td>{{ $order -> name }}</br>{{ $order -> mobile }}</br> {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->pincode }}.</td>
                    <td>{{$order -> created}}</td>
                    <td>{{ $order -> shipping }}</td>
                    <td>
                        <a href="/admin/vieworder/{{$order->id}}">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
