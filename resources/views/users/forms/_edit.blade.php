<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-row align-items-center mb-3" style="max-width: 600px">
        <div class="col-12">

            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name', $user->name) }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-12">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name=email id="email" value="{{ old('email', $user->email) }}">

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-12">

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name=password id="password" value="{{ old('password') }}">

                <small id="passwordHelp" class="form-text text-muted">If you leavel this field empty, user password will remain the same.</small>

                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-12 mb-3">
            <button type="button"
                class="btn btn-primary btn-sm mt-2"
                id="generate-password">Generate Password</button>
        </div>


        <div class="col-12">
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
              <!-- <small id="ownerHelp" class="form-text text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, nulla corporis?</small> -->
            </div>
        </div>

        @if ($users !== null)
            <div class="col align-middle">
                <div class="form-group">
                  <label for="created_by">Owner of the user</label>
                  <select class="form-control select2" name="created_by" id="created_by" aria-describedby="ownerHelp">
                    <option value=none>None</option>
                    @foreach ($users as $userList)
                        <option value="{{ $userList->id }}"
                            @if ($user->created_by == old('created_by', $userList->id))
                                selected
                            @endif
                            >{{ $userList->name }}</option>
                    @endforeach
                  </select>
                  <!-- <small id="ownerHelp" class="form-text text-muted">This user will be able to edit user and assign him to the clinics</small> -->
                </div>
            </div>
        @endif

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

    <button type="submit" class="btn btn-primary mb-3">Update</button>
</form>
