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

    <div class="form-group">
        <div class="form-group">
          <label for="email_to_roles">Roles to receive emails</label>
          <select class="form-control"
            name="email_to_roles[]"
            id="email_to_roles"
            multiple>
            <option></option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div class="form-row align-items-center">
        <label for="additional_emails">Additional emails</label>
        <textarea class="form-control"
        name="additional_emails"
        id="additional_emails"
        rows="3">{{ old("additional_emails") }}</textarea>
        <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
