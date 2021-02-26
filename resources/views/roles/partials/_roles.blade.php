@foreach ($roles as $role)
    <tr id="item-{{ $role->id }}">
        <th>{{ $role->id }}</th>
        <th>{{ $role->name }}</th>
        <th>{{ implode(', ', $role->level) }}</th>
        <th>{{ $role->permissions() }}</th>
        <th>
            <a href="{{ route('roles.edit', $role->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('roles.delete', $role->id) }}" title="Delete Role">
                    <i class="fa fa-trash-o  fa-lg"></i> Delete
                </a>
        </th>
    </tr>
@endforeach
