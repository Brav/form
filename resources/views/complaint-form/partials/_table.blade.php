<table class="table table-bordered table-striped table-vcenter" id="forms">
    <thead>
        <tr class="bg-white">
            @if ($export && $canEdit)
                <th>Edit</th>
            @endif
            <th class="small text-nowrap">Date/Time Submitted</th>
            <th class="small text-nowrap">Clinic Name</th>
            <th class="small text-nowrap">Regional Manager</th>
            <th class="small text-nowrap">Team member logging the complaint</th>
            <th class="small text-nowrap">Position of the team member</th>
            <th class="small text-nowrap">Client/Owner name</th>
            <th class="small text-nowrap">Patient name</th>
            <th class="small text-nowrap">PMS code</th>
            <th class="small text-nowrap">Date of the incident</th>
            <th class="small text-nowrap">Date of client complaint (if applicable)</th>
            <th class="small text-nowrap">Description of the incident and/or complaint</th>
            <th class="small text-nowrap">Location of the incident</th>
            <th class="small text-nowrap">Category</th>
            <th class="small text-nowrap">Type of complaint</th>
            <th class="small text-nowrap">Channel</th>
            <th class="small text-nowrap">Complaint Level</th>
            <th class="small text-nowrap">Severity</th>
            <th class="small text-nowrap">Files/Documets</th>
            @if ($canEdit)
                @foreach ($outcomeOptions as $option)
                    <th>{{ $option->name }}</th>
                @endforeach
                <th class="small text-nowrap">Outcome of the incident and/or complaint</th>
                <th class="small text-nowrap">Completed by</th>
                <th class="small text-nowrap">Date completed</th>
            @endif
            @if ($export)
                <th class="small text-nowrap">Actions</th>
            @endif
        </tr>
    </thead>
    <tbody id=forms-container>
        @include('complaint-form/partials/_forms')
    </tbody>
</table>
