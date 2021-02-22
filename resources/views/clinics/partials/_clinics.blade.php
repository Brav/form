@foreach ($clinics as $clinic)
    <tr id="item-{{ $clinic->id }}">
        <th>{{ $clinic->id }}</th>
        <th>{{ $clinic->name }}</th>
        <th>{{ $clinic->leadVet->name }}</th>
        <th>{{ $clinic->practiseManager->name }}</th>
        <th>{{ $clinic->vetManager->name }}</th>
        <th>{{ $clinic->gmVeterinaryOptions->name }}</th>
        <th>{{ $clinic->gmRegion->name }}</th>
        <th>{{ $clinic->regionalManager->name }}</th>
        <th>
            <a href="{{ route('clinics.edit', $clinic->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('clinics.delete', $clinic->id) }}" title="Delete Clinic">
                    <i class="fas fa-trash text-danger  fa-lg"></i> Delete
                </a>
        </th>
    </tr>
@endforeach
