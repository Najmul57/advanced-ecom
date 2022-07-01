<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $category = DB::table('categories')->get();
        $brands = DB::table('brands')->where('front_page',1)->limit(12)->get();
        $bannerproduct = Product::where('status', 1)->where('product_slider', 1)->latest()->first();
        $featured = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'desc')->limit(5)->get();
        $popular_product = Product::where('status', 1)->orderBy('product_views', 'desc')->limit(5)->get();
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(12)->get();
        $trendy_product = Product::where('status', 1)->where('trendy', 1)->orderBy('id', 'desc')->limit(5)->get();
        $home_category = DB::table('categories')->where('home_page', 1)->orderBy('category_name', 'ASC')->get();
        return view('frontend.index', compact('category', 'bannerproduct', 'featured', 'popular_product', 'trendy_product', 'home_category', 'brands', 'random_product'));
    }
    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        Product::where('slug', $slug)->increment('product_views');
        $relatedproduct = DB::table('products')->where('subcategory_id', $product->subcategory_id)->orderBy('id', 'desc')->take(10)->get();
        // return response()->json($relatedproduct);
        $review = review::where('product_id', $product->id)->orderBy('id', 'desc')->take(6)->get();
        return view('frontend.product.product_details', compact('product', 'relatedproduct', 'review'));
    }
    public function product_quick_view($id)
    {
        $product = Product::where('id', $id)->first();
        return view('frontend.product.quick_view', compact('product'));
    }
}
