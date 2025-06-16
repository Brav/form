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

                <a href="{{ route('patient-injury-type.create') }}"
                   role="bigModal"
                   data-toggle="modal"
                   data-target="#bigModal"
                   data-table="patient-injury-types"
                   data-attr="{{ route('patient-injury-type.create') }}"
                   class="btn btn-primary my-2">Create Patient Injury Type</a>

            <div class="tab-pane fade show" id="patient-injury-type" role="tabpanel" aria-labelledby="patient-injury-type">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter" id="patient-injury-type">
                        <thead>
                        <tr>
                            <th class="small">ID</th>
                            <th class="small">Name</th>
                            <th class="small">Actions</th>
                        </tr>
                        </thead>
                        <tbody id=types-container>
                        @include('patient-injury-types/partials/_container')
                        </tbody>
                    </table>
                </div>

                <div id="pagination-types">
                    @include('pagination', [
                        'paginator' => $types,
                        'layout'    => 'vendor.pagination.bootstrap-4',
                        'role'      => 'types',
                        'container' => 'types-container',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
