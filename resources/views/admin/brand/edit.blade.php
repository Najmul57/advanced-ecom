<form action="{{ route('brand.update') }}" method="post" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" name="brand_name" class="form-control" value="{{ $brands->brand_name }}">
        </div>
        <input type="hidden" name="id" value="{{ $brands->id }}">
        <div class="form-group">
            <label for="brand_logo">Brand Logo</label>
            <input type="file" name="brand_logo" class="form-control dropify" data-height="200">
            {{-- <input type="hidden" name="old_logo" value="{{ $brands->brand_logo }}"> --}}
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>
