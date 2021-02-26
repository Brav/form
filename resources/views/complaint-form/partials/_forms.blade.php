@foreach ($forms as $form)
    <tr id="item-{{ $form->id }}">
        <th scope="col">{{ date('d/m/Y g:i A', strtotime($form->created_at)) }}</th>
        <th scope="col">{{ $form->clinic->name }}</th>
        <th scope="col">{{ $form->clinic->regionalManager->name }}</th>
        <th scope="col">{{ $form->team_member }}</th>
        <th scope="col">{{ $form->team_member_position }}</th>
        <th scope="col">{{ $form->client_name }}</th>
        <th scope="col">{{ $form->patient_name }}</th>
        <th scope="col">{{ $form->pms_code }}</th>
        <th scope="col">{{ $form->date_of_incident->format('d/m/Y g:i A') }}</th>
        <th scope="col">{{ $form->date_of_client_complaint !== null ?
            date('d/m/Y', \strtotime($form->date_of_client_complaint)) : '/'}}</th>
        <th scope="col" class="text-break">{{ $form->description }}</th>
        <th scope="col">{{ $form->location->name }}</th>
        <th scope="col">{{ $form->category->name }}</th>
        <th scope="col">{{ $form->type->name ?? '/' }}</th>
        <th scope="col">{{ $form->channel->name ?? '/' }}</th>
        <th scope="col">{{ $form->complaintLevel() ?? '/' }}</th>
        @if ($canEdit)
            <th scope="col" class="text-break">{{ $form->outcome }}</th>
            <th scope="col">{{ $form->completed_by }}</th>
            <th scope="col">{{ $form->date_completed !== null ?
                date('d/m/Y', \strtotime($form->date_completed)) : '/'}}</th>
        @endif
        <th scope="col">

            @if ($canEdit)
                <a href="{{ route('complaint-form.edit', $form->id) }}"
                    class="btn btn-primary btn-sm active"
                    role="button" aria-pressed="true">Edit</a>
            @endif

            @if ($canDelete)
                <a data-toggle="modal"
                    class="btn btn-danger btn-sm"
                    role="smallModal"
                    data-target="#smallModal"
                    data-attr="{{ route('complaint-form.delete', $form->id) }}" title="Delete Form">
                        <i class="fa fa-trash-o  fa-lg"></i> Delete
                </a>
            @endif

        </th>
    </tr>
@endforeach
