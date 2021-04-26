@php
    $outcomeOptionsCount = $outcomeOptions->count();
@endphp
@foreach ($forms as $form)

    <tr id="item-{{ $form->id }}">
        <th>{{ date('d/m/Y g:i A', strtotime($form->created_at)) }}</th>
        <th>{{ $form->clinic->name }}</th>
        <th>{{ $form->clinic->regionalManager ? $form->clinic->regionalManager->first()->user->name : '/'}}</th>
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
        <th class="text-capitalize">{{ $severities[$form->severity] ?? '/' }}</th>
        <th>
            @if ($form->files)
                @foreach ($form->files as $file)
                    @php
                        $fileInfo = explode('.', $file)
                    @endphp
                    <a  class="d-block mb-1"
                        href="{{ route('complaint-form.download', [
                        'form'      => $form->id,
                        'file'      => $fileInfo[0],
                        'extension' => $fileInfo[1],
                    ]) }}">{{ $file }} <i class="fas fa-download"></i></a>
                @endforeach
            @endif
        </th>
        @if ($canEdit)

            @foreach ($outcomeOptions as $option)
                <th>{{ $form->option($outcomeOptions, $option) }}</th>
            @endforeach

            <th class="text-break">{{ $form->outcome }}</th>
            <th>{{ $form->completed_by }}</th>
            <th>{{ $form->date_completed !== null ?
                date('d/m/Y', \strtotime($form->date_completed)) : '/'}}</th>
        @endif
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
