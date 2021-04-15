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
                <a href="{{ route('automated-response.create') }}"
                        role="bigModal"
                        data-toggle="modal"
                        data-target="#bigModal"
                        data-table="response"
                        data-attr="{{ route('automated-response.create') }}"
                        class="btn btn-primary my-2">Create Response</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter" id=response>
                    <thead>
                        <tr>
                            <th class="small">ID</th>
                            <th class="small">Name</th>
                            <th class="small">Response</th>
                            <th class="small">Scenario</th>
                            <th class="small">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=responses-container>
                        @include('automated-response/partials/_responses')
                    </tbody>
                </table>
            </div>

            <div id="pagination">
                @include('pagination', [
                    'paginator' => $responses,
                    'layout'    => 'vendor.pagination.bootstrap-4',
                    'role'      => 'responses',
                    'container' => 'responses-container',
                ])
            </div>
        </div>
    </div>
</div>

@endsection
