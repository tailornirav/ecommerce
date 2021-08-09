@extends('layouts.default')
@section('content')

<!-- Start Breadcrumbs Section -->
<section class="breadcrumbs-section background_bg" data-img-src="//image/cart-breadcrumbs-img.jpg">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-md-12">
                <div class="page_title text-center">
                	<h1>my cart</h1>
                    <ul class="breadcrumb justify-content-center">
                    	<li><a href="/index">home</a></li>
                        <li><a href="#">shop</a></li>
                        <li><span>cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Header Section -->



<!-- Start Cart Section -->
@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
<section class="cart-section pt_large">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<div class="cart-table table-responsive">
                	<table class="table table-bordered text-center">
                    	<thead>
                        	<tr class="row-1">
                            	<th class="row-title"><p>Item</p></th>
                                <th class="row-title"><p>Product Name</p></th>
                                <th class="row-title"><p>Price</p></th>
                                <th class="row-title"><p>Quantity</p></th>
                                <th class="row-title"><p>Subtotal</p></th>
                                <th class="row-title"><p></p></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($carts as $cart)
                        	<tr class="row-2">
                            	<td class="row-close close-1" data-title="product-remove"><a href="#"><i class="ion-close-circled"></i></a></td>
                            	<td class="row-img"><img src="/{{explode(',', $cart -> images)[0]}}" width="50px" heigth="100px" alt="product-img"></td>
                                <td class="product-name" data-title="Product"><a href="/product/{{ $cart -> product_id }}">{{ $cart -> name }}</a></td>
                                <td class="product-price" data-title="Price"><p>₹ {{ $cart -> finalPrize }}</p></td>
                                <td class="product-quantity" data-title="Quantity">
                                	<div class="quantity_filter">
                                        <input class="quantity-number qty" onchange="window.location.href='/updatecart/{{$cart -> id}}/'+this.value" style="-webkit-appearance: none;margin=0;-moz-appearance: textfield;" type="number" value="{{ $cart -> quantity }}" min="0" max="{{ $cart -> availability }}">
                               		</div>
                                </td>
                                <td class="product-total" data-title="Subprice"><p>₹ {{ ($cart -> finalPrize) * ($cart -> quantity) }}</p></td>
                                <td class="row-close close-2" data-title="product-remove"><a href="/removefromcart/{{ $cart -> id }}"><i class="ion-close-circled"></i></a></td>
                            </tr>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12">
                                    <ul class="table-btn">
                                        <li><a href="/shop/0" class="btn btn-secondary"><i class="fa fa-chevron-left"></i>Continue Shopping</a></li>
                                        <li><a href="/checkout" class="btn btn-secondary">Proceed To checkout <i class="fa fa-chevron-right"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Cart Section -->
@stop
