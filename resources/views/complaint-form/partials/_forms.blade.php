@foreach ($forms as $form)

    @php
        $dateOfClientComplaint = $form->date_of_client_complaint !== null ?
            date('d/m/Y', \strtotime($form->date_of_client_complaint)) : '/';

        $regionalManager =  $form->clinic->regionalManager ? $form->clinic->regionalManager->first()->user->name : '/';

        $typeName     = $form->type->name ?? '/';
        $channelName  = $form->channel->name ?? '/';
        $severityName = $form->severity->name ?? '/';

        $dateCompleted = $form->date_completed !== null ?
                date('d/m/Y', \strtotime($form->date_completed)) : '/';

        if ($export)
        {
            $dateOfClientComplaint = rtrim($dateOfClientComplaint, '/');
            $regionalManager       = rtrim($regionalManager, '/');
            $typeName              = rtrim($typeName, '/');
            $channelName           = rtrim($channelName, '/');
            $severityName          = rtrim($severityName, '/');
            $dateCompleted         = rtrim($dateCompleted, '/');
        }
    @endphp

    <tr id="item-{{ $form->id }}">
        @if (!$export && $canEdit)
            <th>
                <a href="{{ route('complaint-form.edit', $form->id) }}"
                    class="btn btn-primary btn-sm active"
                    role="button" aria-pressed="true">Edit</a>
            </th>
        @endif
        <th>{{ $form->created_at
            ->timezone('Australia/Sydney')
            ->format('d/m/Y g:i A') }}</th>
        <th>{{ $form->clinic->name }}</th>
        <th>{{ $regionalManager }}</th>
        <th>{{ $form->team_member }}</th>
        <th>{{ $form->team_member_position }}</th>
        <th>{{ $form->client_name }}</th>
        <th>{{ $form->patient_name }}</th>
        <th>{{ $form->pms_code }}</th>
        <th>{{ $form->date_of_incident->format('d/m/Y') }}</th>
        <th>{{ $dateOfClientComplaint }}</th>
        <th class="text-break">{{ $form->description }}</th>
        <th>{{ $form->location->name }}</th>
        <th>{{ $form->category->name }}</th>
        <th>{{ $typeName }}</th>
        <th>{{ $channelName }}</th>
        <th>{{ $form->level }}</th>
        <th class="text-capitalize">{{ $severityName }}</th>
        <th>
            @if ($form->files)
                @foreach ($form->files as $file)
                    @php
                        $fileInfo = explode('.', $file)
                    @endphp
                    @if (!$export)
                        <a  class="d-block mb-1"
                            href="{{ route('complaint-form.download', [
                            'form' => $form->id,
                            'file' => $file,
                            // 'extension' => end($fileInfo),
                        ]) }}">{{ $file }} <i class="fas fa-download"></i></a>
                    @else
                        <p>{{ $file }}</p>
                    @endif
                @endforeach
            @endif
        </th>
        @if ($canEdit)

            @foreach ($outcomeOptions as $option)
                <th>{{ $form->option($option->options) }}</th>
            @endforeach

            <th class="text-break">{{ $form->outcome }}</th>
            <th>{{ $form->completed_by }}</th>
            <th>{{ $dateCompleted }}</th>
        @endif
        @if (!$export)
            <th>
                @if (isset($canDelete) && $canDelete)
                    <a data-toggle="modal"
                        class="btn btn-danger btn-sm"
                        role="smallModal"
                        data-target="#smallModal"
                        data-attr="{{ route('complaint-form.delete', $form->id) }}" title="Delete Form">Delete</a>
                @endif

            </th>
        @endif

    </tr>
@endforeach
