<form action="{{ route('warehouse.update',$data->id) }}" method="post" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="">Warehouse Name</label>
            <input type="text" name="warehouse_name" class="form-control" value="{{ $data->warehouse_name }}">
        </div>
        <div class="form-group">
            <label for="">Warehouse Address</label>
            <input type="text" name="warehouse_address" class="form-control" value="{{ $data->warehouse_address }}">
        </div>
        <div class="form-group">
            <label for="">Warehouse Phone</label>
            <input type="text" name="warehouse_phone" class="form-control" value="{{ $data->warehouse_phone }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none loader"><i class="fa fa-spinner"></i>Loading...</span><span class="submit-btn">Submit</span></button>
    </div>
</form>
