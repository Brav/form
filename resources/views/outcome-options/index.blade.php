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

                <div class="row col-md-12">
                    <div class="float-right">
                        <a href="{{ route('outcome-options.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="outcome-options"
                            data-attr="{{ route('outcome-options.create') }}"
                            class="btn btn-primary my-2">Create Outcome Option</a>

                            <a href="{{ route('outcome-options.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="outcome-options-categories"
                            data-attr="{{ route('outcome-options-categories.create') }}"
                            class="btn btn-primary my-2">Create Outcome Option Category</a>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link active"
                        id="outcome-options-tab"
                        data-toggle="tab" href="#outcome-options" role="tab" aria-controls="outcome-options" aria-selected="true">Outcome Options</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link"
                        id="outcome-options-categories-tab"
                        data-toggle="tab"
                        href="#outcome-options-categories"
                        role="tab" aria-controls="outcome-options-categories" aria-selected="false">Outcome Option Categories</a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    @include('outcome-options/partials/_options')
                    @include('outcome-options-categories/partials/_categories')
                </div>


            </div>
        </div>
    </div>
@endsection
