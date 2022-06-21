<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('childcategories')
                ->leftJoin('categories', 'childcategories.category_id', 'categories.id')
                ->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')
                ->select('categories.category_name', 'subcategories.subcategory_name', 'childcategories.*')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn =' <a href="" class="btn btn-sm btn-primary edit"
                    data-id="'.$row->id.'" data-toggle="modal"
                    data-target="#editCategory"><i class="fa fa-edit"></i></a>
                <a href="'.route('childcategory.delete',[$row->id]).'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $categories = Category::all();
        $subcategories = DB::table('subcategories')->get();
        return view('admin.category.childcategory.index',compact('categories','subcategories'));
    }
    public function store(Request $request)
    {
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name']=$request->childcategory_name;
        $data['childcategory_slug']=Str::slug($request->childcategory_name,'-');
        DB::table('childcategories')->insert($data);
        $notification=array('messege' => 'ChildCategory Inserted', 'alert-type' => 'success');
    	return redirect()->route('childcategory.index')->with($notification);
    }
    public function edit($id)
    {
        $categories = Category::all();
        $childcategories = DB::table('childcategories')->where('id',$id)->first();
        return view('admin.category.childcategory.edit',compact('categories','childcategories'));
    }
    public function update(Request $request)
    {
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name']=$request->childcategory_name;
        $data['childcategory_slug']=Str::slug($request->childcategory_name,'-');
        DB::table('childcategories')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'ChildCategory Update', 'alert-type' => 'success');
    	return redirect()->route('childcategory.index')->with($notification);
    }
    public function destroy($id)
    {
        DB::table('childcategories')->where('id',$id)->delete();
        $notification=array('messege' => 'ChildCategory Delete', 'alert-type' => 'success');
    	return redirect()->route('childcategory.index')->with($notification);
    }
}
