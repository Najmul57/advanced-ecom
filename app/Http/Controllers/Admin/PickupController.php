<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('pickup_points')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="" class="btn btn-sm btn-primary edit"
                    data-id="' . $row->id . '" data-toggle="modal"
                    data-target="#editCategory"><i class="fa fa-edit"></i></a>
                <a href="' . route('pickup-point.delete', [$row->id]) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pickup_point.index');
    }
    public function store(Request $request)
    {
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;
        DB::table('pickup_points')->insert($data);
        $notification = array('messege' => 'Pickup Point Inserted', 'alert-type' => 'success');
        return redirect()->route('pickup-point.index')->with($notification);
    }

    public function edit($id)
    {
        // return $id;
        $data = DB::table('pickup_points')->where('id', $id)->first();
        return view('admin.pickup_point.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;
        DB::table('pickup_points')->where('id', $request->id)->update($data);
        $notification = array('messege' => 'Pickup Point Update', 'alert-type' => 'success');
        return redirect()->route('pickup-point.index')->with($notification);
    }
    public function destroy($id)
    {
        DB::table('pickup_points')->where('id', $id)->delete();
        $notification = array('messege' => 'Pickup Point Delete', 'alert-type' => 'success');
        return redirect()->route('pickup-point.index')->with($notification);
    }
}
