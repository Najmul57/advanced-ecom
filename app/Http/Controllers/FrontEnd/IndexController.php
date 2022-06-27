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
        $category = Category::all();
        $bannerproduct = DB::table('products')->where('product_slider',1)->latest()->first();
        // return $bannerproduct;
        return view('frontend.index',compact('category','bannerproduct'));
    }
    public function productDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $relatedproduct = DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','desc')->take(10)->get();
        // return response()->json($relatedproduct);
        $review = review::where('product_id',$product->id)->orderBy('id','desc')->take(6)->get();
        return view('frontend.product_details',compact('product','relatedproduct','review'));
    }
}
