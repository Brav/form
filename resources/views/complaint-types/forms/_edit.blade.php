<form
    action="{{ route('complaint-type.update', $type->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="complaint-types">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $type->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Type Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name', $type->name) }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="form-group">
              <label for="complaint_category_id">Complaint Category</label>
              <select class="form-control" name="complaint_category_id" id="complaint_category_id">
                  @foreach ($categories as $category)
                      <option
                        value="{{ $category->id }}"
                        @if ($type->complaint_category_id === $category->id)
                            selected
                        @endif
                        >{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
              <label for="level">Complaint Level</label>
              <select class="form-control" name="level" id="level">
                  <option>None</option>
                  <option value=1
                    @if ($type->level === 1)
                        selected
                    @endif
                  >1</option>
                  <option value=2
                    @if ($type->level === 2)
                        selected
                    @endif
                  >2</option>
                  <option value=3
                    @if ($type->level === 3)
                        selected
                    @endif
                  >3</option>
              </select>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
