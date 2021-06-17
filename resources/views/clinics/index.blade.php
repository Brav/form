@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter" id=clinics>
                        <thead>
                            <tr>
                                <th class="small">ID</th>
                                <th class="small">Name</th>
                                <th class="small">Lead Vet</th>
                                <th class="small">Practice Manager</th>
                                <th class="small">Veterinary Manager</th>
                                <th class="small">GM Veterinary Options</th>
                                <th class="small">GM Region</th>
                                <th class="small">Regional Manager</th>
                                <th class="small">Actions</th>
                            </tr>
                            <tr id="clinic-filters"
                                class="filters"
                                data-url="{{ route('clinics.index') }}"
                                data-pagination="pagination"
                                data-container="clinics-container">
                                <th></th>
                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="Name"
                                        data-column="name"
                                        data-operator="like"
                                        data-type="text">
                                </th>

                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="Lead Vet"
                                        data-column="lead_vet"
                                        data-operator="like"
                                        data-type="text">
                                </th>

                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="Practice Manager"
                                        data-column="practice_manager"
                                        data-operator="like"
                                        data-type="text">
                                </th>

                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="Veterinary Manager"
                                        data-column="veterinary_manager"
                                        data-operator="like"
                                        data-type="text">
                                </th>

                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="GM Veterinary Operations"
                                        data-column="gm_veterinary_operations"
                                        data-operator="like"
                                        data-type="text">
                                </th>

                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="General Manager"
                                        data-column="general_manager"
                                        data-operator="like"
                                        data-type="text">
                                </th>

                                <th>
                                    <input
                                        type="text"
                                        class="form-control filter filter-text"
                                        placeholder="Regional Manager"
                                        data-column="regional_manager"
                                        data-operator="like"
                                        data-type="text">
                                </th>
                                <th>
                                    <button type="button" id="filter-reset"
                                    class="btn btn-primary active">Reset</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id=clinics-container>
                            @include('clinics/partials/_clinics')
                        </tbody>
                    </table>
                </div>

                <div id="pagination">
                    @include('pagination', [
                        'paginator' => $clinics,
                        'layout'    => 'vendor.pagination.bootstrap-4',
                        'role'      => 'clinics',
                        'container' => 'clinics-container',
                        'filter'    => 'clinic-filters',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
