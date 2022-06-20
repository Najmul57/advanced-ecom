<form action="{{ route('childcategory.update') }}" method="post" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Categoroy/SubCategory Name</label>
            <select name="subcategory_id" class="form-control">
                <option value="" disabled>Select Item</option>
                @foreach ($categories as $row)
                @php
                    $subcategory = DB::table('subcategories')->where('category_id',$row->id)->get();
                @endphp
                <option value="" disabled>{{ $row->category_name }}</option>
                    @foreach ($subcategory as $row)
                    <option value="{{ $row->id }}" @if($row->id == $childcategories->subcategory_id) selected @endif>----{{ $row->subcategory_name }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <input type="hidden" name="id" value="{{ $childcategories->id }}">
        <div class="form-group">
            <label for="category_name">Child Categoroy Name</label>
            <input type="text" name="childcategory_name" class="form-control" value="{{ $childcategories->childcategory_name }}"     >
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
