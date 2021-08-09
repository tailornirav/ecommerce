<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\BannersController@getBanner');
Route::get('/index', 'App\Http\Controllers\BannersController@getBanner');

Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@getProduct');
Route::get('/addreview/{id}', 'App\Http\Controllers\ProductsController@addReview');
Route::get('/shop/{sort}', 'App\Http\Controllers\ProductsController@getProducts');

Route::get('/login', 'App\Http\Controllers\UsersController@login');
Route::get('/register', 'App\Http\Controllers\UsersController@register');
Route::get('/logout', 'App\Http\Controllers\UsersController@logout');

Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index');
Route::get('/place', 'App\Http\Controllers\CheckoutController@place');

Route::get('/addtocart/{id}', 'App\Http\Controllers\CartsController@addToCart');
Route::get('/removefromcart/{id}', 'App\Http\Controllers\CartsController@removeFromCart');
Route::get('/updatecart/{id}/{quantity}', 'App\Http\Controllers\CartsController@updateCart');
Route::get('/cart', 'App\Http\Controllers\CartsController@index');

Route::get('/suscribe', 'App\Http\Controllers\SuscribeController@suscribe');

Route::get('/contactrequest', 'App\Http\Controllers\ContactController@contact');

Route::get('/contact', function () {
    return View::make('pages.contact');
});

Route::get('/about', function () {
    return View::make('pages.about');
});

Route::get('/account', function () {
    return View::make('pages.account');
});

Route::get('/terms', function () {
    return View::make('pages.terms');
});
Route::get('/privacy', function () {
    return View::make('pages.privacy');
});
/*------------------------------------------------------------------------------------------------*/

Route::middleware(['adminauth'])->group(function () {
    Route::get('/admin', 'App\Http\Controllers\AdminController@orders');
    Route::get('/admin/orders', 'App\Http\Controllers\AdminController@orders');
    Route::get('/admin/vieworder/{id}', 'App\Http\Controllers\AdminController@viewOrder');
    Route::get('/rejectorder/{id}', 'App\Http\Controllers\AdminController@rejectOrder');
    Route::get('/approveorder/{id}', 'App\Http\Controllers\AdminController@approveOrder');
    Route::get('/admin/confirmorders', 'App\Http\Controllers\AdminController@confirmOrders');
    Route::get('/admin/rejectedorders', 'App\Http\Controllers\AdminController@rejectedOrders');


    // Route::get('/admin/banner', 'App\Http\Controllers\AdminController@getBanner');
    // Route::post('/addbanner', 'App\Http\Controllers\AdminController@addBanner');
    // Route::get('/deletebanner/{id}', 'App\Http\Controllers\AdminController@deleteBanner');
    Route::get('/admin/shipping', 'App\Http\Controllers\AdminController@getShipping');
    Route::get('/updateshipping', 'App\Http\Controllers\AdminController@updateShipping');

    Route::get('/admin/subscription', 'App\Http\Controllers\AdminController@subscription');

    Route::get('/admin/product', 'App\Http\Controllers\AdminController@getProduct');
    Route::get('/admin/addproductform/{id}', 'App\Http\Controllers\AdminController@addproductform');
    Route::post('/addproduct', 'App\Http\Controllers\AdminController@addProduct');
    Route::get('/deleteproduct/{id}', 'App\Http\Controllers\AdminController@deleteProduct');

    Route::get('/admin/contacts/', 'App\Http\Controllers\AdminController@contacts');

    Route::get('/admin/productimage', function () {
        return View::make('admin.productimage');
    });
    Route::get('/admin/productdiscription', function () {
        return View::make('admin.productdiscription');
    });
    Route::get('/adminlogout', 'App\Http\Controllers\AdminController@adminlogout');
});
Route::get('/adminlogin', 'App\Http\Controllers\AdminController@adminlogin');
