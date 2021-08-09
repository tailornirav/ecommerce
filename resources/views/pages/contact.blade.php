@extends('layouts.default')
@section('content')

<!-- Start Breadcrumbs Section -->
<section class="breadcrumbs-section background_bg" data-img-src="/image/contact-breadcrumbs-img.jpg">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-md-12">
                <div class="page_title text-center">
                	<h1>Contact</h1>
                    <ul class="breadcrumb justify-content-center">
                    	<li><a href="/index">home</a></li>
                        <li><span>Contact</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Header Section -->

<!-- Start Contact Detail Section -->
@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
<section class="contact-inner-page pt_large">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-8 col-md-12">
            	<div class="contact-inputs">
                    <div class="title text-left">
                        <h4>Leave a Message</h4>
                    </div>
                    <form method="get" action="/contactrequest" class="contact-form form-with-label">
                        <div class="input-1">
                            <label>Your Name<span>*</span></label>
                            <input required="" class="form-control" name="name" placeholder="Enter Your Name" value="" type="text">
                        </div>
                        <div class="input-2">
                            <label>Your Email<span>*</span></label>
                            <input required="" class="form-control" name="email" placeholder="Enter Your Email" value="" type="email">
                        </div>
                        <div class="input-3">
                            <label>Your Phone<span>*</span></label>
                            <input required="" class="form-control" name="phone" placeholder="Enter Your Phone" value="" type="text">
                        </div>
                        <div class="input-4">
                            <label>subject<span>*</span></label>
                            <input required="" class="form-control" name="subject" placeholder="Enter Your Subject" value="" type="text">
                        </div>
                        <div class="input-5">
                            <label>Message<span>*</span></label>
                            <textarea required="" rows="3" class="form-control" name="message" placeholder="Your Message"></textarea>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" name="submitButton" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="contact-details">
                    <div class="title text-left">
                        <h4>Let's be in touch</h4>
                    </div>
                    <div class="contact-inner">
                        <p>Prizeman.in is a marketplace to "Discover Unique Indian Products" including Handmade, Vintage, Ethnic, Organic and Natural products from India.</p>
                        <ul class="contact-locations">
                            <li><span class="fa fa-envelope-o"></span><a href="mailto:support@prizema.in">support@prizema.in</a></li>
                            <li><span class="fa fa-phone"></span><a href="tel:7990592307">79905 92307</a></li>
                            <li><span class="fa fa-map-marker"></span><a href="mailto:support@prizema.in">B-62 IFM TEXTTILE MARKET, OPP SAGUN AVENUE, SYRAT, GUJARAT, INDIA.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
