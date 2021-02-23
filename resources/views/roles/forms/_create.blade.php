<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row align-items-center">
        <div class="col">
             <div class="form-group">
                <label for="level">Role Level (will receive notifications from this levels)</label>
                <select class="form-control" name=level[] id="level" multiple>
                    @foreach ($levels as $level)
                        <option value="{{ $level }}"
                            @if (in_array($level, old('level', [])))
                                selected
                            @endif
                        >{{ $level }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col mx-4 align-middle">
            <span>Permissions:</span>
            <div class="form-check form-check-inline my-2 mx-4">
                <input class="form-check-input"
                    type="checkbox"
                    name=read
                    id="read"
                    value="r"
                    @if (old('read') === 'r')
                        checked
                    @endif>
                <label class="form-check-label" for="read">Read</label>
            </div>

            <div class="form-check form-check-inline my-2 mx-4">
                <input class="form-check-input"
                    type="checkbox"
                    name=write
                    id="write"
                    value="w"
                    @if (old('delete') === 'w')
                        checked
                    @endif>
                <label class="form-check-label" for="write">Edit</label>
            </div>

            <div class="form-check form-check-inline my-2 mx-4">
                <input class="form-check-input"
                    type="checkbox"
                    name=delete
                    id="delete"
                    value="d"
                    @if (old('delete') === 'd')
                        checked
                    @endif>
                <label class="form-check-label" for="delete">Delete</label>
            </div>

        </div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
