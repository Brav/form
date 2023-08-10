<form action="{{ route('automated-country-emails.store') }}" method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="response">
    <input type="hidden" name="action" id=action value="create">
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" class="form-control text-capitalize"
            name=country id="country"
            value="{{ old('country') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row align-items-center">

    <div class="col">

        <label for="emails">Emails</label>
        <textarea class="form-control"
        name="emails"
        id="emails"
        rows="3">{{ old("emails") }}</textarea>
        <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>

    </div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
            <label for="body[client]">Clinet Text</label>
            <textarea class="form-control body"
                name="body[client]"
                id="body[client]" rows="5">{{ old('body[client]') }}</textarea>
            </div>
        </div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
            <label for="body[clinic]">Clinic Text</label>
            <textarea class="form-control body"
                name="body[clinic]"
                id="body[clinic]" rows="5">{{ old('body[clinic]') }}</textarea>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
