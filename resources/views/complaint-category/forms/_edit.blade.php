<form
    action="{{ route('complaint-category.update', $category->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="complaint-category">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $category->id }}">

    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name', $category->name) }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form py-2">

        <h3 for="name">Channels Used</h3>

        @foreach ($channels as $item)
            <div class="form-check">
                <input class="form-check-input" name="channels[]" type="checkbox" value="{{ $item->id }}" id="channel-{{ $item->id }}"
                @if (in_array($item->id, $category->values_used['channels'] ?? []))
                    checked
                @endif>
                    <label class="form-check-label" id="channel-{{ $item->id }}">
                        {{ $item->name }}
                </label>
            </div>
        @endforeach

    </div>

    <div class="form py-2">

        <h3 for="name">Severities Used</h3>

        @foreach ($severities as $item)
            <div class="form-check">
                <input class="form-check-input" name="severities[]" type="checkbox" value="{{ $item->id }}" id="severities-{{ $item->id }}"
                @if (in_array($item->id, $category->values_used['severities'] ?? []))
                    checked
                @endif>
                    <label class="form-check-label" id="severities-{{ $item->id }}">
                        {{ $item->name }}
                </label>
            </div>
        @endforeach

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
