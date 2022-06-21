<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data=DB::table('categories')->get();
        return view('admin.category.category.index',compact('data'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required'
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        DB::table('categories')->insert($data);
        $notification=array('messege' => 'Category Inserted', 'alert-type' => 'success');
    	return redirect()->route('category.index')->with($notification);

    }
    public function edit($id)
    {
        $data = DB::table('categories')->where('id',$id)->first();
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required'
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        DB::table('categories')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Category Inserted', 'alert-type' => 'success');
    	return redirect()->route('category.index')->with($notification);
    }

    public function destroy($id)
    {
        // DB::table('categories')->where('id',$id)->delete();
        $category=Category::find($id);
        $category->delete();

        $notification=array('messege' => 'Category Deleted', 'alert-type' => 'success');
    	return redirect()->route('category.index')->with($notification);
    }
}
