<form
    action="{{ route('file.update', $file->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="files">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $file->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" name=title id="title" value="{{ old('title', $file->title) }}">

                <div class="alert alert-danger alert-title d-none"></div>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
