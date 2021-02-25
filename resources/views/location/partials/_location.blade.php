<tr id="item-{{ $location->id }}">
    <th>{{ $location->id }}</th>
    <th>{{ $location->name }}</th>
    <th>
        <a href="{{ route('location.edit', $location->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="location"
            data-attr="{{ route('location.edit', $location->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('location.delete', $location->id) }}"
            title="Delete Category">
                <i class="fas fa-trash text-danger  fa-lg"></i> Delete
            </a>
    </th>
</tr>
