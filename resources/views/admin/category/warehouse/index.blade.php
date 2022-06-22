@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Warehouse</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary btn-sm " data-toggle="modal" data-target="#addSubCategory">Add Warehouse</button>
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
                                            <th>Warehouse Name</th>
                                            <th>Warehouse Address</th>
                                            <th>Warehouse Phone</th>
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
    <div class="modal fade" id="addSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Warehouse </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('warehouse.store') }}" method="post" id="add-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Warehouse Name</label>
                            <input type="text" name="warehouse_name" class="form-control" placeholder="Warehouse Name">
                        </div>
                        <div class="form-group">
                            <label for="">Warehouse Address</label>
                            <input type="text" name="warehouse_address" class="form-control" placeholder="Warehouse Address">
                        </div>
                        <div class="form-group">
                            <label for="">Warehouse Phone</label>
                            <input type="text" name="warehouse_phone" class="form-control" placeholder="Warehouse Phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span class="d-none loader"><i class="fa fa-spinner"></i>Loading...</span><span class="submit-btn">Submit</span></button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
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
        $(function warehouse() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('warehouse.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'warehouse_name',
                        name: 'warehouse_name'
                    },
                    {
                        data: 'warehouse_address',
                        name: 'warehouse_address'
                    },
                    {
                        data: 'warehouse_phone',
                        name: 'warehouse_phone'
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
            $.get('warehouse/edit/'+id, function(data) {
               $('#modal_body').html(data);
            })
        })
    </script>
    <script>
        $('#add-form').on('submit', function() {
            $('loader').removeClass('d-none');
            $('submit-btn').addClass('d-none');
        })
    </script>
@endsection
