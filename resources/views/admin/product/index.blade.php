@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm ">Add Product</a>
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
                                <h3 class="card-title">All Product List</h3>
                            </div>
                            <div class="row p-2">
                                <div class="form-group col-3">
                                    <label for="">Category</label>
                                    <select name="category_id" id="category_id" class="form-control submitable">
                                        <option value="">All</option>
                                        @foreach ($category as $row)
                                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control submitable">
                                        <option value="">All</option>
                                        @foreach ($brand as $row)
                                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Warehouse</label>
                                    <select name="warehouse" id="warehouse" class="form-control submitable">
                                        <option value="">All</option>
                                        @foreach ($warehouse as $row)
                                            <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control submitable">
                                        <option value="">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Brand</th>
                                            <th>Featured</th>
                                            <th>Today Deal</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(function product() {
            var table = $('.ytable').DataTable({
                'processing': true,
                'serverSide': true,
                'searching':true,
                'ajax':{
                    'url': "{{ route('product.index') }}",
                    'data':function(e){
                        e.category_id=$('#category_id').val();
                        e.brand_id=$('#brand_id').val();
                        e.status=$('#status').val();
                        e.warehouse_id=$('#warehouse_id').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name'
                    },
                    {
                        data: 'featured',
                        name: 'featured'
                    },
                    {
                        data: 'today_deal',
                        name: 'today_deal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            })
        })
        // deactive featured
        $('body').on('click', '.deactive_feature', function() {
            let id = $(this).data('id');
            var url = "{{ url('product/not-featured') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            })
        });
        // active featured
        $('body').on('click', '.active_feature', function() {
            let id = $(this).data('id');
            var url = "{{ url('product/active-featured') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            })
        });
        // deactive deal
        $('body').on('click', '.deactive_deal', function() {
            let id = $(this).data('id');
            var url = "{{ url('product/not-deal') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            })
        });
        // active deal
        $('body').on('click', '.active_deal', function() {
            let id = $(this).data('id');
            var url = "{{ url('product/active-deal') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            })
        });
        // active status
        $('body').on('click', '.deactive_status', function() {
            let id = $(this).data('id');
            var url = "{{ url('product/not-status') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            })
        });
        // active status
        $('body').on('click', '.active_status', function() {
            let id = $(this).data('id');
            var url = "{{ url('product/active-status') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            })
        });
        $(document).on('change','.submitable',function(){
            $('.ytable').DataTable().ajax.reload();
        })
    </script>
@endsection
