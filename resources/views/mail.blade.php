<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:first-child {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
</body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
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
            <td><a href="http://prizema.in/product/{{$cart->product_id}}"><?php echo $counter; $counter += 1;?>. {{$cart->name}}</a></td>
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
</div>

</html>
