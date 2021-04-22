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
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
