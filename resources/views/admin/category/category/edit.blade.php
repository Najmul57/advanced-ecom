<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Categoroy Name</label>
            <input type="text" name="category_name" class="form-control" id="category_name"
                value="{{ $data->category_name }}">
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="category_name">Categoroy Icon</label>
            <input type="file" name="icon" class="dropify" id="icon" value="{{ $data->icon }}">
            <input type="hidden" name="old_icon" value="{{ $data->icon }}">
        </div>
        <div class="form-group">
            <label for="category_name">Show on Homepage</label>
            <select name="homepage" class="form-control">
                <option value="1" @if ($data->home_page == 1) selected @endif>Yes</option>
                <option value="0" @if ($data->home_page == 0) selected @endif>No</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script>
    $('.dropify').dropify({});
</script>
