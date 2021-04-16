<form
    action="{{ route('outcome-options-categories.update', $category->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="outcome-options-categories-table">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $category->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Outcome Option Category Name</label>
                <input type="text" class="form-control" name=name id="name"
                value="{{ old('name', $category->name) }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
