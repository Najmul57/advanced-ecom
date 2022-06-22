@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SMTP Setting</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">SMTP Setting</li>
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
                                <h3 class="card-title">Your SMTP Setting</h3>
                            </div>
                            <form action="{{ route('smtp.setting.update',$data->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Mail Mailer</label>
                                        <input type="text" name="mailer" value="{{ $data->mailer }}" class="form-control" placeholder="Mail Mailer">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mail Host</label>
                                        <input type="text" name="host" value="{{ $data->host }}" class="form-control" placeholder="Mail Host">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mail Port</label>
                                        <input type="text" name="port" value="{{ $data->port }}" class="form-control" placeholder="Mail Port">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mail Username</label>
                                        <input type="text" name="user_name" value="{{ $data->user_name }}" class="form-control" placeholder="Mail Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mail Password</label>
                                        <input type="text" name="password" value="{{ $data->password }}" class="form-control" placeholder="Mail Password">
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
