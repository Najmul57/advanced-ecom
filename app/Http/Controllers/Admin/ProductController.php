<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Pickup_point;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl = 'files/products';

            $data = Product::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('thumbnail', function ($row) use ($imgurl) {
                    return '<img src="'.$imgurl .'/'.$row->thumbnail.'" width="50" height="50">';
                })
                ->editColumn('category_name', function ($row) {
                    return $row->category->category_name;
                })
                ->editColumn('subcategory_name', function ($row) {
                    return $row->subcategory->subcategory_name;
                })
                ->editColumn('brand_name', function ($row) {
                    return $row->brand->brand_name;
                })
                ->editColumn('featured', function ($row) {
                    if ($row->featured == 1) {
                        return '<a href="" data-id="' . $row->id . '" class="deactive_feature"> <i class="fas  fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active </span> </a>';
                    } else {
                        return '<a href="" data-id="' . $row->id . '" class="active_feature"> <i class="fas  fa-thumbs-up text-danger"></i> <span class="badge badge-danger">Deactive </span> </a>';
                    }
                })
                ->editColumn('today_deal', function ($row) {
                    if ($row->today_deal == 1) {
                        return '<a href="" data-id="' . $row->id . '" class="deactive_deal"> <i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active </span> </a>';
                    } else {
                        return '<a href="" data-id="' . $row->id . '" class="active_deal"> <i class="fas fa-thumbs-up text-danger"></i> <span class="badge badge-danger">Deactive </span> </a>';
                    }
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<a href="" data-id="' . $row->id . '" class="deactive_status"> <i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active </span> </a>';
                    } else {
                        return '<a href="" data-id="' . $row->id . '" class="active_status"> <i class="fas  fa-thumbs-up text-danger"></i> <span class="badge badge-danger">Deactive </span> </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="" class="btn btn-sm btn-success edit"><i class="fa fa-eye"></i></a>
                    <a href="' . route('product.edit', [$row->id]) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="' . route('product.delete', [$row->id]) . '"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'thumbnail', 'category_name', 'subcategory_name', 'brand_name', 'featured', 'today_deal', 'status'])
                ->make(true);
        }
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $warehouse=DB::table('warehouses')->get();
        return view('admin.product.index',compact('category','brand','warehouse'));
    }
    public function create()
    {
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();
        $pickup_point = DB::table('pickup_points')->get();
        return view('admin.product.create', compact('category', 'brand', 'warehouse', 'pickup_point'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);

        //subcategory call for category id
        $subcategory = DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        $slug = Str::slug($request->name, '-');


        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name, '-');
        $data['code'] = $request->code;
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['unit'] = $request->unit;
        $data['tags'] = $request->tags;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->description;
        $data['video'] = $request->video;
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['product_slider']=$request->product_slider;
        $data['status'] = $request->status;
        $data['trendy']=$request->trendy;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');
        //single thumbnail
        if ($request->thumbnail) {
            $thumbnail = $request->thumbnail;
            $photoname = $slug . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600, 600)->save('files/products/' . $photoname);
            $data['thumbnail'] = $photoname;   // public/files/product/plus-point.jpg
        }
        //multiple images
        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('files/products/' . $imageName);
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }
        DB::table('products')->insert($data);
        $notification = array('messege' => 'Product Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        $category = Category::all();
        $brand = Brand::all();
        $pickup_point = Pickup_point::all();
        $warehouse =Warehouse::all();
        return view('admin.product.edit',compact('product','category','brand','pickup_point','warehouse'));
    }

    public function destroy($id)
    {
        DB::table('products')->where('id',$id)->delete();
        $notification = array('messege' => 'Product Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function notFeatured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured' => 0]);
        return response()->json('Producted not Feeatured');
    }
    public function activeFeatured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured' => 1]);
        return response()->json('Producted Feeatured Actived');
    }
    public function notDeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal' => 0]);
        return response()->json('Producted not Feeatured');
    }
    public function activeDeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal' => 1]);
        return response()->json('Producted Feeatured Actived');
    }
    public function notstatus($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 0]);
        return response()->json('Producted not Feeatured');
    }
    public function activestatus($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 1]);
        return response()->json('Producted Feeatured Actived');
    }
}
