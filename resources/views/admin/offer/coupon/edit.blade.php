<form action="{{ route('coupon.update',$data->id) }}" method="post" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Coupon Code</label>
            <input type="text" name="coupon_code" class="form-control" value="{{ $data->coupon_code }}">
        </div>
        <div class="form-group">
            <label for="brand_logo">Coupon Type</label>
            <select name="type" class="form-control">
                <option value="1" @if($data->type==1) selected @endif>Fixed</option>
                <option value="2" @if($data->type==2) selected @endif>Percentage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="brand_name">Coupon Amount</label>
            <input type="text" name="coupon_amount" class="form-control" value="{{ $data->coupon_amount }}">
        </div>
        <div class="form-group">
            <label for="brand_name">Valid Date</label>
            <input type="date" name="valid_date" class="form-control" value="{{ $data->valid_date }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> <span class="d-none">Loading...</span> Submit</button>
    </div>
</form>
