<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = DB::table('categories')->get();
        return view('admin.category.category.index', compact('data'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
            'icon' => 'required'
        ]);
        $slug = Str::slug($request->category_name, '-');

        $photo = $request->icon;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(32, 32)->save('files/category_icon/' . $photoname);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        $icon = $request->icon;
        $home_page=$request->home_page;
        $photoname = $slug . '.' . $icon->getClientOriginalExtension();
        Image::make($icon)->resize(200, 200)->save('files/category_icon/' . $photoname);
        $data['icon'] = 'files/category_icon/' . $photoname;
        // dd($data);
        // Category::insert([
        //     'category_name'=>$request->category_name,
        //     'category_slug'=>$slug,
        //     'home_page'=>$request->home_page,
        //     'icon'=>'files/category_icon/'.$photoname,
        // ]);

        DB::table('categories')->insert($data);
        $notification = array('messege' => 'Category Inserted', 'alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }
    public function edit($id)
    {
        $data=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.category.edit',compact('data'));
    }
    public function update(Request $request){
        $slug = Str::slug($request->category_name,'-');
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = $slug;
        $data['home_page']=$request->home_page;
        if ($request->icon) {
            if (File::exists($request->old_icon)) {
                unlink($request->old_icon);
            }
            $photo = $request->icon;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(32, 32)->save('files/category_icon/' . $photoname);
            $data['icon'] = 'files/category_icon/' . $photoname;
            DB::table('categories')->where('id',$request->id)->update($data);
            $notification = array('messege' => 'Categoriy Update', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        }else{
            $data['icon'] = $request->old_icon;
            DB::table('categories')->where('id',$request->id)->update($data);
            $notification = array('messege' => 'Categoriy Update', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        }
    }

    public function destroy($id)
    {
        // DB::table('categories')->where('id',$id)->delete();
        $category = Category::find($id);
        $category->delete();

        $notification = array('messege' => 'Category Deleted', 'alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }

    public function getChildCategory($id)
    {
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);
    }
}
