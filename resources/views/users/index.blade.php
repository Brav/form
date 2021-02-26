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
                    <a href="{{ route('users.create') }}" class="btn btn-primary my-2">Create</a>
                </div>

                <table class="table table-hover" id=users>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=users-container>
                        @include('users/partials/_users')
                    </tbody>
                </table>

                <div id="pagination">
                    @include('pagination', [
                        'paginator' => $users,
                        'layout'    => 'vendor.pagination.bootstrap-4',
                        'role'      => 'users',
                        'container' => 'users-container',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
