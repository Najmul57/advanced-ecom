@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pickup Point</h1>
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
                                            <th>Pickup Point Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Another Phone</th>
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
                <form action="{{ route('pickup-point.store') }}" method="post" id="add-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand_name">Pickup Point Name</label>
                            <input type="text" name="pickup_point_name" class="form-control"
                                placeholder="Pickup Point Name">
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Address</label>
                            <input type="text" name="pickup_point_address" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Phone</label>
                            <input type="text" name="pickup_point_phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Another phone</label>
                            <input type="text" name="pickup_point_phone_two" class="form-control"
                                placeholder="Another phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <span class="d-none">Loading...</span>
                            Submit</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
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
                ajax: "{{ route('pickup-point.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'pickup_point_name',
                        name: 'pickup_point_name'
                    },
                    {
                        data: 'pickup_point_address',
                        name: 'pickup_point_address'
                    },
                    {
                        data: 'pickup_point_phone',
                        name: 'pickup_point_phone'
                    },
                    {
                        data: 'pickup_point_phone_two',
                        name: 'pickup_point_phone_two'
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
            $.get('pickup-point/edit/' + id, function(data) {
                $('#modal_body').html(data);
            })
        })
    </script>
@endsection
