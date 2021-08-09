<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function getProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if ($product === null)
            abort(404);
        $reviews = DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->select('users.name', 'reviews.*')
            ->where('product_id', $id)
            ->get();
        $reviewCount = $reviews->count();
        $recentProducts = DB::table('products')->latest()->limit(4)->get();

        return view('pages.product', ['product' => $product, 'reviews' => $reviews, 'reviewCount' => $reviewCount, 'recentProducts' => $recentProducts]);
    }

    public function getProducts($sort)
    {
        Paginator::useBootstrap();

        $categories = DB::select('select category,count(*) as count from products group by category order by count desc');

        $search = $_GET['searchbox'] ?? 0;
        if ($search !== 0 && $sort != 0) {
            $products = DB::table('products')->where('name', 'like', '%' . $search . '%')->orWhere('category', 'like', '%' . $search . '%')->orWhere('season', 'like', '%' . $search . '%');
            switch ($sort) {
                case 1:
                    $products = $products->latest()->paginate(9)->withQueryString();
                    break;
                case 2:
                    $products = $products->orderBy('finalPrize', 'asc')->paginate(9)->withQueryString();
                    break;
                case 3:
                    $products = $products->orderBy('finalPrize', 'desc')->paginate(9)->withQueryString();
                    break;
                default:
                    $products->inRandomOrder()->paginate(9)->withQueryString();
            }
        } else if ($search !== 0) {
            $products = DB::table('products')->where('name', 'like', '%' . $search . '%')->orWhere('category', 'like', '%' . $search . '%')->orWhere('season', 'like', '%' . $search . '%')->paginate(9)->withQueryString();
        } else if ($sort != 0) {
            switch ($sort) {
                case 1:
                    $products = DB::table('products')->latest()->paginate(9)->withQueryString();
                    break;
                case 2:
                    $products = DB::table('products')->orderBy('finalPrize', 'asc')->paginate(9)->withQueryString();
                    break;
                case 3:
                    $products = DB::table('products')->orderBy('finalPrize', 'desc')->paginate(9)->withQueryString();
                    break;
                default:
                    $products = DB::table('products')->inRandomOrder()->paginate(9)->withQueryString();
            }
        } else {
            $products = DB::table('products')->inRandomOrder()->paginate(9)->withQueryString();
        }

        $recentProducts = DB::table('products')->latest()->limit(6)->get();

        return view('pages.shop', ['products' => $products, 'sort' => $sort, 'search' => $search, 'categories' => $categories, 'recents' => $recentProducts]);
    }

    public function addReview($id)
    {
        DB::table('reviews')->insert([
            'review' => $_GET['review'],
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'created_at' =>  date('Y-m-d G:i:s'),
        ]);
        return redirect()->back();
    }
}
