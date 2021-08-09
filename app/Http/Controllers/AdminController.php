<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use DB;
use Mail;
use Artisan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }
    public function orders()
    {
        $orders = DB::table('place_orders')
            ->join('users', 'users.id', '=', 'place_orders.user_id')
            ->select('place_orders.id', 'place_orders.shipping', 'users.name', 'users.mobile', 'users.address', 'users.city', 'users.state', 'users.pincode', 'place_orders.created_at as created')
            ->where('accepted', 0)
            ->orderBy('created', 'desc')
            ->get();
        return view('admin.orders', ['orders' => $orders, 'datename' => 'Create ']);
    }
    public function confirmOrders()
    {
        $orders = DB::table('place_orders')
            ->join('users', 'users.id', '=', 'place_orders.user_id')
            ->select('place_orders.id', 'place_orders.shipping', 'users.name', 'users.mobile', 'users.address', 'users.city', 'users.state', 'users.pincode', 'place_orders.updated_at as created')
            ->where('accepted', 1)
            ->orderBy('created', 'desc')
            ->get();
        return view('admin.orders', ['orders' => $orders, 'datename' => 'Approve ']);
    }
    public function rejectedOrders()
    {
        $orders = DB::table('place_orders')
            ->join('users', 'users.id', '=', 'place_orders.user_id')
            ->select('place_orders.id', 'place_orders.shipping', 'users.name', 'users.mobile', 'users.address', 'users.city', 'users.state', 'users.pincode', 'place_orders.updated_at as created')
            ->where('accepted', 2)
            ->orderBy('created', 'desc')
            ->get();
        return view('admin.orders', ['orders' => $orders, 'datename' => 'Reject ']);
    }
    public function viewOrder($id)
    {
        $order = DB::table('place_orders')
            ->join('users', 'users.id', '=', 'place_orders.user_id')
            ->select('place_orders.id', 'place_orders.shipping', 'place_orders.created_at', 'place_orders.accepted', 'users.name', 'users.mobile', 'users.address', 'users.city', 'users.state', 'users.pincode', 'users.email')
            ->where('place_orders.id', $id)
            ->first();
        $carts = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->where('place_order_id', $id)
            ->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += ($cart->finalPrize * $cart->quantity);
        }

        return view('admin.vieworder', ['order' => $order, 'carts' => $carts, 'total' => $total]);
    }
    public static function sendmail($id)
    {
        $order = DB::table('place_orders')
            ->join('users', 'users.id', '=', 'place_orders.user_id')
            ->select('place_orders.id', 'place_orders.shipping', 'place_orders.created_at', 'users.name', 'users.mobile', 'users.address', 'users.city', 'users.state', 'users.pincode', 'users.email')
            ->where('place_orders.id', $id)
            ->first();
        $carts = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->where('place_order_id', $id)
            ->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += ($cart->finalPrize * $cart->quantity);
        }

        Mail::send('mail', ['order' => $order, 'carts' => $carts, 'total' => $total], function ($message) use($order) {
            $message->to($order->email, $order->name)->subject('Your order confirmation with Invoice.');
            $message->from('Prizema2020@gmail.com', 'Prizema.in');
        });
    }
    public function approveOrder($id)
    {
        $carts =  DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->where('place_order_id', $id)
            ->get();

        foreach ($carts as $cart) {
            $current_available = DB::table('products')->where('id', $cart->product_id)->first();

            DB::table('products')
                ->where('id', $cart->product_id)
                ->update(['availability' => $current_available->availability - $cart->quantity]);
        }

        AdminController::sendmail($id);

        DB::table('place_orders')
            ->where('id', $id)
            ->update(['accepted' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->intended('/admin/orders');
    }
    public function rejectOrder($id)
    {
        $carts =  DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->where('place_order_id', $id)
            ->get();

        foreach ($carts as $cart) {
            $current_available = DB::table('products')->where('id', $cart->product_id)->first();

            DB::table('products')
                ->where('id', $cart->product_id)
                ->update(['availability' => $current_available->availability +  $cart->quantity]);
        }

        DB::table('place_orders')
            ->where('id', $id)
            ->update(['accepted' => 2, 'updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->intended('/admin/orders');
    }
    public function getBanner()
    {
        $banner = DB::table('banners')->get();
        return view('admin.banner', ['banners' => $banner]);
    }
    public function deleteBanner($id)
    {
        if (DB::table('banners')->count() !== 1) {
            Storage::delete(DB::table('banners')->where('id', $id)->first()->image);
            DB::table('banners')->where('id', $id)->delete();
        }

        return redirect()->intended('/admin/banner');
    }
    public function addBanner(Request $request)
    {
        $path = $request->file('file')->storePublicly('banners');
        DB::table('banners')
            ->insert([
                'name' => $request->name,
                'image' => $path,
                'discription' => $request->discription,
                'url' => $request->url,

            ]);
        return redirect()->intended('/admin/banner');
    }
    public function getProduct()
    {
        $product = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.product', ['products' => $product]);
    }
    public function addproductform($id) {
        if($id != -1) {
            return view('admin.new-product', ['product' => DB::table('products')->where('id', $id)->first()]);
        }
        return view('admin.new-product');
    }
    public function addProduct(Request $request)
    {
        $count = $request->count;
        if ($count > 0) {
            $db_path = "";
            for ($i = 0; $i < $count; $i++) {
                $path = $request->file('file')[$i]->storePublicly('products');
                if ($i === 0)
                    $db_path = $path;
                else
                    $db_path = $db_path . ',' . $path;
            }
        }
        if ($request->id == "-1") {
            DB::table('products')
                ->insert([
                    'name' => $request->name,
                    'images' => $db_path,
                    'prize' => $request->prize,
                    'finalPrize' => $request->finalPrize,
                    'availability' => $request->availability,
                    'discription' => $request->discription,
                    'brand' => $request->brand,
                    'season' => $request->season,
                    'color' => $request->color,
                    'fit' => $request->fit,
                    'size' => $request->size,
                    'category' => $request->category,
                    'created_at' => date('Y-m-d G:i:s'),
                ]);
        } else {
            if ($count == 0) {
                DB::table('products')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'prize' => $request->prize,
                        'finalPrize' => $request->finalPrize,
                        'availability' => $request->availability,
                        'discription' => $request->discription,
                        'brand' => $request->brand,
                        'season' => $request->season,
                        'color' => $request->color,
                        'fit' => $request->fit,
                        'size' => $request->size,
                        'category' => $request->category,
                    ]);
            } else {
                DB::table('products')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'images' => $db_path,
                        'prize' => $request->prize,
                        'finalPrize' => $request->finalPrize,
                        'availability' => $request->availability,
                        'discription' => $request->discription,
                        'brand' => $request->brand,
                        'season' => $request->season,
                        'color' => $request->color,
                        'fit' => $request->fit,
                        'size' => $request->size,
                        'category' => $request->category,
                    ]);
            }
        }
    }
    public function deleteProduct($id)
    {
        if (DB::table('products')->count() !== 1) {
            $products = DB::table('products')->where('id', $id)->first()->images;
            foreach (explode(',', $products) as $image) {
                Storage::delete($image);
            }
            DB::table('carts')->where('product_id', $id)->delete();
            DB::table('products')->where('id', $id)->delete();
        }

        return redirect()->intended('/admin/product');
    }
    public function contacts()
    {
        return view('admin.contacts', ['contacts' => DB::table('contacts')->get()]);
    }
    public function getShipping()
    {
        return view('admin.shipping', ['shipping' => DB::table('shippings')->first()]);
    }
    public function updateShipping()
    {
        DB::table('shippings')
            ->where('id', 1)
            ->update(['charge' => $_GET['shipping']]);

        return redirect()->intended('/admin');
    }
    public function subscription()
    {
        $subscriptions = DB::table('suscribes')->get();
        $mail_string = "";
        foreach ($subscriptions as $subscribe) {
            if ($mail_string === "") {
                $mail_string = $subscribe->email;
            } else {
                $mail_string = $mail_string . ', ' . $subscribe->email;
            }
        }
        return view('admin.subscription', ['string' => $mail_string]);
    }
}
