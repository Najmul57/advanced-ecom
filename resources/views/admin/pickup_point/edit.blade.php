<form action="{{ route('pickup-point.update', $data->id) }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Pickup Point Name</label>
            <input type="text" name="pickup_point_name" class="form-control" value="{{ $data->pickup_point_name }}">
        </div>
        <div class="form-group">
            <label for="brand_name">Address</label>
            <input type="text" name="pickup_point_address" class="form-control"
                value="{{ $data->pickup_point_address }}">
        </div>
        <div class="form-group">
            <label for="brand_name">Phone</label>
            <input type="text" name="pickup_point_phone" class="form-control"
                value="{{ $data->pickup_point_phone }}">
        </div>
        <div class="form-group">
            <label for="brand_name">Another phone</label>
            <input type="text" name="pickup_point_phone_two" class="form-control"
                value="{{ $data->pickup_point_phone_two }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> <span class="d-none">Loading...</span> Submit</button>
    </div>
</form>
