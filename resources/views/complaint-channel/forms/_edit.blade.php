<form
    action="{{ route('complaint-channel.update', $channel->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="complaint-channel">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $channel->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Type Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name', $channel->name) }}">

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
                    @if (old('level', $channel->level) === 1)
                        selected
                    @endif
                  >1</option>
                  <option value=2
                    @if (old('level', $channel->level) === 2)
                        selected
                    @endif
                  >2</option>
                  <option value=3
                    @if (old('level', $channel->level) === 3)
                        selected
                    @endif
                  >3</option>
              </select>
            </div>
        </div>

    </div>

    <div class="form-row align-items-center">
        <label for="additional_emails">Additional emails</label>
        <textarea class="form-control"
        name="additional_emails"
        id="additional_emails"
        rows="3">{{ old("additional_emails", $channel->additional_emails) }}</textarea>
        <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
