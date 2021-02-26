@foreach ($users as $user)
    <tr id="item-{{ $user->id }}">
        <th>{{ $user->id }}</th>
        <th>{{ $user->name }}</th>
        <th>{{ $user->email }}</th>
        <th>{{ optional($user->role)->name }}</th>
        <th>
            <a href="{{ route('users.edit', $user->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>

            @if (auth()->id() !== $user->id)
                <a data-toggle="modal"
                    class="btn btn-danger btn-sm"
                    role="smallModal"
                    data-target="#smallModal"
                    data-attr="{{ route('users.delete', $user->id) }}" title="Delete User">
                        <i class="fa fa-trash-o  fa-lg"></i> Delete
                </a>
            @endif

        </th>
    </tr>
@endforeach
