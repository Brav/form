<form action="{{ route('automated-email-contacts.update', $response->id) }}"
        method="POST"
        role="formAjax"
        id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="response">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $response->id }}">
    <div class="form-group">
        <label for="name">Scenario Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name', $response->name) }}">

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
            rows="3">{{ old("contacts", $response->contacts) }}</textarea>
            <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>

        </div>

    </div>
    <div class="form-row align-items-center scenario">

        <div class="col">
            <div class="form-group">
              <label for="category">Categories</label>
              <select multiple class="form-control" name="category[]" id="category">
                @foreach ($categories as $category)
                    <option
                        @if (in_array($category->id, $response->scenario['categories'] ?? []))
                            selected
                        @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
              <label for="type">Types</label>
              <select multiple class="form-control" name="type[]" id="type">
                @foreach ($types as $type)
                    <option
                    @if (in_array($type->id, $response->scenario['types'] ?? []))
                        selected
                    @endif
                    value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
            <label for="channel">Channels</label>
            <select multiple class="form-control" name="channel[]" id="channel">
                @foreach ($channels as $channel)
                    <option
                    @if (in_array($channel->id, $response->scenario['channels'] ?? []))
                        selected
                    @endif
                    value="{{ $channel->id }}">{{ $channel->name }}</option>
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
                    <option value="{{ $severity->id }}"
                        @if (in_array($severity->id, $response->scenario['severity'] ?? []))
                            selected
                        @endif
                        >{{ $severity->name }}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
            <label for="aggression">Aggression</label>
            <select multiple class="form-control" name="aggression[]" id="aggression">
                @foreach ($aggressions as $key => $value)
                    <option
                        @if (in_array($key, $response->scenario['aggression'] ?? []))
                            selected
                        @endif

                        value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
