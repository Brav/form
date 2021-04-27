@php
    $canEdit = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('w') ? true : false;
@endphp
<table>
    <thead>
            <tr>
                <th class="small">Date/Time Submitted</th>
                <th class="small">Clinic Name</th>
                <th class="small">Regional Manager</th>
                <th class="small">Team member logging the complaint</th>
                <th class="small">Position of the team member</th>
                <th class="small">Client/Owner name</th>
                <th class="small">Patient name</th>
                <th class="small">PMS code</th>
                <th class="small">Date of the incident</th>
                <th class="small">Date of client complaint (if applicable)</th>
                <th class="small">Description of the incident and/or complaint</th>
                <th class="small">Location of the incident</th>
                <th class="small">Category</th>
                <th class="small">Type of complaint</th>
                <th class="small">Channel</th>
                <th class="small">Complaint Level</th>
                <th class="small text-nowrap">Severity</th>
                <th class="small text-nowrap">Files/Documets</th>
                @if ($canEdit)
                    @foreach ($outcomeOptions as $option)
                        <th>{{ $option->name }}</th>
                    @endforeach
                    <th class="small">Outcome of the incident and/or complaint</th>
                    <th class="small">Completed by</th>
                    <th class="small">Date completed</th>
                @endif
            </tr>
        </thead>
    <tbody>
    @foreach ($forms as $form)
            <tr>
                <th>{{ date('d/m/Y g:i A', strtotime($form->created_at)) }}</th>
                <th>{{ $form->clinic->name }}</th>
                <th>{{ $form->clinic->regionalManager }}</th>
                <th>{{ $form->team_member }}</th>
                <th>{{ $form->team_member_position }}</th>
                <th>{{ $form->client_name }}</th>
                <th>{{ $form->patient_name }}</th>
                <th>{{ $form->pms_code }}</th>
                <th>{{ $form->date_of_incident->format('d/m/Y') }}</th>
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
                                {{ route('complaint-form.download', [
                                        'form'      => $form->id,
                                        'file'      => $fileInfo[0],
                                        'extension' => $fileInfo[1],
                                    ])
                                }}<br/>
                        @endforeach
                    @endif
                </th>
                @if ($canEdit)

                    @foreach ($outcomeOptions as $option)
                        <th>{{ $form->option($option->options) }}</th>
                    @endforeach

                    <th class="text-break">{{ $form->outcome }}</th>
                    <th>{{ $form->completed_by }}</th>
                    <th>{{ $form->date_completed !== null ?
                        date('d/m/Y', \strtotime($form->date_completed)) : '/'}}</th>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
