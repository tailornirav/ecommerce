<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    public function getBanner() {
        $banners = DB::select('select * from banners');
        $products = DB::select('select * from products limit 12');
        return view('pages.welcome', ['banners' => $banners, 'products' => $products]);
    }
}
