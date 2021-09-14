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
                        @if ((int) $type->complaint_category_id === (int) $category->id)
                            selected
                        @endif
                        >{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label class="d-block">Automated Email Sending</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="channel_settings_default" name="channel_settings_select" value="null"
                    @if ($type->complaint_channels_settings === null)
                        checked
                    @endif>
                    <label class="form-check-label" for="channel_settings_default">Use default channels settings</label>
                </div>

            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
