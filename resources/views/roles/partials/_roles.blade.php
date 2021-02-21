@foreach ($roles as $role)
    <tr id="item-{{ $role->id }}">
        <th>{{ $role->id }}</th>
        <th>{{ $role->name }}</th>
        <th>{{ $role->level }}</th>
        <th>{{ $role->permissions() }}</th>
        <th>
            <a href="{{ route('roles.edit', $role->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>
        </th>
    </tr>
@endforeach
