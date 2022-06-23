<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('coupons')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="" class="btn btn-sm btn-primary edit"
                    data-id="' . $row->id . '" data-toggle="modal"
                    data-target="#editCategory"><i class="fa fa-edit"></i></a>
                <a href="'.route('coupon.delete', [$row->id]).'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.offer.coupon.index');
    }
    public function store(Request $request)
    {
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['type'] = $request->type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['valid_date'] = $request->valid_date;

        DB::table('coupons')->insert($data);
        $notification = array('messege' => 'Coupon Inserted', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }
    public function edit($id)
    {
        $data=DB::table('coupons')->where('id',$id)->first();
        return view('admin.offer.coupon.edit',compact('data'));
    }
    public function update(Request $request)
    {

        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['type'] = $request->type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['valid_date'] = $request->valid_date;

        DB::table('coupons')->where('id',$request->id)->update($data);
        $notification = array('messege' => 'Coupon Update', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }
    public function destroy($id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        $notification = array('messege' => 'Coupon Deleted', 'alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }
}
