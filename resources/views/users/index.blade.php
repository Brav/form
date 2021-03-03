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
                    <table class="table table-bordered table-striped table-vcenter" id=users>
                        <thead>
                            <tr>
                                <th class="small">ID</th>
                                <th class="small">Name</th>
                                <th class="small">Email</th>
                                <th class="small">Role</th>
                                <th class="small">Actions</th>
                            </tr>
                        </thead>
                        <tbody id=users-container>
                            @include('users/partials/_users')
                        </tbody>
                    </table>
                </div>

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
