@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Coupon</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary btn-sm " data-toggle="modal" data-target="#addBrand">Add
                                Brand</button>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Coupon Code</th>
                                            <th>Coupon Amount</th>
                                            <th>Coupon Date</th>
                                            <th>Coupon Status</th>
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

    {{-- add category --}}
    <div class="modal fade" id="addBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('coupon.store') }}" method="post" id="add-form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand_name">Coupon Code</label>
                            <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code">
                        </div>
                        <div class="form-group">
                            <label for="brand_logo">Coupon Type</label>
                            <select name="type" class="form-control">
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Coupon Amount</label>
                            <input type="text" name="coupon_amount" class="form-control" placeholder="Coupon Amount">
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Valid Date</label>
                            <input type="date" name="valid_date" class="form-control" placeholder="Valid Date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <span class="d-none">Loading...</span> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit category --}}
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(function coupon() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('coupon.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'coupon_code',
                        name: 'coupon_code'
                    },
                    {
                        data: 'coupon_amount',
                        name: 'coupon_amount'
                    },
                    {
                        data: 'valid_date',
                        name: 'valid_date'
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
    </script>
    <script>
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            $.get('coupon/edit/' + id, function(data) {
                $('#modal_body').html(data);
            })
        })
    </script>
@endsection
