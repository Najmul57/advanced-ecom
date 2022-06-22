@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Page</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Page Create</li>
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
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create a New Page</h3>
                            </div>
                            <form action="{{ route('page.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Page Position</label>
                                        <select name="page_position" class="form-control">
                                            <option value="1">Line One</option>
                                            <option value="2">Line Two</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Page Name</label>
                                        <input type="text" name="page_name" class="form-control"
                                            placeholder="Page Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Page Title</label>
                                        <input type="text" name="page_title"
                                            class="form-control"
                                            placeholder="Page Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Page Description</label>
                                        <textarea id="summernote" name="page_description"></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Page Create</button>
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
