<table class="table table-bordered table-striped table-vcenter" id="forms">
    <thead class="thead-dark sticky-top">
    <tr class="bg-white">
        @if (!$export && $canEdit)
            <th scope="col">Edit</th>
        @endif
        <th scope="col" class="small text-nowrap">Date/Time Submitted</th>
        <th scope="col" class="small text-nowrap">Clinic Code</th>
        <th scope="col" class="small text-nowrap">Clinic Name</th>
        <th scope="col" class="small text-nowrap">Regional Manager</th>
        <th scope="col" class="small text-nowrap">General Manager</th>
        <th scope="col" class="small text-nowrap">Team member logging the complaint</th>
        <th scope="col" class="small text-nowrap">Email of Team Member</th>
        <th scope="col" class="small text-nowrap">Position of the team member</th>
        <th scope="col" class="small text-nowrap">Client/Owner name</th>
        <th scope="col" class="small text-nowrap">Patient name</th>
        <th scope="col" class="small text-nowrap" style="min-width: 100px">Species</th>
        <th scope="col" class="small text-nowrap">Patient number</th>
        <th scope="col" class="small text-nowrap">Date of the incident</th>
        <th scope="col" class="small text-nowrap">Date of client complaint (if applicable)</th>
        <th scope="col" class="small text-nowrap">Date you responded to the clien (if applicable)</th>
        <th scope="col" class="small text-nowrap"
            style="min-width: 550px"
        >Description of the incident and/or complaint
        </th>
        <th>Client Aggression</th>
        <th scope="col" class="small " style="max-width: 150px">Formal complaint lodged?</th>
        <th scope="col" class="small text-nowrap">Category</th>
        <th scope="col" class="small text-nowrap">Type of complaint</th>
        <th scope="col" class="small text-nowrap">Channel</th>
        <th scope="col" class="small text-nowrap">Complaint Level</th>
        <th scope="col" class="small text-nowrap">Severity</th>
        <th scope="col" class="small text-nowrap">Country</th>
        <th scope="col" class="small text-nowrap">Files/Documents</th>
        @if ($canEdit)
            @foreach ($outcomeOptions as $option)
                <th scope="col">{{ $option->name }}</th>
            @endforeach
            <th scope="col" class="small text-nowrap">Outcome of the incident and/or complaint</th>
            <th scope="col" class="small text-nowrap">Completed by</th>
            <th scope="col" class="small text-nowrap">Date completed</th>
        @endif
        @if (!$export)
            <th scope="col" class="small text-nowrap">Automated Response</th>
            <th scope="col" class="small text-nowrap">Actions</th>
        @endif
    </tr>
    @if (!$export)
        @include('complaint-form/partials/_filters')
    @endif
    </thead>
    <tbody id=forms-container>
    @include('complaint-form/partials/_forms')
    </tbody>
</table>

@if (!$export && $canEdit)
    @section('js_after')
        <script>
            $("#date_range").flatpickr({
                dateFormat: "d/m/Y",
                mode: "range",
                maxDate: "today",
            });

            $("#date_of_incident_filter").flatpickr({
                dateFormat: "d/m/Y",
                mode: "range",
                maxDate: "today",
            });

            $("#date_of_client_complaint_filter").flatpickr({
                dateFormat: "d/m/Y",
                mode: "range",
                maxDate: "today",
            });

            $("#date_to_respond_to_the_client_filter").flatpickr({
                dateFormat: "d/m/Y",
                mode: "range",
            });

            $("#date_completed_filter").flatpickr({
                dateFormat: "d/m/Y",
                mode: "range",
                maxDate: "today",
            });
        </script>
    @endsection
@endif
