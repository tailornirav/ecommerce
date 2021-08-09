@extends('layouts.default')
@section('content')

<!-- Start Breadcrumbs Section -->
<section class="breadcrumbs-section background_bg" data-img-src="/image/pd-breadcrumbs-img.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page_title text-center">
                    <h1>Product Detail</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="/index">home</a></li>
                        <li><a href="/shop/0">Shop</a></li>
                        <li><span>Product Detail</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Header Section -->

<!-- Start Product Detail Section -->
@if (session('alert'))
<div class="alert alert-success">
    {{ session('alert') }}
</div>
@endif

<section class="products-detail-section pt_large">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="product-image d-lg-none">
                    <img src="/{{ explode(',', $product -> images)[0] }}" />
                </div>
                <div class="product-image d-lg-block d-none">
                    <img class="product_img zoom-img"  id="img_01" src="/{{ explode(',', $product -> images)[0] }}"  data-zoom-image="/{{ explode(',', $product -> images)[0] }}" />
                </div>
                <div id="gal1" class="product_gallery_item owl-thumbs-slider owl-carousel owl-theme">
                    <?php $enableActive = true; ?>
                    @foreach(explode(',', $product -> images) as $image)
                    <div class="item">
                        <a href="#" <?php if ($enableActive) {
                                        echo 'class="active"';
                                        $enableActive = false;
                                    } ?> data-image="/{{ $image }}" data-zoom-image="/{{ $image }}">
                            <img id="img_01" src="/{{ $image }}" />
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-7">
                <div class="quickview-product-detail">
                    <h2 class="box-title">{{ $product -> name }}</h2>
                    <h3 class="box-price"><del>₹ {{ $product -> prize }}</del>₹ {{ $product -> finalPrize }}</h3>
                    <p id='editor' class="box-text">{!! $product -> discription !!}</p>
                    <p class="stock">Availability: <span>@if ($product -> availability > 0) In Stock @else Not Available @endif</span></p>
                    <form method="get" action="/addtocart/{{ $product -> id }}">
                        <div class="quantity-box">
                            <p>Quantity:</p>
                            <div class="input-group">
                                <input type="button" value="-" class="minus">
                                <input class="quantity-number qty" style="-webkit-appearance: none;margin=0;-moz-appearance: textfield;" type="number" name="quantity" value="{{ $product -> availability == 0? 0:1 }}" min="0" max="{{ $product -> availability }}">
                                <input type="button" value="+" class="plus">
                            </div>
                            <div class="quickview-cart-btn">
                                @if(!auth()->check())
                                <a href="#test-popup1"  @if(($product -> availability) == 0) disabled="" @endif class="btn btn-primary open-popup-link"><img src="/image/cart-icon-1.png" alt="cart-icon-1"> Add To Cart</a>
                                @else
                                <button type="submit" @if(($product -> availability) == 0) disabled="" @endif class="btn btn-primary"><img src="/image/cart-icon-1.png" alt="cart-icon-1"> Add To Cart</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="box-social-like d-sm-flex justify-content-between">
                        <ul class="hover-icon box-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Detail Section -->

<!-- Start Product Tabs Section -->
<section class="products-detail-tabs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="products-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="discription-tab" data-toggle="tab" href="#discription" role="tab" aria-controls="discription" aria-selected="true">Discription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ai-tab" data-toggle="tab" href="#ai" role="tab" aria-controls="ai" aria-selected="false">ADDITIONAL INFORMATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">REVIEWS ({{ $reviewCount }})</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade tab-1 show active" id="discription" role="tabpanel" aria-labelledby="discription-tab">
                            <div class="tab-title">
                                <h6>Discription</h6>
                            </div>
                            <div class="tab-caption">
                                <p>{!! $product -> discription !!}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade tab-2" id="ai" role="tabpanel" aria-labelledby="ai-tab">
                            <div class="tab-title">
                                <h6>Additional information</h6>
                            </div>
                            <div class="tab-caption">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td colspan="1">Brand</td>
                                                <td>{{ $product -> brand }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">Season</td>
                                                <td>{{ $product -> season }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">Color</td>
                                                <td>{{ $product -> color }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">Meter</td>
                                                <td>{{ $product -> fit }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">Size</td>
                                                <td>{{ $product -> size }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade tab-3" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="tab-title">
                                <h6>Costomer Reviews</h6>
                            </div>
                            <div class="tab-caption">
                                <div class="costomer-reviews">
                                    @foreach ($reviews as $review)
                                    <div class="costomer-reviews-box">
                                        <div class="reviews-text">
                                            <p class="reviewer-name">{{ $review -> name }}</p>
                                            <span class="reviews-date">{{ $review -> created_at }}</span>
                                            <p class="reviewer-text">{{ $review -> review }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(auth()->check())
                            <div class="tab-caption">
                                <div class="add-review">
                                    <div class="tab-title">
                                        <h6>Add a review</h6>
                                    </div>
                                    <form class="add-review-form" method="get" action="/addreview/{{ $product -> id }}">
                                        <div class="input-3">
                                            <textarea required rows="6" class="form-control" name="review" placeholder="Enter Your Review"></textarea>
                                        </div>
                                        <div class="input-btn">
                                            <button type="submit" class="btn btn-secondary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                            <div class="tab-caption">Please login to add review!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Tabs Section -->

<!-- Start Related Product Section -->
<section class="related-product pb_large">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h4>RELATED PRODUCTS</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="products-slider4 same-nav owl-carousel owl-theme" data-margin="30" data-dots="false">
                    @foreach($recentProducts as $recentProduct)
                    <div class="item">
                        <div class="product-box common-cart-box">
                            <div class="product-img common-cart-img">
                                <img src="/{{explode(',', $recentProduct -> images)[0]}}" alt="product-img">
                                <div class="hover-option">
                                    <!-- <form action="/addtocart/{{ $product -> id }}">
                                        <div class="add-cart-btn">
                                            <input type="hidden" name="quantity" value="1" />
                                            <button type="submit" @if(($product -> availability) == 0) disabled="" @endif class="btn btn-primary">Add To Cart</button>
                                        </div>
                                    </form> -->
                                    <a href="/product/{{$recentProduct -> id}}" class="btn btn-primary">View Product</a>
                                </div>
                            </div>
                            <div class="product-info common-cart-info text-center">
                                <a href="/product/{{$recentProduct -> id}}" class="cart-name">{{ $recentProduct -> name}}</a>
                                <p class="cart-price"><del>₹ {{ $recentProduct -> prize }}</del>₹ {{ $recentProduct -> finalPrize }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Related Product Section -->

@stop
