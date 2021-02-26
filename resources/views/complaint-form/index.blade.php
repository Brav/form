@php
    $canEdit = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('w') ? true : false;

    $canDelete = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('d') ? true : false;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="float-right">
                    <a href="{{ route('complaint-form.create') }}" class="btn btn-primary my-2">Create</a>
                </div>

                <table class="table table-hover w-100" id="forms">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date/Time Submitet</th>
                            <th scope="col">Clinic Name</th>
                            <th scope="col">Regional Manager</th>
                            <th scope="col">Team member logging the complaint</th>
                            <th scope="col">Position of the team member</th>
                            <th scope="col">Client/Owner name</th>
                            <th scope="col">Patient name</th>
                            <th scope="col">PMS code</th>
                            <th scope="col">Date of the incident</th>
                            <th scope="col">Date of client complaint (if applicable)</th>
                            <th scope="col">Description of the incident and/or complaint</th>
                            <th scope="col">Location of the incident</th>
                            <th scope="col">Category</th>
                            <th scope="col">Type of complaint</th>
                            <th scope="col">Channel</th>
                            <th scope="col">Complaint Level</th>
                            @if ($canEdit)
                                <th scope="col">Outcome of the incident and/or complaint</th>
                                <th scope="col">Completed by</th>
                                <th scope="col">Date completed</th>
                            @endif
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=forms-container>
                        @include('complaint-form/partials/_forms')
                    </tbody>
                </table>

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
