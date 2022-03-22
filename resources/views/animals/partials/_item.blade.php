<tr id="item-{{$item->id }}">
    <th>{{$item->id }}</th>
    <th>{{$item->name }}</th>
    <th>
        <a href="{{ route('animals.edit',$item->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="animals"
            data-attr="{{ route('animals.edit',$item->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('animals.delete',$item->id) }}"
            title="Delete Category">
                <i class="fa fa-trash-o  fa-lg"></i> Delete
            </a>
    </th>
</tr>
