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
@endsection
