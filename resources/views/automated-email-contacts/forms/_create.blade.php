<form action="{{ route('automated-email-contacts.store') }}" method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="response">
    <input type="hidden" name="action" id=action value="create">
    <div class="form-group">
        <label for="name">Scenario Name</label>
        <input type="text" class="form-control"
            name=name id="name"
            value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row align-items-center">

    <div class="col">

        <label for="contacts">Contacts</label>
        <textarea class="form-control"
        name="contacts"
        id="contacts"
        rows="3">{{ old("contacts") }}</textarea>
        <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>

    </div>

    </div>

    <div class="form-row align-items-center">

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

        <div class="col">
            <div class="form-group">
            <label for="aggression">Aggression</label>
            <select multiple class="form-control" name="aggression[]" id="aggression">
                @foreach ($aggressions as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
