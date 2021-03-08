@php
    $canEdit = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('w') ? true : false;

    $canDelete = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('d') ? true : false;
@endphp
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
                                @if ($canEdit)
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

        </div>
    </div>
@endsection
