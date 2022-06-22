@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">OnPage SEO</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">OnPage SEO</li>
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
                                <h3 class="card-title">Your SEO Setting</h3>
                            </div>
                            <form action="{{ route('seo.setting.update',$data->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Meta Title</label>
                                        <input type="text" name="meta_title" value="{{ $data->meta_title }}" class="form-control" placeholder="Meta Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta Author</label>
                                        <input type="text" name="meta_author" value="{{ $data->meta_author }}" class="form-control" placeholder="Meta Author">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta Tag</label>
                                        <input type="text" name="meta_tag" value="{{ $data->meta_tag }}" class="form-control" placeholder="Meta Tag">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta Keyword</label>
                                        <input type="text" name="meta_keyword" value="{{ $data->meta_keyword }}" class="form-control" placeholder="Meta Keyword">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Google Vertification</label>
                                        <input type="text" name="google_verification" value="{{ $data->google_verification }}" class="form-control" placeholder="Google Vertification">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Google Analytics</label>
                                        <input type="text" name="google_analytics" value="{{ $data->google_analytics }}" class="form-control" placeholder="Google Analytics">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alexa Verification</label>
                                        <input type="text" name="alexa_verification" value="{{ $data->alexa_verification }}" class="form-control" placeholder="Alexa Verification">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Google Adsense</label>
                                        <input type="text" name="google_adsense" value="{{ $data->google_adsense }}" class="form-control" placeholder="Google Adsense">
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
