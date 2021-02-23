<form
    action="{{ route('complaint-category.store') }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="complaint-category">
    <input type="hidden" name="action" id=action value="create">
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
