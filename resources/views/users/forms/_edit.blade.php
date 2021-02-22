<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-row align-items-center">
        <div class="col">

            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name', $user->name) }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name=email id="email" value="{{ old('email', $user->email) }}">

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name=password id="password" value="{{ old('password') }}">

                <small id="passwordHelp" class="form-text text-muted">If you leavel this field empty, user password will remain the same.</small>

                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">
            <button type="button"
                class="btn btn-primary btn-sm"
                id="generate-password">Generate Password</button>
        </div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
              <label for="role_id">Role</label>
              <select class="form-control" name="role_id" id="role_id">
                  @foreach ($roles as $role)
                      <option value="{{ $role->id }}"
                        @if (old('role_id', $user->role_id) === $role->id)
                            selected
                        @endif
                        >{{ $role->name }}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="col mx-4 align-middle">
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox"
                    class="form-check-input"
                    name="can_login"
                    id="can_login"
                    value="1"
                    @if (old('can_login', $user->can_login) == 1)
                        checked
                    @endif>
                User Can Login
              </label>
            </div>
        </div>

        <div class="col mx-4 align-middle">
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox"
                    class="form-check-input"
                    name="admin"
                    id="admin"
                    value="1"
                    @if (old('admin', $user->admin) == 1)
                        checked
                    @endif>
                Admin
              </label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
