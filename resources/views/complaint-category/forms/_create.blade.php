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

    <div class="form py-2">
        <div class="row"></div>
        <h3 for="name">Channels Used</h3>

        @foreach ($channels as $item)
            <div class="form-check">
                <input class="form-check-input" name="channels[]" type="checkbox" value="{{ $item->id }}" id="channel-{{ $item->id }}" checked>
                    <label class="form-check-label" id="channel-{{ $item->id }}">
                        {{ $item->name }}
                </label>
            </div>
        @endforeach

    </div>


        <h3 for="name">Severities Used</h3>

        @foreach ($severities as $item)
            <div class="form-check">
                <input class="form-check-input" name="severities[]" type="checkbox" value="{{ $item->id }}" id="severities-{{ $item->id }}" checked>
                    <label class="form-check-label" id="severities-{{ $item->id }}">
                        {{ $item->name }}
                </label>
            </div>
        @endforeach

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
