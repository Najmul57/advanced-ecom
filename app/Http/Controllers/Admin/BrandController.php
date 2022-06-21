<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use File;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brands')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="" class="btn btn-sm btn-primary edit"
                    data-id="' . $row->id . '" data-toggle="modal"
                    data-target="#editCategory"><i class="fa fa-edit"></i></a>
                <a href="' . route('brand.delete', [$row->id]) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.brand.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required'
        ]);
        $slug = Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        $photo = $request->brand_logo;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(200, 200)->save('files/brands/' . $photoname);

        $data['brand_logo'] = 'files/brands/' . $photoname;

        DB::table('brands')->insert($data);
        $notification = array('messege' => 'Brand Inserted', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
    public function edit($id)
    {
        $brands = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.brand.edit', compact('brands'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required'
        ]);
        $slug = Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');

        if ($request->brand_logo) {
            if (File::exists($request->old_logo)) {
                unlink($request->old_logo);
            }
            $photo = $request->brand_logo;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(200, 200)->save('files/brands/' . $photoname);
            $data['brand_logo'] = 'files/brands/' . $photoname;
            DB::table('brands')->where('id',$request->id)->update($data);
            $notification = array('messege' => 'Brand Inserted', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }else{
            $data['brand_logo'] = $request->old_logo;
            DB::table('brands')->where('id',$request->id)->update($data);
            $notification = array('messege' => 'Brand Update', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }

    }
    public function destroy($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;

        if (File::exists($image)) {
            unlink($image);
        }

        DB::table('brands')->where('id', $id)->delete();
        $notification = array('messege' => 'Brand Deleted', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
}
