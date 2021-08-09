@extends('layouts.default')
@section('content')

<!-- Start Breadcrumbs Section -->
<section class="breadcrumbs-section background_bg" data-img-src="/image/cart-breadcrumbs-img.jpg">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-md-12">
                <div class="page_title text-center">
                	<h1>My Account</h1>
                    <ul class="breadcrumb justify-content-center">
                    	<li><a href="/index">home</a></li>
                        <li><a href="/shop/0">shop</a></li>
                        <li><span>My Account</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Header Section -->



<!-- Start My Account Section -->
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<section class="pt_large pb_large">
	<div class="container">
    	<div class="row">
        	<div class="col-md-6 mb-4 mb-md-0">
            	<div class="title">
                	<h4>Login</h4>
                </div>
            	<form method="get" action="/login" class="login_form ">
                    <div class="form-group">
                        <label>Email Address<span class="required">*</span></label>
                        <input type="text" required="" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input class="form-control" required="" type="password" name="password">
                    </div>
                    <div class="form-group form-check p-0">
                        <label>Remember me
                            <input class="defult-check" type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <a href="#" class="forgot-password float-right">Forgot Password ?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="login" value="Log in">Log in</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
            	<div class="title">
                	<h4>Register</h4>
                </div>
            	<form action="/register" method="get" class="login_form ">
                    <div class="form-group">
                        <label>Name <span class="required">*</span></label>
                        <input type="text" required="" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label>Email address <span class="required">*</span></label>
                        <input type="email" required="" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input minlength="8" class="form-control" required="" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="login" value="Register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End My Account Section -->
@stop
