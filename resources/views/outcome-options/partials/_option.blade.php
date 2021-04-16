<tr id="item-{{ $option->id }}">
    <th>{{ $option->id }}</th>
    <th class="title">{{ $option->name }}</th>
    <th class="title">{{ $option->category->name }}</th>
    <th>
        <a href="{{ route('outcome-options.edit', $option->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="outcome-options"
            data-attr="{{ route('outcome-options.edit', $option->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('outcome-options.delete', $option->id) }}"
            title="Delete Category">
                <i class="fa fa-trash-o  fa-lg"></i> Delete
            </a>
    </th>
</tr>
