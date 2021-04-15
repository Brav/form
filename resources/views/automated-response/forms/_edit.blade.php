<form action="{{ route('automated-response.update', $response->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Response Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name', $response->name) }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

     <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
            <label for="response">Response</label>
            <textarea class="form-control" name="response" id="response" rows="5">{{ old('response', $response->response) }}</textarea>
            </div>
        </div>

    </div>

    Scenario <hr>

    <div class="form-row align-items-center">

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

    <button type="submit" class="btn btn-primary">Update</button>
</form>
