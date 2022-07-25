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
        $brands = DB::table('brands')->where('front_page',1)->limit(24)->get();
        $bannerproduct = Product::where('status', 1)->where('product_slider', 1)->latest()->first();
        $featured = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'desc')->limit(5)->get();
        $today_deal = Product::where('status', 1)->where('today_deal', 1)->orderBy('id', 'desc')->limit(5)->get();
        $popular_product = Product::where('status', 1)->orderBy('product_views', 'desc')->limit(5)->get();
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(12)->get();
        $trendy_product = Product::where('status', 1)->where('trendy', 1)->orderBy('id', 'desc')->limit(5)->get();
        $home_category = DB::table('categories')->where('home_page', 1)->orderBy('category_name', 'ASC')->get();
        $reviews=DB::table('wbreviews')->where('status',1)->orderBy('id','DESC')->limit(12)->get();
        // dd($reviews);
        return view('frontend.index', compact('category', 'bannerproduct', 'featured', 'popular_product', 'trendy_product', 'home_category', 'brands', 'random_product','today_deal','reviews'));
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

    public function categoryWiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
            $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
            $brand=DB::table('brands')->get();
            $random_product = Product::where('status', 1)->inRandomOrder()->limit(12)->get();
            $products=DB::table('products')->where('category_id',$id)->paginate(60);
            return view('frontend.product.category_product',compact('subcategory','brand','products','category','random_product'));
    }
    public function subcategoryWiseProduct($id)
    {
            $subcategory=DB::table('subcategories')->where('id',$id)->first();
            $childcategories=DB::table('childcategories')->where('subcategory_id',$id)->get();
            $brand=DB::table('brands')->get();
            $random_product = Product::where('status', 1)->inRandomOrder()->limit(12)->get();
            $products=DB::table('products')->where('subcategory_id',$id)->paginate(60);
            return view('frontend.product.subcategory_product',compact('subcategory','brand','products','random_product','childcategories'));
    }
    public function childcategoryWiseProduct($id)
    {
            $childcategory=DB::table('childcategories')->where('id',$id)->first();
            $categories=DB::table('categories')->get();
            $brand=DB::table('brands')->get();
            $random_product = Product::where('status', 1)->inRandomOrder()->limit(12)->get();
            $products=DB::table('products')->where('childcategory_id',$id)->paginate(60);
            return view('frontend.product.childcategory_product',compact('childcategory','categories','brand','random_product','products'));
    }
    
    public function brandWiseProduct($id)
    {
            $brand=DB::table('brands')->where('id',$id)->first();
            $categories=DB::table('categories')->get();
            $brands=DB::table('brands')->get();
            $random_product = Product::where('status', 1)->inRandomOrder()->limit(12)->get();
            $products=DB::table('products')->where('brand_id',$id)->paginate(16);
            return view('frontend.product.brandwise_product',compact('brand','categories','categories','brands','random_product','products'));
    }
    

}
