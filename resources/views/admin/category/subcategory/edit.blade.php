<form action="{{ route('subcategory.update') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Categoroy Name</label>
            <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{ $subcategories->id }}">
        </div>
        <div class="form-group">
            <label for="category_name">Sub Categoroy Name</label>
            <input type="text" name="subcategory_name" class="form-control" value="{{ $subcategories->subcategory_name }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
