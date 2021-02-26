<tr id="item-{{ $category->id }}">
        <th>{{ $category->id }}</th>
        <th>{{ $category->name }}</th>
        <th>
            <a href="{{ route('complaint-category.edit', $category->id) }}"
                class="btn btn-primary btn-sm active"
                role="bigModal"
                data-toggle="modal"
                data-target="#bigModal"
                data-table="complaint-types"
                data-attr="{{ route('complaint-category.edit', $category->id) }}"
                aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('complaint-category.delete', $category->id) }}"
                title="Delete Category">
                    <i class="fa fa-trash-o  fa-lg"></i> Delete
                </a>
        </th>
    </tr>
