@extends('layouts/default')
@section('content')
<!-- Start Breadcrumbs Section -->
<section class="breadcrumbs-section background_bg" data-img-src="/image/shop-breadcrumbs-img.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page_title text-center">
                    <h1>shop</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="/index">home</a></li>
                        <li><span>shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Header Section -->

<!-- Start Shop Section -->
@if (session('alert'))
<div class="alert alert-success">
    {{ session('alert') }}
</div>
@endif
<section class="shop-inner-section pt_large pb_large">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="shop-options d-sm-flex justify-content-between align-items-center">
                    <div class="sorting-option">
                        <select class="sorting-items" onchange="window.location.href='/shop/'+this.value+'?'+(window.location.href).split('?')[1]">
                            <option value="0" @if ($sort==0) selected='selected' @endif>Default sorting</option>
                            <option value="1" @if ($sort==1) selected='selected' @endif>Sort by popularity</option>
                            <option value="2" @if ($sort==2) selected='selected' @endif>Sort by price: low to high</option>
                            <option value="3" @if ($sort==3) selected='selected' @endif>Sort by price: high to low</option>
                        </select>
                    </div>
                    <div class="showing-items">
                        <p>Showing {{ $products -> firstItem() }}–{{ $products -> lastItem() }} of {{ $products -> total() }} results</p>
                    </div>
                    <div class="shop-list_grid">
                        <div class="list_grid-btns">
                            <a href="javascript:void(0)" class="list-view"><i class="ion-navicon-round"></i></a>
                            <a href="javascript:void(0)" class="grid-view on"><i class="ion-grid"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row list_grid_container grid justify-content-center">
                    @foreach ($products as $product)
                    <div class="col-md-4 col-6">
                        <div class="product-box common-cart-box box-1">
                            <div class="product-img common-cart-img">
                                <img src="/{{explode(',', $product -> images)[0]}}" alt="product-img">
                                <div class="hover-option">
                                    <!-- <form action="/addtocart/{{ $product -> id }}">
                                        <div class="add-cart-btn">
                                            <input type="hidden" name="quantity" value="1" />
                                            <button type="submit" @if(($product -> availability) == 0) disabled="" @endif class="btn btn-primary">Add To Cart</button>
                                        </div>
                                    </form> -->
                                    <a href="/product/{{$product -> id}}" class="btn btn-primary">View Product</a>
                                </div>
                            </div>
                            <div class="product-info common-cart-info text-center">
                                <a href="/product/{{$product -> id}}" class="cart-name">{{ $product -> name}}</a>
                                <p class="cart-price"><del>₹ {{ $product -> prize }}</del>₹ {{ $product -> finalPrize }}</p>
                                <div class="product-list-text">{!! $product -> discription !!}</div>
                                <div class="hover-option">
                                    <div class="add-cart-btn">
                                        <a href="#" class="btn btn-primary">Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                {{ $products->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 order-lg-first">
                <div class="shop-sidebar">
                    <div class="side-quantity-box side-box">
                        <div class="side-box-title">
                            <h6>Categories</h6>
                        </div>
                        <div class="quantity-box-detail">
                            <ul>
                                <li><a href="/shop/0?searchbox=sarees">SAREES</a></li>
                                <li><a href="/shop/0?searchbox=kurties">KURTIS & DRESSES</a></li>
                                <li><a href="/shop/0?searchbox=salwar">SALWAR SUITS</a></li>
                                <li><a href="/shop/0?searchbox=lehengas">LEHENGAS & GOWNS</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="side-quantity-box side-box">
                        <div class="side-box-title">
                            <h6>recent Product</h6>
                        </div>
                        <div class="side-recent-product">
                            @foreach ($recents as $recent)
                            <div class="cart-prodect d-flex">
                                <div class="cart-img">
                                    <img src="/{{explode(',', $recent -> images)[0]}}" alt="product-img">
                                </div>
                                <div class="cart-product">
                                    <a href="/product/{{ $recent -> id }}">{{ $recent -> name }}</a>
                                    <a href="/product/{{ $recent -> id }}" class="cp-comments"><i class="fa fa-tags"></i> {{ $recent -> category }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media screen and ( max-width: 600px ){
        li.page-item {
            display: none;
        }

        .page-item:first-child,
        .page-item:nth-child( 2 ),
        .page-item:nth-last-child( 2 ),
        .page-item:last-child,
        .page-item.active,
        .page-item.active + .page-item,
        .page-item.disabled {
            display: block;
        }
    }
    </style>
</section>
<!-- End Shop Section -->
@stop
