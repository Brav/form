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

                <div class="float-right">
                    <a href="{{ route('clinics.create') }}" class="btn btn-primary my-2">Create</a>
                </div>

                <table class="table table-hover" id=clinics>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Lead Vet</th>
                            <th scope="col">Practise Manager</th>
                            <th scope="col">Vet Manager</th>
                            <th scope="col">GM Veterinary Options</th>
                            <th scope="col">GM Region</th>
                            <th scope="col">Regional Manager</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=clinics-container>
                        @include('clinics/partials/_clinics')
                    </tbody>
                </table>

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
