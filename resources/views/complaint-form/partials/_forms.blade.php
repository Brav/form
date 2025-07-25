@foreach ($forms as $form)

    @php
        $dateOfClientComplaint = $form->date_of_client_complaint !== null ?
            date('d/m/Y', \strtotime($form->date_of_client_complaint)) : '/';

        $regionalManager = $form->clinic->getFirstManager('regional_manager')->name ?? '/';
        $generalManager  = $form->clinic->getFirstManager('general_manager')->name ?? '/';

        $typeName     = $form->type->name ?? '/';
        $channelName  = $form->channel->name ?? '/';
        $severityName = $form->severity->name ?? '/';
        $patientInjuryTypeName = $form->patientInjuryType->name ?? '/';

        $typeOther = null;

        if($typeName === 'Other' || $typeName === 'Others'){
            $typeOther = $form->other_type_of_complaint;
        }

        $dateCompleted = $form->date_completed !== null ?
                date('d/m/Y', \strtotime($form->date_completed)) : '/';

        $dateToRespondToTheClient = $form->date_to_respond_to_the_client !== null ?
                date('d/m/Y', \strtotime($form->date_to_respond_to_the_client)) : '/';

        if ($export)
        {
            $dateOfClientComplaint = rtrim($dateOfClientComplaint, '/');
            $regionalManager       = rtrim($regionalManager, '/');
            $typeName              = rtrim($typeName, '/');
            $channelName           = rtrim($channelName, '/');
            $severityName          = rtrim($severityName, '/');
            $dateCompleted         = rtrim($dateCompleted, '/');
            $patientInjuryTypeName         = rtrim($patientInjuryTypeName, '/');
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
        <th>{{ $form->clinic->code }}</th>
        <th>{{ $form->clinic->name }}</th>
        <th>{{ $regionalManager }}</th>
        <th>{{ $generalManager }}</th>
        <th>{{ $form->team_member }}</th>
        <th>{{ $form->team_member_email }}</th>
        <th>{{ $form->team_member_position }}</th>
        <th>{{ $form->client_name }}</th>
        <th>{{ $form->patient_name }}</th>
        <th>{{ $form->animal->name ?? 'Other' }}</th>
        <th>{{ $form->pms_code }}</th>
        <th>{{ $form->date_of_incident->format('d/m/Y') }}</th>
        <th>{{ $dateOfClientComplaint }}</th>
        <th>{{ $dateToRespondToTheClient }}</th>
        <th class="text-break">{{ $form->description }}</th>
        <th>{{ $form->aggression ?
                $aggressions[$form->aggression] : "None" }}</th>
        <th>{{ $form->formal_complaint_lodged ? 'Yes' : 'No' }}</th>
        <th>{{ $form->category->name }} @if($form->category->name === 'Near miss'):<br> {{$form->near_miss_description}} @endif</th>
        <th>{{ $typeName }}@if($typeOther): <br> {{ $typeOther }} @endif</th>
        <th>{{ $channelName }}</th>
        <th>{{ $form->level }}</th>
        <th class="text-capitalize">{{ $severityName }}</th>
        <th class="text-capitalize">{{ $patientInjuryTypeName }}</th>
        <th class="text-capitalize">{{ $form->clinic->country ?? 'N/A' }}</th>
        <th>
            @if ($form->files)
                @foreach ($form->files as $file)
                    @php
                        $fileInfo = explode('.', $file);
                        $route = route('complaint-form.download', [
                            'form' => $form->id,
                            'file' => $file,
                        ]);
                    @endphp
                    @if (!$export)
                        <a class="d-block mb-1"
                           href="{{ $route }}">{{ $file }} <i class="fas fa-download"></i></a>
                    @else
                        <p>{{ $route }}</p>
                    @endif
                @endforeach
            @endif
        </th>
        @if ($canEdit)

            @foreach ($outcomeOptions as $option)
                @php
                    $data = $form->option($option->options);

                    if($export)
                    {
                        $data = rtrim($data, '/');
                    }
                @endphp
                <th>{{  $data }}</th>
            @endforeach

            <th class="text-break">{{ $form->outcome }}</th>
            <th>{{ $form->completed_by }}</th>
            <th>{{ $dateCompleted }}</th>
        @endif
        @if (!$export)
            <th>{{ $form->automated_response  }}</th>
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
