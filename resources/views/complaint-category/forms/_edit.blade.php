<form
    action="{{ route('complaint-category.update', $category->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="complaint-category">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $category->id }}">

    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name', $category->name) }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
