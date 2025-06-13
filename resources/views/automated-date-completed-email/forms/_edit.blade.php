<form action="{{ route('automated-date-completed-email.update', $response->id) }}"
      method="POST"
      role="formAjax"
      id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="response">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $response->id }}">


    <div class="form-row align-items-center">

        <div class="col">

            <label for="emails">Contact Emails</label>
            <textarea class="form-control"
                      name="emails"
                      id="emails"
                      rows="3">{{ old("emails", implode(',', $response->emails )) }}</textarea>
            <small class="form-text text-muted">Add additional user emails which will send notification when the
                date completed is set on complaint update (use comma to separate multiple emails (test@test.com,
                second@test.com,
                another@test.com ...))</small>

        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
