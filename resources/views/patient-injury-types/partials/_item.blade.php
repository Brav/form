<tr id="item-{{$item->id }}">
    <th>{{$item->id }}</th>
    <th>{{$item->name }}</th>
    <th>
        <a href="{{ route('patient-injury-type.edit',$item->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="patient-injury-type"
            data-attr="{{ route('patient-injury-type.edit',$item->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('patient-injury-type.delete',$item->id) }}"
            title="Delete Patient Injury Type">
                <i class="fa fa-trash-o  fa-lg"></i> Delete
            </a>
    </th>
</tr>
