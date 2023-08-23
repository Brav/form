<div class="form-group">
<label for="location_id">Location</label>
<select class="form-control no-keyboard" name="location_id" id="location_id">
    <option></option>
    @foreach ($locations as $location)
        <option value="{{ $location->id }}"
            @if (old('location_id') == $location->id)
                selected
            @endif
            >{{ $location->name }}</option>
    @endforeach
</select>

@error('location_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
</div>

<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
        <label for="location_id">Location</label>
        <select
            class="form-control"

            id="location_id"
            {{ $readonly }}
            @if ($readonly === 'readonly')
                disabled="disabled"
            @endif

            @if ($readonly !== 'readonly')
                name="location_id"
            @endif
            >
            <option></option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @if (old('location_id', $form->location_id) == $location->id)
                        selected
                    @endif
                    >{{ $location->name }}</option>
            @endforeach
        </select>

        @if ($readonly === 'readonly')
            <input type="hidden" name="location_id" value="{{ $form->location_id }}">
        @endif

        @error('location_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>
    </div>
</div>
