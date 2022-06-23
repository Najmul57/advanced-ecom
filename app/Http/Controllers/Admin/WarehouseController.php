<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('warehouses')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="" class="btn btn-sm btn-primary edit"
                    data-id="' . $row->id . '" data-toggle="modal"
                    data-target="#editCategory"><i class="fa fa-edit"></i></a>
                <a href="' . route('warehouse.delete', [$row->id]) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.warehouse.index');
    }
    public function store(Request $request)
    {
        $dataa = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;

        DB::table('warehouses')->insert($data);
        $notification = array('messege' => 'Warehouse Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $data = DB::table('warehouses')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;
        DB::table('warehouses')->where('id', $request->id)->update($data);
        $notification = array('messege' => 'Warehouse Update', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id)
    {
        DB::table('warehouses')->where('id', $id)->delete();
        $notification = array('messege' => 'Warehouse Deleted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
