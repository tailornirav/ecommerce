@extends('layouts.admin')
@section('content')
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Invoice #: {{$order -> id}}<br>
                            Created: {{$order->created_at}}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            {{ $order -> name }}<br>
                            {{ $order -> mobile }}<br>
                            {{ $order->address }}, <br>
                            {{ $order->city }}, {{ $order->state }}, {{ $order->pincode }}.<br>
                            {{$order->email}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>Item</td>
            <td>Prize</td>
            <td>Quantity</td>
            <td>Total</td>
        </tr>
        <?php $counter = 1;?>
        @foreach($carts as $cart)
        <tr class="item">
            <td><?php echo $counter; $counter += 1;?>. <a href="/product/{{$cart->product_id}}">{{$cart->name}}</a></td>
            <td>{{$cart->finalPrize}}</td>
            <td>{{$cart->quantity}}</td>
            <td>{{$cart->finalPrize * $cart->quantity}}</td>
        </tr>
        @endforeach
        <td>
        </td>
        <td>
        </td>
        <td>
            <b>Shipping Charge:
        </td>

        <td>
            {{$order->shipping}}
        </td>

        <tr class="total">
            <td></td>
            <td></td>
            <td><b>Total:</b></td>

            <td>
                {{$total + $order->shipping}}
            </td>
        </tr>

    </table>
    @if($order->accepted === 0)
    <button><a href="/approveorder/{{$order->id}}">Approve</a></button>
    <button><a href="/rejectorder/{{$order->id}}">Reject</a></button>
    @endif
</div>
@stop
