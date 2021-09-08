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
                    @foreach ($severities as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                </div>
            </div>

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

        </div>



    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
