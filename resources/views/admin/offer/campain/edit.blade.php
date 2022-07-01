<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<form action="{{ route('campaign.update',$campaign->id) }}" method="post" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand-name">Campaign Title <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="title" value="{{ $campaign->title }}">
            <small id="emailHelp" class="form-text text-muted">This is campaign title/name </small>
        </div>
        <input type="hidden" name="id" value="{{ $campaign->id }}">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="start-date">Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="start_date" value="{{ $campaign->start_date }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="End-date">End Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="end_date" value="{{ $campaign->end_date }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="start-date">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                        <option value="1" @if($campaign->status==1) selected="" @endif>Active</option>
                        <option value="0" @if($campaign->status==0) selected="" @endif>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="End-date">Discount (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="discount" value="{{ $campaign->discount }}">
                    <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for
                        all prodcut selling price</small>

                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="brand-name">Banner<span class="text-danger">*</span></label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="image"
                required="">
                <input type="hidden" name="old_image" value="{{ $campaign->image }}">
            <small id="emailHelp" class="form-text text-muted">This is your campaign banner </small>
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
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.get('campaign/edit/' + id, function(data) {
            $('#modal_body').html(data);
        })
    })
</script>
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
