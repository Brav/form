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
                    <a href="{{ route('roles.create') }}" class="btn btn-primary my-2">Create</a>
                </div>

                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Level for notifications</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('roles/partials/_roles')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
