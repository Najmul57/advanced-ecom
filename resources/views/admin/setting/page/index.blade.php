@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Page</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('page.create') }}" class="btn btn-primary btn-sm ">Add Page</a>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Page Name</th>
                                            <th>Page Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->page_name }} </td>
                                                <td>{{ $row->page_title }} </td>
                                                <td>
                                                    <a href="{{ route('page.edit',$row->id) }}" class="btn btn-sm btn-primary edit"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ route('page.delete',$row->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- /.content-header -->
    </div>

@endsection
