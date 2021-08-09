<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class HeaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.default', function ($view) {
            $categories = DB::select('select category from products group by category');
            if (auth()->check()) {
                $current = DB::table('carts')
                    ->join('products', 'products.id', '=', 'carts.product_id')
                    ->select('products.name', 'products.finalPrize', 'products.images', 'carts.quantity', 'carts.id', 'carts.product_id')
                    ->where('user_id', auth()->user()->id)
                    ->where('active', true)
                    ->get();
                $count = $current->count();
                $total = 0;
                foreach ($current as $single) {
                    $total = $total + ($single->finalPrize * $single->quantity);
                }
                $view->with(['headercarts' => $current, 'headercount' => $count, 'headertotal' => $total, 'footercategories' => $categories]);
            } else {
                $view->with(['headercarts' => null, 'headercount' => 0, 'headertotal' => 0, 'footercategories' => $categories]);
            }
        });
    }
}
