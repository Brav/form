@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block-content">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <a name="exportToExcel" id="exportToExcel" class="btn btn-primary"
                        href="{{ route('complaint-form.export') }}"
                        role="button"
                    <i class="fa fa-table" aria-hidden="true"></i>
                    Export</a>
                    <table class="table table-bordered table-striped table-vcenter" id="forms">
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
                                <th class="small">Severity</th>
                                <th class="small">Files/Documets</th>
                                @if ($canEdit)
                                    @foreach ($outcomeOptions as $option)
                                        <th>{{ $option->name }}</th>
                                    @endforeach
                                    <th class="small">Outcome of the incident and/or complaint</th>
                                    <th class="small">Completed by</th>
                                    <th class="small">Date completed</th>
                                @endif
                                <th class="small">Actions</th>
                            </tr>
                        </thead>
                        <tbody id=forms-container>
                            @include('complaint-form/partials/_forms')
                        </tbody>
                    </table>
                </div>

                <div id="pagination">
                    @include('pagination', [
                        'paginator' => $forms,
                        'layout'    => 'vendor.pagination.bootstrap-4',
                        'role'      => 'forms',
                        'container' => 'forms-container',
                    ])
                </div>

                <a name="exportToExcel" id="exportToExcel" class="btn btn-primary"
                        href="{{ route('complaint-form.export') }}"
                        role="button"
                    <i class="fa fa-table" aria-hidden="true"></i>
                    Export</a>

        </div>
    </div>
@endsection
