<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->intended('/cart')->with([
                'alert' => 'You have to login first!!'
            ]);
        }

        $checkExisting = DB::table('carts')
            ->where('user_id', auth()->user()->id)
            ->where('active', true)
            ->first();

        if (!$checkExisting) {
            return redirect()->intended('/cart')->with([
                'alert' => 'Nothing in cart!!!'
            ]);
        }
        $checktoback = false;
        $currentcart = DB::table('carts')
            ->where('user_id', auth()->user()->id)
            ->where('active', true)
            ->get();
        foreach ($currentcart as $check) {
            $product = DB::table('products')
                ->where('id', $check->product_id)
                ->first();
            if (($check->quantity) > ($product->availability)) {
                DB::table('carts')
                    ->where('id', $check->id)
                    ->update(['quantity' => $product->availability]);
                $checktoback = true;
            }
        }

        if ($checktoback) {
            return redirect()->intended('/')->with([
                'alert' => 'Your cart has been updated due to availability, please verify changes!!!'
            ]);
        }

        $user = DB::table('users')->where('id', auth()->user()->id)->first();
        $current = DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->select('products.name', 'products.finalPrize', 'products.images', 'products.availability', 'carts.quantity', 'carts.id', 'carts.product_id')
            ->where('user_id', auth()->user()->id)
            ->where('active', true)
            ->get();

        $total = 0;
        foreach ($current as $single) {
            $total = $total + ($single->finalPrize * $single->quantity);
        }
        $shipping = DB::table('shippings')->first();
        return view('pages.checkout', ['user' => $user, 'carts' => $current, 'total' => $total, 'shipping' => $shipping]);
    }

    public function place()
    {
        $mobile = $_GET['mobile'];
        $address = $_GET['address'];
        $city = $_GET['city'];
        $state = $_GET['state'];
        $pincode = $_GET['pincode'];

        $user = DB::table('users')
            ->where('id', auth()
                ->user()
                ->id)
            ->update(['mobile' => $mobile, 'address' => $address, 'city' => $city, 'state' => $state, 'pincode' => $pincode]);

        $shipping = DB::table('shippings')->first();

        $currents = DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->select('products.name', 'products.finalPrize', 'products.images', 'products.availability', 'carts.quantity', 'carts.id', 'carts.product_id')
            ->where('user_id', auth()->user()->id)
            ->where('active', true)
            ->get();

        $order = DB::table('place_orders')->insertGetId([
            'user_id' => auth()->user()->id,
            'shipping' => $shipping->charge,
            'accepted' => 0,
            'created_at' =>  date('Y-m-d H:i:s')
        ]);


        foreach ($currents as $current) {
            DB::table('orders')->insert([
                'place_order_id' => $order,
                'product_id' => $current->product_id,
                'quantity' => $current->quantity
            ]);

            DB::table('carts')
                ->where('id', $current->id)
                ->update([
                    'active' => false
                ]);
        }
        return redirect()->intended('/index')->with([
            'alert' => 'Your order has been placed successfully!!'
        ]);
    }
}
