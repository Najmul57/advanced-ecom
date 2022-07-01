<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use File;
use Intervention\Image\Facades\Image;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('campaigns')->orderBy('id', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<a href=""><span class="badge badge-success">Active </span> </a>';
                    } else {
                        return '<a href=""><span class="badge badge-danger">Inactive </span> </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="" class="btn btn-sm btn-primary edit"
                    data-id="' . $row->id . '" data-toggle="modal"
                    data-target="#editCategory"><i class="fa fa-edit"></i></a>
                <a href="' . route('campaign.delete', [$row->id]) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.offer.campain.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);
        $slug = Str::slug($request->title, '-');

        $data = array();
        $data['title'] = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;
        $data['month'] = date('F');
        $data['year'] = date('Y');

        $photo = $request->image;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(468, 90)->save('files/campaign/' . $photoname);

        $data['image'] = 'files/campaign/' . $photoname;

        DB::table('campaigns')->insert($data);
        $notification = array('messege' => 'Campaign Inserted', 'alert-type' => 'success');
        return redirect()->route('campaign.index')->with($notification);
    }
    public function edit($id)
    {
       $campaign = DB::table('campaigns')->where('id',$id)->first();
        return view('admin.offer.campain.edit',compact('campaign'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);
        $slug = Str::slug($request->title, '-');

        $data = array();
        $data['title'] = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;
        $data['month'] = date('F');
        $data['year'] = date('Y');

        if ($request->image) {
            if (File::exists($request->old_image)) {
                unlink($request->old_image);
            }
            $photo = $request->image;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(468, 90)->save('files/campaign/' . $photoname);
            $data['image'] = 'files/campaign/' . $photoname;
            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification = array('messege' => 'Campaign Inserted', 'alert-type' => 'success');
            return redirect()->route('campaign.index')->with($notification);
        }else{
            $data['image'] = $request->old_image;
            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification = array('messege' => 'Campaign Update', 'alert-type' => 'success');
            return redirect()->route('campaign.index')->with($notification);
        }

    }
    public function destroy($id)
    {
        $data = DB::table('campaigns')->where('id', $id)->first();
        $image = $data->image;

        if (File::exists($image)) {
            unlink($image);
        }

        DB::table('campaigns')->where('id', $id)->delete();
        $notification = array('messege' => 'Campaign Deleted', 'alert-type' => 'success');
        return redirect()->route('campaign.index')->with($notification);
    }
}
