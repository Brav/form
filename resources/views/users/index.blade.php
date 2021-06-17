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
                            <tr id="user-filters"
                                class="filters"
                                data-url="{{ route('users.index') }}"
                                data-pagination="pagination"
                                data-container="users-container">
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
                                        placeholder="Email"
                                        data-column="email"
                                        data-operator="like"
                                        data-type="text">
                                </th>
                                <th>
                                    <select class="form-control filter filter-select"
                                    name="role_id"
                                    id="role_id"
                                    data-column="role_id"
                                    data-type="select">
                                        <option value="all">All</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                    </select>
                                </th>
                                <th>
                                    <button type="button" id="filter-reset"
                                    class="btn btn-primary active">Reset</button>
                                </th>
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
                        'filter'    => 'user-filters',
                    ])
                </div>
        </div>
    </div>
@endsection
