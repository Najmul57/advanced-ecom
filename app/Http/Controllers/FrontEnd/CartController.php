<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart_quickview(Request $request)
    {
        $product = Product::find($request->id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1',
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $request->thumbnail
            ]
        ]);
        return response()->json('Product Added on Cart!');
    }

    public function allCart()
    {
        $data = array();
        $data['cart_qty'] = Cart::count();
        $data['cart_total'] = Cart::total();
        return response()->json($data);
    }
    public function wishlist($id)
    {
        if (Auth::check()) {
            $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();
            if ($check) {
                $notification = array('messege' => 'Already withlist add asa', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            } else {
                $data = array();
                $data['product_id'] = $id;
                $data['user_id'] = Auth::id();
                DB::table('wishlists')->insert($data);
                $notification = array('messege' => 'Product added on wishlist', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            }
        }
        else{
            $notification = array('messege' => 'Login Your Account!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        }
    }
    public function mycart()
    {
        $content=Cart::content();
        return view('frontend.cart.cart',compact('content'));
    }

    public function removeproduct($rowId)
    {
        Cart::remove($rowId);
        return response()->json('Success');
    }
    public function updateqty($rowId,$qty)
    {
        Cart::update($rowId,['qty'=>$qty]);
        return response()->json('Successfully Updated');
    }
    public function updatecolor($rowId,$color)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;
        Cart::update($rowId,['options'=>['color'=>$color,'thumbnail'=>$thumbnail,'size'=>$size]]);
        return response()->json('Successfully Updated');
    }
    public function updatesize($rowId,$size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId,['options'=>['size'=>$size,'thumbnail'=>$thumbnail,'color'=>$color]]);
        return response()->json('Successfully Updated');
    }
    public function cartempty()
    {
        Cart::destroy();
        $notification = array('messege' => 'Cart item clear!', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification);
    }
}
