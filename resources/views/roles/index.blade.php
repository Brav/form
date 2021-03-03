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

                <div class="float-right">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary my-2">Create</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="small">ID</th>
                                <th class="small">Name</th>
                                <th class="small">Level for notifications</th>
                                <th class="small">Permissions</th>
                                <th class="small">Actions</th>
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
