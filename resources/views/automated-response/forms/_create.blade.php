<form action="{{ route('automated-response.store') }}" method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="response">
    <input type="hidden" name="action" id=action value="create">
    <div class="form-group">
        <label for="name">Response Name</label>
        <input type="text" class="form-control"
            name=name id="name"
            value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

     <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
            <label for="response">Response</label>
            <textarea class="form-control" name="response" id="response" rows="5">{{ old('response') }}</textarea>
            </div>
        </div>

    </div>

    <div class="form-row align-items-center">
        <div class="col">
            <div class="form-group">
            <label>Escalation contacts</label>

            @foreach ($managers as $key => $value)
                <div class="custom-control custom-checkbox col">
                    <input type="checkbox"
                        class="custom-control-input"
                        id="additional_contact-{{ $key }}"
                        name="additional_contacts[]"
                        value="{{ $key }}">
                    <label class="custom-control-label" for="additional_contact-{{ $key }}">{{ $value }}</label>
                </div>
            @endforeach

            </div>
        </div>

        <div class="col">

            <label for="additional_emails">Additional emails</label>
            <textarea class="form-control"
            name="additional_emails"
            id="additional_emails"
            rows="3">{{ old("additional_emails") }}</textarea>
            <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>

        </div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
              <label for="level">Complaint Level</label>
              <select class="form-control" name="level" id="level">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="default" name="default" value=true>
                    <label class="custom-control-label" for="default">Default Response</label>
                </div>
            </div>
        </div>

    </div>

    <div class="scenario">

        <div class="form-row align-items-center">
            <div class="col-md-12">
            Scenario <hr>
            </div>

            <div class="col">
                <div class="form-group">
                <label for="category">Categories</label>
                <select multiple class="form-control" name="category[]" id="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                <label for="type">Types</label>
                <select multiple class="form-control" name="type[]" id="type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                <label for="channel">Channels</label>
                <select multiple class="form-control" name="channel[]" id="channel">
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>

        <div class="form-row align-items-center">

            <div class="col">
                <div class="form-group">
                <label for="severity">Severity</label>
                <select multiple class="form-control" name="severity[]" id="severity">
                    @foreach ($severities as $severity)
                        <option value="{{ $severity->id }}">{{ $severity->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>

        </div>



    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
