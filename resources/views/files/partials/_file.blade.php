<tr id="item-{{ $file->id }}">
    <th class="col-md-9"> <i class="fas fa-file"></i> {{ $file->title }}</th>
    <th>
        <a href="{{ route('file.edit', $file->id) }}"
        class="btn btn-primary btn-sm active"
        role="bigModal"
        data-toggle="modal"
        data-target="#bigModal"
        data-table="files"
        data-attr="{{ route('file.edit', $file->id) }}"
        aria-pressed="true">Edit</a>

        <a type="button"
        data-toggle="modal"
        role="smallModal"
        data-target="#smallModal"
        data-attr="{{ route('file.delete', $file->id) }}"
        title="Delete File"
        class="btn btn-sm btn-danger">Delete</a>
    </th>
</tr>
