<form
    action="{{ route('complaint-channel.store') }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="complaint-channel">
    <input type="hidden" name="action" id=action value="create">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Type Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="form-group">
              <label for="level">Complaint Level</label>
              <select class="form-control" name="level" id="level">
                  <option>None</option>
                  <option value=1
                    @if (old('level') === 1)
                        selected
                    @endif
                  >1</option>
                  <option value=2
                    @if (old('level') === 2)
                        selected
                    @endif
                  >2</option>
                  <option value=3
                    @if (old('level') === 3)
                        selected
                    @endif
                  >3</option>
              </select>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
