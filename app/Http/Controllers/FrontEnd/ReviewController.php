<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($check) {
            $notification = array('messege' => 'Already Review!', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['product_id'] = $request->product_id;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d-m-Y');
        $data['review_month'] = date('F');
        $data['review_year'] = date('Y');
        DB::table('reviews')->insert($data);
        $notification = array('messege' => 'Thank you for review', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function writereview()
    {
        return view('user.review_wirte');
    }
    public function storewebsitereview(Request $request)
    {
        $check=DB::table('wbreviews')->where('user_id',Auth::id())->first();
        if($check){
            $notification = array('messege' => 'Review Already Exits', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        $data = array();
        $data['user_id'] = Auth::id();
        $data['name'] = $request->name;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d-m-Y');
        $data['status'] = $request->status;
        DB::table('wbreviews')->insert($data);
        $notification = array('messege' => 'Thank you for review', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
