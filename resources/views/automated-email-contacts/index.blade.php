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
                <a href="{{ route('automated-email-contacts.create') }}"
                        role="bigModal"
                        data-toggle="modal"
                        data-target="#bigModal"
                        data-table="response"
                        data-attr="{{ route('automated-email-contacts.create') }}"
                        class="btn btn-primary my-2">Add Emails</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter" id=response>
                    <thead>
                        <tr>
                            <th class="small">ID</th>
                            <th class="small">Name</th>
                            <th class="small">Emails</th>
                            <th class="small">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=responses-container>
                        @include('automated-email-contacts/partials/_responses')
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

