<tr id="item-{{ $type->id }}">
        <th>{{ $type->id }}</th>
        <th>{{ $type->name }}</th>
        <th class="complaint-type-category-{{ $type->category->id }}">{{ $type->category->name }}</th>
        <th class="text-capitalize">{{  $type->severity ? $severities[$type->severity] : '/' }}</th>
        <th>
            <a href="{{ route('complaint-type.edit', $type->id) }}"
                class="btn btn-primary btn-sm active"
                role="bigModal"
                data-toggle="modal"
                data-target="#bigModal"
                data-table="complaint-types"
                data-attr="{{ route('complaint-type.edit', $type->id) }}"
                aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('complaint-type.delete', $type->id) }}"
                title="Delete Category">
                    <i class="fa fa-trash-o  fa-lg"></i> Delete
                </a>
        </th>
    </tr>
