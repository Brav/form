@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block-content">

                @if (session('status'))
                    <div class="card-body">
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    </div>
                @endif

                <a name="exportToExcel" id="exportToExcel" class="btn btn-primary mb-3"
                    href="{{ route('complaint-form.export') }}"
                    role="button">
                <i class="fa fa-table" aria-hidden="true"></i>
                Export</a>

                <div class="main-wrapper" style="overflow-x: scroll;height: 20px; display: block;">
                    <div class="wrapper1" style="min-height: 20px"></div>
                </div>
                <div class="table-responsive" style="height: 100vh" id="main-table">
                    @include('complaint-form/partials/_table')
                </div>

                <div id="pagination">
                    @include('pagination', [
                        'paginator' => $forms,
                        'layout'    => 'vendor.pagination.bootstrap-4',
                        'role'      => 'forms',
                        'container' => 'forms-container',
                        'filter'    => 'forms-filters',
                    ])
                </div>

                <a name="exportToExcel" id="exportToExcel" class="btn btn-primary mt-3"
                        href="{{ route('complaint-form.export') }}"
                        role="button">
                    <i class="fa fa-table" aria-hidden="true"></i>
                    Export</a>

        </div>
    </div>

@endsection
