@php
    $canEdit = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('w') ? true : false;

    $canDelete = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('d') ? true : false;
 @endphp
@foreach ($forms as $form)
    <tr id="item-{{ $form->id }}">
        <th>{{ date('d/m/Y g:i A', strtotime($form->created_at)) }}</th>
        <th>{{ $form->clinic->name }}</th>
        <th>{{ $form->clinic->regionalManager->name }}</th>
        <th>{{ $form->team_member }}</th>
        <th>{{ $form->team_member_position }}</th>
        <th>{{ $form->client_name }}</th>
        <th>{{ $form->patient_name }}</th>
        <th>{{ $form->pms_code }}</th>
        <th>{{ $form->date_of_incident->format('d/m/Y g:i A') }}</th>
        <th>{{ $form->date_of_client_complaint !== null ?
            date('d/m/Y', \strtotime($form->date_of_client_complaint)) : '/'}}</th>
        <th class="text-break">{{ $form->description }}</th>
        <th>{{ $form->location->name }}</th>
        <th>{{ $form->category->name }}</th>
        <th>{{ $form->type->name ?? '/' }}</th>
        <th>{{ $form->channel->name ?? '/' }}</th>
        <th>{{ $form->complaintLevel() ?? '/' }}</th>
        <th>

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
