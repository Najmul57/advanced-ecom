<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
                ->select('subcategories.*','categories.category_name')->get();
        $categories = Category::all();
        return view('admin.category.subcategory.index',compact('data','categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required'
        ]);

        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcategory_slug']=Str::slug($request->subcategory_name,'-');
        DB::table('subcategories')->insert($data);
        $notification=array('messege' => 'Sub Category Inserted', 'alert-type' => 'success');
    	return redirect()->route('subcategory.index')->with($notification);
    }
    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $subcategories = Subcategory::find($id);
        return view('admin.category.subcategory.edit',compact('categories','subcategories'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required'
        ]);

        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcategory_slug']=Str::slug($request->subcategory_name,'-');
        DB::table('subcategories')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Sub Category Updated', 'alert-type' => 'success');
    	return redirect()->route('subcategory.index')->with($notification);
    }
    public function destroy($id)
    {
        DB::table('subcategories')->where('id',$id)->delete();
        $notification=array('messege' => 'Sub Category Deleted', 'alert-type' => 'success');
    	return redirect()->route('subcategory.index')->with($notification);
    }
}
