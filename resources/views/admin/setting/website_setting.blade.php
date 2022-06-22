@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Website Setting</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Website Setting</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Your Website Setting</h3>
                            </div>
                            <form action="{{ route('website.setting.update',$data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Currency</label>
                                        <select name="currency" class="form-control">
                                            <option value="৳" {{ ($data->currency ==  '৳') ? 'selected': '' }}>Taka (৳)</option>
                                           <option value="$" {{ ($data->currency ==  '$') ? 'selected': '' }}>USD ($)</option>
                                           <option value="₹" {{ ($data->currency ==  '₹') ? 'selected': '' }}>Ruppe (₹)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone One</label>
                                        <input type="text" name="phone_one" value="{{ $data->phone_one }}" class="form-control" placeholder="Phone One">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone Two</label>
                                        <input type="text" name="phone_two" value="{{ $data->phone_two }}" class="form-control" placeholder="Phone Two">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mail Email</label>
                                        <input type="email" name="main_email" value="{{ $data->main_email }}" class="form-control" placeholder="Mail Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Support Email</label>
                                        <input type="email" name="support_email" value="{{ $data->support_email }}" class="form-control" placeholder="Support Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="{{ $data->address }}" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Facebook</label>
                                        <input type="text" name="facebook" value="{{ $data->facebook }}" class="form-control" placeholder="Facebook">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Twitter</label>
                                        <input type="text" name="twitter" value="{{ $data->twitter }}" class="form-control" placeholder="Twitter">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Instagram</label>
                                        <input type="text" name="instagram" value="{{ $data->instagram }}" class="form-control" placeholder="Instagram">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Linkedin</label>
                                        <input type="text" name="linkedin" value="{{ $data->linkedin }}" class="form-control" placeholder="Linkedin">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Youtube</label>
                                        <input type="text" name="youtube" value="{{ $data->youtube }}" class="form-control" placeholder="Youtube">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Logo</label>
                                        <input type="file" name="logo" value="{{ $data->logo }}" class="form-control">
                                        <input type="hidden" name="old_logo" value="{{ $data->logo }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Favicon</label>
                                        <input type="file" name="favicon" value="{{ $data->favicon }}" class="form-control" >
                                        <input type="hidden" name="old_favicon" value="{{ $data->favicon }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
